<?php
include 'config.php';
?>
<?php
    include 'config.php';
    $res_id=$_GET['res_id'];
    $sql= "SELECT * FROM ordered_items WHERE restaurantid='$res_id'";
    $var = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Document</title>
    <style>
        h1 {
            text-align: center;
            font-weight: bold;
        }
        table {
            margin-left: auto;
            margin-right: auto;
            width: 70%;
            background-color: rgb(21, 45, 105, 0.2);
            font-size: 30px;
        }
        thead {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <nav class="navbar" style="padding-bottom:1%;background-color:#43D1AF;">
        <h1>Orders</h1>
        <div class="dropdown" style="position:fixed;top:3%;left:85%;">
            <div class="container-fluid">
                <?php 
            if (isset($_GET['res_id']))
            { 
                $restau_id=$_GET['res_id'];
                $sql = "SELECT restaurantname FROM restaurant_details where restaurantid='$restau_id'";
                $res = mysqli_query($conn, $sql);
                $temp = mysqli_fetch_array($res);
                $restau_name=$temp['restaurantname'];
        ?>
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <?php echo($restau_name);?> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a onMouseOver="this.style.fontWeight='bold'" onMouseOut="this.style.fontWeight='normal'"
                            href="AddMenuItem.php?res_id=<?php echo $_GET['res_id']?>">Add Items</a></li>
                    <hr>
                    <div class="dropdown-divider"></div>
                    <li><a onMouseOver="this.style.fontWeight='bold',this.style.color='red'"
                            onMouseOut="this.style.fontWeight='normal',this.style.color='#000000'" class="dropdown-item"
                            href="index.php">Log Out</a></li>
                </ul>
            </div>
            <?php
            } 
        ?>
    </nav>
    <table>
        <thead>
            <td>Customer Name</td>
            <td>Item Name</td>
            <td>Price</td>
            <td>Status</td>
        </thead>
        <tbody>
            <?php
                while($row=$var->fetch_assoc()){
                    $restaurantid=$row['restaurantid'];
                        $customerid=$row['customerid'];
                        $itemid=$row['itemid'];
                        $sql1 = "SELECT customername FROM customer_details WHERE customerid='$customerid'";
                        $res1 = mysqli_query($conn, $sql1);
                        $temp1 = mysqli_fetch_array($res1);
                        $sql2 = "SELECT itemname,price FROM add_item WHERE restaurantid='$restaurantid' && itemid='$itemid'";
                        $res2 = mysqli_query($conn, $sql2);
                        $temp2 = mysqli_fetch_array($res2);
            ?>
            <tr>
                <td><?php echo $temp1['customername']?></td>
                <td><?php echo $temp2['itemname']?></td>
                <td><?php echo $temp2['price']?></td>
                <td><a
                        href="CancelOrder.php?cus_id=<?php echo $customerid?>&item_id=<?php echo $itemid ?>&res_id=<?php echo $_GET['res_id'] ?>">
                        <p><button type="button" class="btn btn-primary btn-lg">Done</button></p>
                    </a></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    </div>
</body>
</html>