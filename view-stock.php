<?php



/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 12/9/2017
 * Time: 1:17 AM
 */
include "DAL/role.php";
include "DAL/securityuser.php";
include "DAL/cart.php";
include "DAL/cartitem.php";
include "DAL/statustype.php";
include "DAL/termtype.php";
include "DAL/subscription.php";
include "Utilities/SessionManager.php";
session_start();
if(SessionManager::getCustomerId() == 0 ){
    if(SessionManager::getSecurityUserId() > 0){

    }
    else{
        header("location: login.php");
    }
}
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"]) && $_GET["id"] > 0){
        $id = $_GET["id"];
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
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-12">
                        <h3 id="lblName"></h3>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-3">
                        <h1 class="badge badge-warning badge-pill pull-right" id="lblRank"></h1>
                        <h1 id="lblSymbol"></h1>
                        <h1 class="text-success" id="lblPriceUSD"></h1>
                    </div>
                    <div class="col-9">

                    </div>
                </div>

                <div id="cryptoresults">
                    <table id="gridCryptoResults" class='table'>
                    </table>
                </div>

                <script>
                    function loadData() {
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                var data = JSON.parse(this.responseText);   //store response in array
                                document.getElementById("lblName").innerHTML = data[0].name;
                                document.getElementById("lblSymbol").innerHTML = data[0].symbol;
                                document.getElementById("lblRank").innerHTML = data[0].rank;
                                document.getElementById("lblPriceUSD").innerHTML = data[0].price_usd;
                            }
                        };
                        xhttp.open("GET", "https://api.coinmarketcap.com/v1/ticker/?start=<?php echo $id - 1; ?>&limit=1", true);
                        xhttp.send();
                    }
                    $( document ).ready(function() {
                        loadData();
                        if ($(window).width() < 769) {
                            $("#gridCryptoResults").addClass("table-responsive");
                        }
                    });
                </script>
            </div>
        </div>
    </div>

    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>

    </body>

    </html>

<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 12/9/2017
 * Time: 3:10 PM
 */