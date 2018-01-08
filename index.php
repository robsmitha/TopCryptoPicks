<?php
include_once("classes.php");
?>

<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body id="page-top">
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
    <h1 class="mt-4 mb-3 d-none d-sm-block">Top Crypto Picks
        <small>Latest Prices</small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php"><i class="icon-graph"></i> Dashboard</a>
        </li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-0 mt-4 text-center">
                <i class="fa fa-line-chart"></i> Crytocurrency Percent Changed (1hr, 24hr, 7d)
            </div>
            <hr class="mt-2">
            <div id="line-example" style="height: 250px;"></div>
        </div>
        <div class="col-sm-12">
            <div class="row">
                <div class="col-md-8">
                    <div id="cryptoresults">
                        <table id="gridCryptoResults" class='table'>
                        </table>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-0 mt-4 text-center">
                        <i class="fa fa-bar-chart"></i> Crytocurrency Prices
                    </div>
                    <hr class="mt-2">
                    <div id="bar-example" style="height: 250px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#button').click(function(){

        });//end of submit
    });//end of ready
</script>
<script>
    function loadData(startindex, limit) {
        $.ajax({
            type: 'GET',
            url: 'https://api.coinmarketcap.com/v1/ticker/?start='+startindex+'&limit=+'+limit
        })
            .done(function(json){
                var data = json;   //store response in array
                var output="";
                output+="<thead class=\"bg-secondary\">";
                output+="<tr>";
                output+="<td>Name</td>";
                output+="<td>Symbol</td>";
                output+="<td>Rank</td>";
                output+="<td>Price USD</td>";
                output+="<td>Price BTC</td>";
                output+="<td>Change 1h</td>";
                output+="<td>Change 24h</td>";
                output+="<td>Change 7d</td>";
                output+="</tr>";
                output+="</thead>";
                var linechartdata = [];
                var barchartdata = [];
                for (var i in data) {
                    //gather chart data
                    linechartdata.push({ y: data[i].symbol, a: data[i].percent_change_1h , b: data[i].percent_change_24h, c: data[i].percent_change_7d });
                    barchartdata.push({ y: data[i].symbol, a: data[i].price_usd});
                    //build grid
                    output+="<tr>";
                    output+="<td><a href='view-stock.php?id=" + data[i].rank + "'>" + data[i].name + "</a></td>";
                    output+="<td>" + data[i].symbol + "</td>";
                    output+="<td>" + data[i].rank +"</td>";
                    output+="<td>" + data[i].price_usd +"</td>";
                    output+="<td>" + data[i].price_btc +"</td>";
                    output+="<td>" + data[i].percent_change_1h +"</td>";
                    output+="<td>" + data[i].percent_change_24h +"</td>";
                    output+="<td>" + data[i].percent_change_7d +"</td>";
                    output+="</tr>";
                }
                Morris.Line({
                    element: 'line-example',
                    data: linechartdata,
                    parseTime: false,
                    xLabelAngle: 90,
                    xkey: 'y',
                    ykeys: ['a', 'b', 'c'],
                    labels: ['1 hour', '24 hour', '7 Days']
                });
                Morris.Bar({
                    element: 'bar-example',
                    data: barchartdata,
                    xkey: 'y',
                    ykeys: ['a'],
                    xLabelAngle: 90,
                    labels: ['USD $']
                });
                document.getElementById("gridCryptoResults").innerHTML=output;
            })
            .fail(function() {
                alert("Posting failed.");
            });
        return false;
    }
    $( document ).ready(function() {
        loadData(0,15);
        if ($(window).width() < 769) {
            $("#gridCryptoResults").addClass("table-responsive");
        }
    });

</script>
<?php include "footer.php" ?>
<?php include "scripts.php" ?>

</body>

</html>

