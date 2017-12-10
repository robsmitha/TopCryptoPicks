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
            <div class="col-md-12">
                <table class="table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    </tbody>
                </table>
            </div>



        </div>

    </div>
    <!-- /.container -->

    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>

    </body>

    </html>

<?php
