<?php include "classes.php" ?>
<?php
$CustomerId = SessionManager::getCustomerId();
if($CustomerId > 0){
    $customer = new Customer($CustomerId);
    $customerOrdersList = Order::loadbycustomerid($CustomerId);
}
else{
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<?php include "head.php" ?>

<body>

<!-- Navigation -->
<?php include "navbar.php" ?>

<!-- Page Content -->
<div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3">Customer Profile
        <small><?php echo ucfirst($customer->getFirstName())." ".ucfirst($customer->getLastName()); ?></small>
    </h1>

    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active"><?php echo ucfirst($customer->getFirstName())." ".ucfirst($customer->getLastName()); ?></li>
    </ol>
    <div class="card">
        <div class="card-header">
            Customer Information
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <b>First Name: </b>
                    <?php echo ucfirst($customer->getFirstName()); ?>
                </div>
                <div class="col-md-4">
                    <b>Last Name: </b>
                    <?php echo ucfirst($customer->getLastName()); ?>
                </div>
                <div class="col-md-4">
                    <b>Email: </b>
                    <?php echo $customer->getEmail(); ?>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <b>Customer ID: </b>
                    <?php echo $customer->getId(); ?>
                </div>
                <div class="col-md-8">
                    <b>Create Date: </b>
                    <?php echo date_format(date_create($customer->getCreateDate()), 'g:ia \o\n l jS F Y'); ?>
                </div>
            </div>
        </div>
        <table class="table">
            <thead class="bg-secondary">
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Status</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 0;
            if(!empty($customerOrdersList)){
                foreach ($customerOrdersList as $order){
                    $i++;
                    $orderstatus = new Orderstatustype($order->getOrderStatusTypeId());
                    ?>
                    <tr>
                        <td><?php echo $order->getId() ?></td>
                        <td><?php echo date_format(date_create($order->getOrderDate()), 'g:ia \o\n l jS F Y') ?></td>
                        <td><?php echo $orderstatus->getName() ?></td>
                        <td><a href="view-order.php?id=<?php echo $order->getId()  ?>" class="btn btn-primary btn-sm">Details</a></td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
        <div class="card-footer">
            <b>Total Orders: </b><?php echo $i; ?>
        </div>
    </div>
</div>
<!-- /.container -->

<!-- Footer -->
<?php include "footer.php" ?>

<!-- Bootstrap core JavaScript -->
<?php include "scripts.php" ?>

</body>

</html>
