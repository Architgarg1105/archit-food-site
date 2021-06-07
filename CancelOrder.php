<?php
    include 'config.php';
    
    if(isset($_GET['res_id']))
    {
        $customerid=$_GET['cus_id'];
        $itemid=$_GET['item_id'];
        $restaurantid=$_GET['res_id'];
        $sql_u = "DELETE FROM ordered_items WHERE customerid='$customerid' && itemid='$itemid'";
        $res_u = mysqli_query($conn, $sql_u);
        header("Location:./ViewOrders.php?res_id=$restaurantid");
    }
    if (!isset($_GET['res_id'])) {
        $customerid=$_GET['cus_id'];
        $itemid=$_GET['item_id'];
        $sql_u = "DELETE FROM ordered_items WHERE customerid='$customerid' && itemid='$itemid'";
        $res_u = mysqli_query($conn, $sql_u);
        header("Location:./ViewCustomerOrders.php?cus_id=$customerid");
    }
exit;
?>