<?php
    include 'config.php';
    $customerid=$_GET['cus_id'];
    $restaurantid=$_GET['res_id'];
    $itemid=$_GET['item_id'];
    $sql = "INSERT INTO ordered_items (customerid, restaurantid,itemid) VALUES ('$customerid', '$restaurantid','$itemid')";
    $result = mysqli_query($conn, $sql);
    header("Location:./index.php?cus_id=$customerid");
exit;
?>