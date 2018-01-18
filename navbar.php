
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Top Crypto Picks</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        MENU <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <li class="nav-item">
                <div class="input-group pr-1 pt-1 pl-1 pb-1">
                    <input id="txtStockName" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button id="btnSearchStock" class="btn btn-primary" onclick="SearchStock()">
                            <i class="fa fa-search"></i>
                        </button>
                        </span>
                </div>
            </li>
            <li class="nav-item" title="Dashboard">
                <a class="nav-link" href="index.php">
                    <i class="icon-graph"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>
            <?php
            if(SessionManager::getCustomerId() > 0){
                ?>
                <li class="nav-item d-none">
                    <a class="nav-link" href="online-cart.php"><i class="icon-basket"></i> Cart
                        <span id="cartCounter" class="badge badge-pill badge-primary">
                                <?php
                                $foundcart = Cart::loadbycustomerid(SessionManager::getCustomerId());
                                $totalcartcount = 0;
                                if($foundcart != null){
                                    //use this cart id for item;
                                    $cartid = $foundcart->getId();
                                    $totalcartcount = Onlinecart::getcartcount($cartid);
                                }
                                echo $totalcartcount;
                                ?>
                            </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="customer-profile.php"><i class="icon-user"></i> Profile</a>
                </li>
            <?php
            }
            else if(SessionManager::getSecurityUserId() > 0){
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="admin-home.php"><i class="icon-lock"></i> Administration</a>
                </li>
            <?php
            }
            ?>

            <!--<li class="nav-item" title="Blog">
                <a class="nav-link" href="blog-home.php"><i class="fa fa-fw fa-list"></i> <span class="nav-link-text">Blog</span></a>
            </li>
            <li class="nav-item" title="Shop">
                <a class="nav-link" href="shop-home.php"><i class="fa fa-fw fa-shopping-basket"></i> <span class="nav-link-text">Shop</span></a>
            </li>-->
            <li class="nav-item" title="Contact">
                <a class="nav-link" href="contact.php"><i class="fa fa-fw fa-phone"></i> <span class="nav-link-text">Contact</span></a>
            </li>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <?php if(SessionManager::getSecurityUserId() > 0 ) {
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="icon-logout"></i> Logout</a>
                </li>
                <?php
            }else if(SessionManager::getCustomerId() > 0){  //customer is logged in
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownWatchList" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                       <i class="icon-magnifier"></i> Watch List
                    </a>
                    <div id="divWatchList" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownWatchList">
                        <?php
                        $watchlist = Watchlist::loadbycustomerid(SessionManager::getCustomerId());
                        if($watchlist != null){
                            $watchlistitemList = Watchlistitem::loadbywatchlistid($watchlist->getId());
                            if(!empty($watchlistitemList)){
                                foreach($watchlistitemList as $watchlistitem){
                                    ?>
                                    <a id="<?php echo $watchlistitem->getSymbol(); ?>" class="dropdown-item" href="view-stock.php?name=<?php echo $watchlistitem->getName(); ?>" title="<?php echo $watchlistitem->getName(); ?>">
                                        <?php echo $watchlistitem->getSymbol(); ?>
                                    </a>
                                    <?php

                                }
                            }
                        }
                        ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><i class="icon-logout"></i> Logout</a>
                </li>
                <?php
            }
            else{   //nobody logged in
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php"><i class="icon-login"></i> Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="create-customer.php"><i class="icon-pencil"></i> Register</a>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</nav>
<script>
    $("#txtStockName").on('keyup', function (e) {
        if (e.keyCode == 13) {
            //alert(document.getElementById("txtStockName").value);
            window.location.href = "view-stock.php?name=" + document.getElementById("txtStockName").value;
        }
    });
    function SearchStock() {
        window.location.href = "view-stock.php?name=" + document.getElementById("txtStockName").value;
    }
</script>