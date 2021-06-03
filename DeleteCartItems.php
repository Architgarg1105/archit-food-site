<?php
    include 'config.php';
    if (isset($_GET['item_id'])) {
        $customerid=$_GET['cus_id'];
        $itemid=$_GET['item_id'];
        $sql_u = "DELETE FROM cart_items WHERE customerid='$customerid' && itemid='$itemid'";
        $res_u = mysqli_query($conn, $sql_u);
        header("Location:./CartItems.php?cus_id=$customerid");
    }
    else
    {
        $customerid=$_GET['cus_id'];
        $sql_u = "DELETE FROM cart_items WHERE customerid='$customerid'";
        $res_u = mysqli_query($conn, $sql_u);
        header("Location:./index.php?cus_id=$customerid");
    }
exit;
?>