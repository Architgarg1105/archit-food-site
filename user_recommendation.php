<?php
include 'config.php';
include 'recommend.php';
$custid=$_GET['cus_id'];
$feedback=mysqli_query($conn,"SELECT * FROM feedback");

$matrix=array();
while($feed=mysqli_fetch_array($feedback))
{
    $cust = mysqli_query($conn,"select customername from customer_details where customerid = $feed[customerid]");
    $result=mysqli_fetch_array($cust);
    $cust1 = mysqli_query($conn,"select itemname from add_item where itemid = $feed[itemid]");
    $result1=mysqli_fetch_array($cust1);

    $matrix[$result['customername']][$result1['itemname']]=$feed['ratings'];
}
$sql = mysqli_query($conn,"select customername from customer_details where customerid = $custid");
$result2=mysqli_fetch_array($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" integrity="undefined" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<h1 class="bg-warning" style="text-align:center; color:#fff;">Recommended Food</h1>
<br><br><br>
<center>
    <div class="container">
        <table class="table table-striped">
        <th>Item Name</th>
        <th>Rating</th>
        <?php
            $recommendation=array();
            $recommendation=getRecommendation($matrix,$result2['customername']);

            foreach($recommendation as $custo=>$rating)
            {?>
                <tr>
                    <td><?php echo $custo; ?></td>
                    <td><?php echo $rating; ?></td>
                </tr>
                <?php
            }?>
        </table>
    </div>
</center>
</body>
</html>
