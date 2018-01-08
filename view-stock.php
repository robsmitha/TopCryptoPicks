<?php  include_once ("classes.php") ?>
<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 12/9/2017
 * Time: 1:17 AM
 */
$CustomerId = SessionManager::getCustomerId();
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $id = $_GET["id"];
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <?php include "head.php" ?>

    <body id="page-top">
    <script>
        function loadData() {
            $.ajax({
                type: 'GET',
                url: "https://api.coinmarketcap.com/v1/ticker/?start=<?php echo $id - 1; ?>&limit=1"
            })
                .done(function(json){
                    var data = json;   //store response in array
                    document.getElementById("lblName").innerHTML = data[0].name;
                    document.getElementById("lblBreadCrumb").innerHTML = data[0].name;
                    document.getElementById("lblSymbol").innerHTML = data[0].symbol;
                    document.getElementById("lblRank").innerHTML = data[0].rank;
                    document.getElementById("lblPriceUSD").innerHTML = data[0].price_usd;
                    //fields
                    document.getElementById("id").innerHTML = data[0].id;
                    document.getElementById("name").innerHTML = data[0].name;
                    document.getElementById("symbol").innerHTML = data[0].symbol;
                    document.getElementById("rank").innerHTML = data[0].rank;
                    document.getElementById("price_usd").innerHTML = data[0].price_usd;
                    document.getElementById("price_btc").innerHTML = data[0].price_btc;
                    document.getElementById("market_cap_usd").innerHTML = data[0].market_cap_usd;
                    document.getElementById("available_supply").innerHTML = data[0].available_supply;
                    document.getElementById("total_supply").innerHTML = data[0].total_supply;
                    document.getElementById("percent_change_1h").innerHTML = data[0].percent_change_1h;
                    document.getElementById("percent_change_24h").innerHTML = data[0].percent_change_24h;
                    document.getElementById("percent_change_7d").innerHTML = data[0].percent_change_7d;
                    document.getElementById("last_updated").innerHTML = data[0].last_updated;

                    Morris.Donut({
                        element: 'donut-example',
                        data: [
                            {label: "Available Supply", value: data[0].available_supply},
                            {label: "Total Supply", value: data[0].total_supply}
                        ]
                    });
                })
                .fail(function() {
                    alert("Posting failed.");
                });
            return false;
        }
        function AddToWatchList() {
            symbol = $("#hfSymbol").val();
            name = $("#hfStockName").val();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                }
            };
            xhttp.open("GET", "AJAX/addwatchlistitem.php?symbol="+symbol+"&name="+name, true);
            xhttp.send();
        }


        $( document ).ready(function() {

            loadData();
            if ($(window).width() < 769) {
                $("#gridCryptoResults").addClass("table-responsive");
            }
        });
    </script>
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
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-md-12">
                <h1 id="lblName" class="mt-4 mb-3"></h1>
            </div>
            <div class="d-none">
                <?php
                if($CustomerId > 0){
                    ?>
                    <br>
                    <a onclick="AddToWatchList()" id="btnAddToWatchList" href="#" class="btn btn-primary btn-lg btn-block"><i class="icon-plus"></i> Add to Watch List</a>
                    <?php
                }
                ?>
            </div>
        </div>


        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php"><i class="icon-graph"></i> Dashboard</a>
            </li>
            <li id="lblBreadCrumb" class="breadcrumb-item active"></li>
        </ol>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-9">
                        <ul class="list-inline">
                            <li class="list-inline-item"><h1 id="lblSymbol"></h1></li>
                            <li class="list-inline-item"><h1 class="badge badge-warning badge-pill" id="lblRank"></h1></li>
                        </ul>
                        <h1 class="text-success" id="lblPriceUSD"></h1>
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <b>Id</b><br>
                                <label id="id"></label>
                            </div>
                            <div class="col-md-3 col-6">
                                <b>Name</b><br>
                                <label id="name"></label>
                            </div>
                            <div class="col-md-3 col-6">
                                <b>Symbol</b><br>
                                <label id="symbol"></label>
                            </div>
                            <div class="col-md-3 col-6">
                                <b>Rank</b><br>
                                <label id="rank"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <b>Price (USD)</b><br>
                                <b id="price_usd"></b>
                            </div>
                            <div class="col-md-3 col-6">
                                <b>Price (BTC)</b><br>
                                <label id="price_btc"></label>
                            </div>
                            <!--<div class="col-md-3 col-6">
                                <b>24h Volume USD</b><br>
                                <label id="24h_volume_usd"></label>
                            </div>-->
                            <div class="col-md-3 col-6">
                                <b>Market Cap USD</b><br>
                                <label id="market_cap_usd"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <b>Available Supply</b><br>
                                <label id="available_supply"></label>
                            </div>
                            <div class="col-md-3 col-6">
                                <b>Total Supply</b><br>
                                <label id="total_supply"></label>
                            </div>
                            <div class="col-md-3 col-6">
                                <b>Percent Changed (1h)</b><br>
                                <label id="percent_change_1h"></label>
                            </div>
                            <div class="col-md-3 col-6">
                                <b>Percent Changed (24h)</b><br>
                                <label id="percent_change_24h"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <b>Percent Changed (7d)</b><br>
                                <label id="percent_change_7d"></label>
                            </div>
                            <div class="col-md-3 col-6">
                                <b>Last Updated</b><br>
                                <label id="last_updated"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div id="donut-example"></div>
                    </div>
                </div>
                <hr>
            </div>
        </div>

    </div>

    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>
    <input type="hidden" name="hfSymbol" id="hfSymbol">
    <input type="hidden" name="hfStockName" id="hfStockName">
    </body>

    </html>

<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 12/9/2017
 * Time: 3:10 PM
 */