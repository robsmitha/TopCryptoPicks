<?php



/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 12/9/2017
 * Time: 1:17 AM
 */
include "DAL/subscription.php";
include "DAL/statustype.php";
include "DAL/termtype.php";
include "DAL/cart.php";
include "DAL/cartitem.php";
include "Utilities/SessionManager.php";
session_start();

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"]) && $_GET["id"] > 0){
        $id = $_GET["id"];
        $subscription = new Subscription();
        $subscription->load($id);
    }
}
?>

    <!DOCTYPE html>
    <html lang="en">

    <?php include "head.php" ?>

    <body class="bg-light" id="page-top">
    <?php include "navbar.php" ?>
    <!-- Page Content -->
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

            <div class="col-lg-3">
                <h1 class="my-4">Subscriptions</h1>
                <div class="list-group">
                    <?php
                    $subscriptionList = Subscription::loadall();
                    if(!empty($subscriptionList)){
                        foreach ($subscriptionList as $s){
                            if($s->getId() == $subscription->getId()){
                                ?>
                                <a class="list-group-item active" href="view-subscription.php?id=<?php echo $s->getId() ?>" class="list-group-item active"><?php echo $s->getName() ?></a>
                                <?php
                            }
                            else{
                            ?>
                            <a class="list-group-item" href="view-subscription.php?id=<?php echo $s->getId() ?>" class="list-group-item active"><?php echo $s->getName() ?></a>
                            <?php
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-6">

                <div class="card mt-4 text-center">
                    <img class="card-img-top img-fluid mx-auto d-block" src="<?php echo $subscription->getImgUrl() ?>" alt="<?php echo $subscription->getName() ?>" style="width: 300px; height: 300px;">
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $subscription->getName() ?></h3>
                        <h4>$<?php echo $subscription->getPrice() ?></h4>
                        <p class="card-text"><?php echo $subscription->getDescription() ?></p>
                        <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                        4.0 stars
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" href="online-cart.php">Subscribe</a>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-3">
                <?php if(SessionManager::getSecurityUserId() > 0   //Security user logged in
                    && SessionManager::getCustomerId() == 0) {
                    ?>
                    <a class="btn btn-primary btn-block" id="btnCreateSubscription" href="create-subscription.php"><i class="icon-plus"></i> Create Subscription</a>
                    <?php
                }
                ?>
            </div>
            <!-- /.col-lg-3 -->

        </div>

    </div>
    <!-- /.container -->

    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>

    </body>

    </html>

<?php