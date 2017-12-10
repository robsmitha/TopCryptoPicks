<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 12/9/2017
 * Time: 1:07 AM
 */
?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Top Crypto Picks</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <?php if(SessionManager::getSecurityUserId() > 0   //Security user logged in
                    && SessionManager::getCustomerId() == 0) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <?php
                }else if(SessionManager::getCustomerId() > 0){  //customer is logged in
                    include "cart.php";
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <?php
                }
                else{   //nobody logged in
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<style>
    body{
        padding-top: 90px;
    }
</style>