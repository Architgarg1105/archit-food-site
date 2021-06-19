<?php
include 'config.php';

if(isset($_POST['submit']))
{
    $itemid=$_GET['item_id'];
    $cusid=$_GET['cus_id'];
    $resid=$_GET['res_id'];
    $rating=$_POST['rating'];
    $sql = "INSERT INTO feedback (customerid, itemid, ratings) VALUES ('$cusid', '$itemid','$rating')";
    $result = mysqli_query($conn, $sql);
    header("Location:./FoodOrdered.php?cus_id=$cusid&res_id=<?php echo $resid?>&item_id=<?php echo $itemid?>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
    Ratings:
    1*<input type="radio" name="rating" value="1">
    2*<input type="radio" name="rating" value="2">
    3*<input type="radio" name="rating" value="3">
    4*<input type="radio" name="rating" value="4">
    5*<input type="radio" name="rating" value="5">
<br>
<input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>