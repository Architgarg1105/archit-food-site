<?php
    include 'config.php';
    $customerid=$_GET['cus_id'];
    $itemid=$_GET['item_id'];
    $sql_u = "SELECT * FROM cart_items WHERE customerid='$customerid' && itemid='$itemid'";
  	$res_u = mysqli_query($conn, $sql_u);
    if (mysqli_num_rows($res_u) > 0) {
        header("Location:./index.php?cus_id=$customerid");
    }
    else
    {
        $sql = "INSERT INTO cart_items (customerid,itemid) VALUES ('$customerid','$itemid')";
        $order = mysqli_query($conn, $sql);
        header("Location:./CartItems.php?cus_id=$customerid");
    }
exit;
?>