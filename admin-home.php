<?php include "classes.php" ?>
<?php
if(SessionManager::getSecurityUserId() == 0){
    header("location: admin-login.php");
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

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Hello, <?php echo SessionManager::getUsername() ?></h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Administration</li>
        </ol>
        <div class="row">
            <div class="col-sm-4">
                <a href="create-blog.php">
                    <div class="tile">
                        <div class="tile-title">
                            <h3 class="text-white">Create Blog</h3>
                            <p class="lead">Create a blog post that appears on the site.</p>
                        </div>
                        <div class="tile-footer">
                            <i class="icon-arrow-right-circle pull-right fa-2x text-white"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="create-item.php">
                    <div class="tile">
                        <div class="tile-title">
                            <h3 class="text-white">Create Item</h3>
                            <p class="lead">Create a shop item that appears on the site.</p>
                        </div>
                        <div class="tile-footer">
                            <i class="icon-arrow-right-circle pull-right fa-2x text-white"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-4">
                <a href="create-user.php">
                    <div class="tile">
                        <div class="tile-title">
                            <h3 class="text-white">Create User</h3>
                            <p class="lead">Create a user to edit the site content.</p>
                        </div>
                        <div class="tile-footer">
                            <i class="icon-arrow-right-circle pull-right fa-2x text-white"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <br>
        <h4>Types</h4>
        <hr>
        <div class="row">
            <div class="col-sm-3">
                <a href="create-type.php?type=itemtype">
                    <div class="tile">
                        <div class="tile-title">
                            <h5 class="text-white">Create Item Type</h5>
                            <p class="lead">Create a new item type.</p>
                        </div>
                        <div class="tile-footer">
                            <i class="icon-arrow-right-circle pull-right fa-2x text-white"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-sm-3">
                <a href="create-type.php?type=blogcategory">
                    <div class="tile">
                        <div class="tile-title">
                            <h5 class="text-white">Create Blog Category</h5>
                            <p class="lead">Create a new blog category.</p>
                        </div>
                        <div class="tile-footer">
                            <i class="icon-arrow-right-circle pull-right fa-2x text-white"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.container -->
</div>


<!-- Footer -->
<?php include "footer.php" ?>

<!-- Bootstrap core JavaScript -->
<?php include "scripts.php" ?>

</body>

</html>
