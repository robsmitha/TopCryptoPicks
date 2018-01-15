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
    $name = $_GET["name"];
    $name = str_replace(' ', '-', $name);
    $name = strtoupper($name);
}
?>
    <!DOCTYPE html>
    <html lang="en">

    <?php include "head.php" ?>

    <body id="page-top">
    <script>
        function loadData(stockname) {
            $.ajax({
                type: 'GET',
                url: "https://api.coinmarketcap.com/v1/ticker/" + stockname + "/"
            })
                .done(function(json){
                    $("#divLoading").addClass("d-none");
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

                    document.getElementById("hfSymbol").value = data[0].symbol;
                    document.getElementById("hfStockName").value = data[0].name;

                    Morris.Donut({
                        element: 'donut-example',
                        data: [
                            {label: "Available Supply", value: data[0].available_supply},
                            {label: "Total Supply", value: data[0].total_supply}
                        ]
                    });
                })
                .fail(function() {
                    window.location = "index.php";
                });
            return false;
        }

        function checkIfItemExists(){
            name = $("#hfStockName").val();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    //alert(this.responseText);
                    $("#hfWatchListItemId").val(this.responseText);
                    if(this.responseText != 0){
                        //true, the item does exists
                        //we should show the remove button
                        $("#btnAddToWatchList").addClass("d-none");
                        $("#btnRemoveFromWatchList").removeClass("d-none");
                    }
                    else{
                        $("#btnAddToWatchList").removeClass("d-none");
                        $("#btnRemoveFromWatchList").addClass("d-none");
                    }

                }
            };
            xhttp.open("GET", "AJAX/checkifwatchlistitemexists.php?name=<?php echo $name ?>" , true);
            xhttp.send();
        }

        function AddToWatchList() {
            symbol = $("#hfSymbol").val();
            name = $("#hfStockName").val();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    checkIfItemExists();
                    $("#divWatchList").append(this.responseText); //update watchlist in nav

                    //$("#alertAddedToWatchList").removeClass("d-none");
                    //$("#alertMsg").text('Added To Watch List!');
                    //setTimeout(function () { $("#alertWatchList").fadeOut(); }, 5000);
                }
            };
            xhttp.open("GET", "AJAX/addwatchlistitem.php?symbol="+symbol+"&name="+name, true);
            xhttp.send();
        }
        function RemoveWatchListItem() {
            wliid = $("#hfWatchListItemId").val();
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    checkIfItemExists();
                    symbol = $("#hfSymbol").val();
                    //alert("Removing" + symbol);
                    document.getElementById(symbol).outerHTML='';    //update watchlist in nav
                    //$("#alertAddedToWatchList").removeClass("d-none");
                    //$("#alertMsg").text('Removed From Watch List!');
                    //setTimeout(function () { $("#alertWatchList").fadeOut(); }, 5000);
                }
            };
            xhttp.open("GET", "AJAX/removewatchlistitem.php?id="+ wliid , true);
            xhttp.send();
        }

        $( document ).ready(function() {
            //alert('<?php echo strtolower($name) ?>');
            loadData('<?php echo strtolower($name) ?>');
            checkIfItemExists();
        });
    </script>
    <?php include "navbar.php" ?>
    <div class="content-wrapper">
        <div class="container-fluid">
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
                <div class="col-md-9">
                    <h1 id="lblName" class="mb-3"></h1>
                </div>
                <div class="col-md-3">
                    <?php
                    if($CustomerId > 0){
                        ?>
                        <a onclick="AddToWatchList()" id="btnAddToWatchList" href="#" class="btn btn-primary btn-lg btn-block d-none mb-2"><i class="icon-plus"></i> Add to Watch List</a>
                        <a href="#" id="btnRemoveFromWatchList" onclick="RemoveWatchListItem()" class="btn btn-danger btn-lg btn-block d-none mb-2"><i class="icon-minus"></i> Remove From Watch List</a>
                        <div id="alertAddedToWatchList" class="alert alert-success alert-dismissible fade show mx-auto d-none" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <span id="alertMsg"></span>
                        </div>
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
                    <div id="divLoading" class="text-center mt-5">
                        <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                    </div>
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
    </div>

    <?php include "footer.php" ?>
    <?php include "scripts.php" ?>
    <input type="hidden" name="hfSymbol" id="hfSymbol">
    <input type="hidden" name="hfStockName" id="hfStockName">
    <input type="hidden" name="hfWatchListItemId" id="hfWatchListItemId">
    </body>

    </html>

<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 12/9/2017
 * Time: 3:10 PM
 */