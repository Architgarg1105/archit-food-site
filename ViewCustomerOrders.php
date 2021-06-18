<?php
include 'config.php';
?>
<?php
    include 'config.php';
    $cus_id=$_GET['cus_id'];
    $sql= "SELECT * FROM ordered_items WHERE customerid='$cus_id'";
    $var = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
        h1
        {
            text-align: center;
            font-weight:bold;
        }
        table 
        {
            margin-left:auto;
            margin-right:auto;
            width:70%;
            background-color:rgb(21, 45, 105,0.2);
            font-size:30px;
        }
        thead
        {
            font-weight:bold;
        }
        
    </style>
</head>
<body>
<!-- <div class="container-fluid"> -->
<nav class="navbar" style="padding-bottom:1%;background-color:#43D1AF;">
<h1>Your Orders</h1>
<div class="dropdown" style="position:fixed;top:3%;left:85%;">
        
        <?php 
            $custo_id=$_GET['cus_id'];
            $sql = "SELECT customername FROM customer_details where customerid='$custo_id'";
            $res = mysqli_query($conn, $sql);
            $temp = mysqli_fetch_array($res);
            $custo_name=$temp['customername'];
            ?>
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo($custo_name);?> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a onMouseOver="this.style.fontWeight='bold'" onMouseOut="this.style.fontWeight='normal'" href="index.php?cus_id=<?php echo $_GET['cus_id']?>">Home</a></li>
                    <li><a onMouseOver="this.style.fontWeight='bold'" onMouseOut="this.style.fontWeight='normal'" href="CustomerProfile.php?cus_id=<?php echo $_GET['cus_id']?>">Profile</a></li>
                    <li><a onMouseOver="this.style.fontWeight='bold'" onMouseOut="this.style.fontWeight='normal'" href="ViewCustomerOrders.php?cus_id=<?php echo $_GET['cus_id']?>">My Orders</a></li>
                    <hr>
                    <div class="dropdown-divider"></div>
                    <li><a onMouseOver="this.style.fontWeight='bold',this.style.color='red'" onMouseOut="this.style.fontWeight='normal',this.style.color='#000000'"  class="dropdown-item" href="index.php">Log Out</a></li>
                </ul>
            </div>      
                </nav> 
    <br>
    <table>
        <thead>
            <td style="padding-left:40px;">Restaurant Name</td>
            <td>Item Name</td>
            <td>Price</td>
            <td>Cancel Order</td>
        </thead>
        <tbody>
            <?php
                while($row=$var->fetch_assoc()){
                    $restaurantid=$row['restaurantid'];
                        $customerid=$row['customerid'];
                        $itemid=$row['itemid'];
                        $sql1 = "SELECT restaurantname FROM restaurant_details WHERE restaurantid='$restaurantid'";
                        $res1 = mysqli_query($conn, $sql1);
                        $temp1 = mysqli_fetch_array($res1);
                        $sql2 = "SELECT itemname,price FROM add_item WHERE restaurantid='$restaurantid' && itemid='$itemid'";
                        $res2 = mysqli_query($conn, $sql2);
                        $temp2 = mysqli_fetch_array($res2);
            ?>
            <tr>
                <td style="padding-left:40px;"><?php echo $temp1['restaurantname']?></td>
                <td><?php echo $temp2['itemname']?></td>
                <td><?php echo $temp2['price']?></td>
                <td><a  href="CancelOrder.php?cus_id=<?php echo $_GET['cus_id']?>&item_id=<?php echo $itemid ?>"><p ><button type="button" class="btn btn-primary btn-lg">Cancel</button></p></a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- </div> -->
</body>
</html>