<?php



/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 12/9/2017
 * Time: 1:17 AM
 */
include "DAL/termtype.php";
include "DAL/subscription.php";
include "DAL/statustype.php";
include "Utilities/Authentication.php";
session_start();
if(SessionManager::getSecurityUserId() == 0){
    header("location: login.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $returnVal = true;
    isset($_POST["name"]) && $_POST["name"] != "" ? $name = $_POST["name"] : $returnVal = false;
    isset($_POST["description"]) && $_POST["description"] != "" ? $description = $_POST["description"] : $returnVal = false;
    isset($_POST["termtype"]) && $_POST["termtype"] > 0 ? $termtypeid = $_POST["termtype"] : $returnVal = false;
    isset($_POST["statustype"]) && $_POST["statustype"] > 0 ? $statustypeid = $_POST["statustype"] : $returnVal = false;
    isset($_POST["imgurl"]) && $_POST["imgurl"] != "" ? $imgurl = $_POST["imgurl"] : $returnVal = false;
    isset($_POST["price"]) && $_POST["price"] != "" ? $price = $_POST["price"] : $returnVal = false;

    if($returnVal){
        $currentDate = date('Y-m-d H:i:s');
        $subscription = new Subscription(0,$name,$description,$termtypeid,$price,$imgurl,$currentDate,$statustypeid);
        $subscription->save();
        header("location: index.php");
    }
    else{
        $validationMsg = "Please review your entries!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body class="bg-light" id="page-top">
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

            <div class="col-md-3">
                <h1 class="my-4">Subscriptions</h1>
                <div class="list-group">
                    <?php
                    $subscriptionList = Subscription::loadall();
                    if(!empty($subscriptionList)){
                        foreach ($subscriptionList as $s){
                            ?>
                            <a class="list-group-item" href="view-subscription.php?id=<?php echo $s->getId() ?>" class="list-group-item active"><?php echo $s->getName() ?></a>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-md-6">

                <div class="card mx-auto mt-3">
                    <div class="card-header"><h3 class="text-center">Create Subscription</h3></div>
                    <hr>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-12">
                                        <label for="name">Name</label>
                                        <input class="form-control" id="name" name="name" type="text" placeholder="Subscription Name">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5" type="text" placeholder="Subscription Description"></textarea>
                            </div>
                            <div class="form-group">
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="termtype">Term Type</label>
                                        <select class="form-control" name="termtype">
                                            <option value="0">--Select Term--</option>
                                            <?php
                                            $termTypeList = Termtype::loadall();
                                            if(!empty($termTypeList)){
                                                foreach ($termTypeList as $termtype) {
                                                    ?>
                                                    <option value="<?php echo $termtype->getId() ?>"><?php echo $termtype->getName() ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="termtype">Status Type</label>
                                        <select class="form-control" name="statustype">
                                            <option value="0">--Select Status--</option>
                                            <?php
                                            $statusTypeList = Statustype::loadall();
                                            if(!empty($statusTypeList)){
                                                foreach ($statusTypeList as $statustype) {
                                                    ?>
                                                    <option value="<?php echo $statustype->getId() ?>"><?php echo $statustype->getName() ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <label for="imgurl">Image Url</label>
                                        <input class="form-control" id="imgurl" name="imgurl" type="text" placeholder="Image Url">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="price">Price</label>
                                        <input class="form-control" id="price" name="price" placeholder="00.00">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Create Subscription</button>
                        </form>
                    </div>
                </div>

            </div>

        </div>
</div>

<?php include "scripts.php" ?>

</body>

</html>

