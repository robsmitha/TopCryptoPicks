<?php



/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 12/9/2017
 * Time: 1:17 AM
 */
include "DAL/role.php";
include "DAL/securityuser.php";
include "Utilities/Authentication.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $returnVal = true;
    isset($_POST["email"]) && $_POST["email"] != "" ? $email = $_POST["email"] : $returnVal = false;
    isset($_POST["username"]) && $_POST["username"] != "" ? $username = $_POST["username"] : $returnVal = false;
    isset($_POST["password"]) && $_POST["password"] != "" ? $password = $_POST["password"] : $returnVal = false;
    if(isset($_POST["confirmpassword"]) && $_POST["confirmpassword"] == $password){
        isset($_POST["confirmpassword"]) && $_POST["confirmpassword"] != "" ? $confirmpassword = $_POST["confirmpassword"] : $returnVal = false;
    }
    else{
        $returnVal = false;
        $validationMsg = "Passwords did not match.";
    }

    isset($_POST["role"]) && $_POST["role"] > 0 ? $roleid = $_POST["role"] : $returnVal = false;
    if($returnVal){
        $securityuser = Securityuser::lookup($username);
        if ($securityuser != null) {
            // This email is already taken
            $errorMessage = "The provided username is already in use. Please try another username.";
        }
        else {
            $currentDate = date('Y-m-d H:i:s');
            $securityuser = Authentication::createSecurityUser($username, $password, $email, $roleid,$currentDate);
            if ($securityuser == null) {
                // Something went wrong while attempting to create this user
                $validationMsg = "An error occurred during the creation of this security user. Please try again. If the problem continues, contact OpenDevTools support at opendevtools@gmail.com";
            }
            else {
                // Set session values for successful login
                SessionManager::setSecurityUserId($securityuser->getId());
                SessionManager::setRoleId($securityuser->getRoleId());
                SessionManager::setUsername($securityuser->getUsername());
                // Redirect to Dashboard
                header("location: index.php");
            }
        }
    }
    else{
        $validationMsg = "Please review your entries!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body class="bg-light">
<?php include "navbar.php" ?>
<div class="container">
    <?php if(isset($validationMsg)) { ?>
        <div class="alert alert-danger alert-dismissible fade show mx-auto mt-5" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4> <?php  echo $validationMsg; ?> </h4>
        </div>
    <?php } ?>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <div class="card mx-auto mt-5">
                <div class="card-header">Create Security User</div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Email Address</label>
                            <input class="form-control" id="email" name="email" type="email" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="username">Username</label>
                                    <input class="form-control" id="username" name="username" type="text" placeholder="Username">
                                </div>
                                <div class="col-md-6">
                                    <label for="exampleConfirmPassword">Role</label>
                                    <select class="form-control" name="role">
                                        <option value="0">--Select Role--</option>
                                        <?php
                                        $roleList = Role::loadall();
                                        if(!empty($roleList)){
                                            foreach ($roleList as $role) {
                                            ?>
                                                <option value="<?php echo $role->getId() ?>"><?php echo $role->getName() ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="password">Password</label>
                                    <input class="form-control" id="password" name="password" type="password" placeholder="Password">
                                </div>
                                <div class="col-md-6">
                                    <label for="confirmpassword">Confirm password</label>
                                    <input class="form-control" id="confirmpassword" name="confirmpassword" type="password" placeholder="Confirm password">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </form>
                    <div class="text-center">
                        <a class="d-block small mt-3" href="admin-login.php">Login Page</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "scripts.php" ?>

</body>

</html>

