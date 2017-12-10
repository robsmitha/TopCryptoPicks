<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 12/9/2017
 * Time: 1:04 AM
 */
session_start();
include_once("Utilities/Authentication.php");
$errorMessage = "";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    isset($_POST["email"]) && $_POST["email"] != "" ? $email = $_POST["email"] : $returnVal = false;
    isset($_POST["password"]) && $_POST["password"] != "" ? $password = $_POST["password"] : $returnVal = false;

    $success = Authentication::customerLogin($email,$password);
    if ($success)
    {
        header("location: dashboard.php");
    }
    else
    {
        $validationMsg = "Incorrect username or password. Try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body class="bg-dark" id="page-top">
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
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
            <div class="card mx-auto mt-5">
                <div class="card-header">Customer Login</div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input class="form-control" id="email" name="email" type="email" aria-describedby="emailHelp" placeholder="Enter Username">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="Password">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include "scripts.php" ?>

</body>

</html>

