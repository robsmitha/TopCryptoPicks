<?php include "classes.php" ?>
<?php
$customerId = SessionManager::getCustomerId();
$securityuserId = SessionManager::getSecurityUserId();

if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["id"]) && is_numeric($_GET["id"]) && $_GET["id"] > 0){
        $itemtypeid = $_GET["id"];
        $itemList = Item::search(null,null,null,null,null,$itemtypeid,null,null,null);
    }
    else{
        $itemList = Item::search(null,null,null,null,null,null,null,null,null);
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body>

<!-- Navigation -->
<?php include "navbar.php" ?>

<!-- Page Content -->
<div class="content-wrapper">
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-3">

                <h1 class="my-4">Shop Name</h1>
                <div class="list-group">
                    <?php
                    $itemTypeList = Itemtype::loadall();
                    if(!empty($itemTypeList)){
                        foreach ($itemTypeList as $itemtype){
                            if(isset($itemtypeid) && $itemtype->getId() == $itemtypeid){
                                ?>
                                <a href="shop-home.php?id=<?php echo $itemtype->getId() ?>" class="list-group-item active"><?php echo $itemtype->getName() ?></a>
                                <?php
                            }
                            else{
                                ?>
                                <a href="shop-home.php?id=<?php echo $itemtype->getId() ?>" class="list-group-item"><?php echo $itemtype->getName() ?></a>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>

            </div>
            <!-- /.col-lg-3 -->

            <div class="col-lg-9">
                <div class="row">
                    <?php
                    if(!empty($itemList)){
                        foreach ($itemList as $item){
                            ?>
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100">
                                    <a href="shop-item.php?id=<?php echo $item->getId() ?>"><img class="card-img-top" src="<?php echo $item->getImgUrl() ?>" alt=""></a>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="shop-item.php?id=<?php echo $item->getId() ?>"><?php echo $item->getName() ?></a>
                                        </h4>
                                        <h5>$<?php echo $item->getPrice() ?></h5>
                                        <p class="card-text"><?php echo $item->getDescription() ?></p>
                                        <div class="btn-group">
                                            <?php
                                            if($customerId > 0){
                                                ?>
                                                <button class="btn btn-primary" onclick="addToCart(<?php echo $item->getId() ?>,<?php echo $item->getItemTypeId() ?>,<?php echo $item->getItemStatusTypeId() ?>);return false;"><i class="icon-plus"></i> Add</button>
                                                <?php
                                            }
                                            if($securityuserId > 0){
                                                ?>
                                                <a href="create-item.php?id=<?php echo $item->getId(); ?>&cmd=edit" class="btn btn-danger">Edit</a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
</div>


<!-- Footer -->
<?php include "footer.php" ?>
<script>
    function addToCart(id, itid, istid) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("cartCounter").innerText = this.responseText;
                $('#myModal').modal('show');
            }
        };
        xhttp.open("GET", "AJAX/addcartitem.php?id="+id+"&itid="+itid+"&istid="+istid, true);
        xhttp.send();
    }
</script>
<div id="myModal" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="icon-check"></i> Added To Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-footer">
                <a href="online-cart.php" class="btn btn-primary">Checkout Now</a>
                <button type="button" class="btn btn-secondary" onclick="location.reload()">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript -->
<?php include "scripts.php" ?>

</body>

</html>
