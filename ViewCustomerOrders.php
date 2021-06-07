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
        body
        {
            background-color: goldenrod;
        }
        .home 
        {
            float:left;
            padding-left:50px;
        }
        header
        {
            padding-bottom: 1%;
            height:100px;
            background: linear-gradient(#eacda3 , #d6ae7b);
        }
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
            background-color:gainsboro;
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
    <header>
        <h1>FoodShala</h1>
        <?php 
            $custo_id=$_GET['cus_id'];
            $sql = "SELECT customername FROM customer_details where customerid='$custo_id'";
            $res = mysqli_query($conn, $sql);
            $temp = mysqli_fetch_array($res);
            $custo_name=$temp['customername'];
            ?>
            
            <div class="dropdown" style="float:right;margin-right:5%;">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo($custo_name);?> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a onMouseOver="this.style.fontWeight='bold'" onMouseOut="this.style.fontWeight='normal'" href="CustomerProfile.php?cus_id=<?php echo $_GET['cus_id']?>">Profile</a></li>
                    <li><a onMouseOver="this.style.fontWeight='bold'" onMouseOut="this.style.fontWeight='normal'" href="ViewCustomerOrders.php?cus_id=<?php echo $_GET['cus_id']?>">My Orders</a></li>
                    <hr>
                    <div class="dropdown-divider"></div>
                    <li><a onMouseOver="this.style.fontWeight='bold',this.style.color='red'" onMouseOut="this.style.fontWeight='normal',this.style.color='#000000'"  class="dropdown-item" href="index.php">Log Out</a></li>
                </ul>
            </div>
           
                <a class="home" href="index.php?cus_id=<?php echo $_GET['cus_id']?>"><p ><button type="button" class="btn btn-primary btn-lg">Home</button></p></a>
           
    </header>
    <br>
    <table>
        <thead>
            <td>Restaurant Name</td>
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
                <td><?php echo $temp1['restaurantname']?></td>
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