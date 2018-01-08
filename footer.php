<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 12/9/2017
 * Time: 12:32 PM
 */
?>
<!-- Footer -->
<footer class="footer text-center" id="footer">
    <div class="container">
        <?php if(SessionManager::getSecurityUserId() > 0   //Security user logged in
            && SessionManager::getCustomerId() == 0) {
            ?>
            <small>Hi, <?php echo SessionManager::getUsername(); ?> <a href="logout.php">Logout</a></small>
        <?php
        }else if(SessionManager::getCustomerId() > 0){  //customer is logged in
            ?>
            <small>Hi, <?php echo SessionManager::getFirstName(); ?> <a href="logout.php">Logout</a></small>
            <?php
        }
        else{   //nobody logged in
            ?>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="login.php">Customer</a></li>
                <li class="list-inline-item">&middot;</li>
                <li class="list-inline-item"><a href="admin-login.php">Admin</a></li>
            </ul>
        <?php
        }
        ?>

        <p class="text-muted small mb-0">Copyright &copy; Application Template <?php echo date("Y"); ?></p>
        <small>Powered by <a href="http://webmediaconcepts.com/">Web Media Concepts</a></small>
        <br>
    </div>
</footer>

<!-- Scroll to Top Button
<a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
    <i class="fa fa-angle-up"></i>
</a>-->