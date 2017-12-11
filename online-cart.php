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
include "DAL/OnlineCart.php";
include "Utilities/SessionManager.php";
session_start();
$customerId = SessionManager::getCustomerId();
$cart = Cart::loadbycustomerid($customerId);
if($cart != null){
    $cartItemList = OnlineCart::loadbycartid($cart->getId());
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        My Cart
                    </div>
                    <div>
                        <table class="table">
                            <thead class="bg-dark white">
                            <tr>
                                <th>Subscription</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Customer</th>
                                <th>Quantity</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($cartItemList)){
                                foreach ($cartItemList as $c) {
                                    ?>
                                    <tr>
                                        <td class="text-center">
                                            <img class="d-flex mr-3 mx-auto" style="width: 75px; height: 75px;" src="<?php echo $c->getImgUrl() ?>" alt="<?php echo $c->getSubscription() ?>">
                                            <?php echo $c->getSubscription() ?>
                                        </td>
                                        <td><?php echo $c->getSubscriptionDescription() ?></td>

                                        <td>$&nbsp;<?php echo $c->getPrice() ?></td>
                                        <td><?php echo $c->getStatusType() ?></td>
                                        <td><?php echo $c->getCustomerName() ?></td>
                                        <td><?php echo $c->getQuantity() ?></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <?php if(!empty($cartItemList)) { ?>
                            <a href="online-checkout.php" class="btn btn-primary btn-lg pull-right">Checkout</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

            </div>
        </div>

    </div>
    <!-- /.container -->

    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>

    </body>

    </html>

<?php
