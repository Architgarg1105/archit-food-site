<?php 
include 'config.php';
?>
<?php
        include 'config.php';
        $ret = array();
        $customerid=$_GET['cus_id'];
        $sql = "SELECT * FROM cart_items WHERE customerid='$customerid'";
        $res = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<style>
        body
        {
            background: linear-gradient(#eacda3 , #d6ae7b);
        }
        h2 
        {
            font-weight:bold;
            padding-left:20px;
        }
        .menu
        {
            margin-top:70px;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            text-align: center;
            font-family: arial;
            background-color:white;
        }
        .price {
            color: red;
            font-size: 22px;
            
            
        }
        .navbar {
            overflow: hidden;
            background: linear-gradient(#eacda3 , #d6ae7b);
            position: fixed;
            top: 0;
            width: 100%;
            text-align:center;
        }
        .logout 
        {
            float:right;
            padding-right:50px;
            padding-top:10px;
        }
        .home 
        {
            float:left;
            padding-left:50px;
            padding-top:10px;
        }
        .navbar i 
        {
            padding-top:10px;
        }

        .restauname {
            color: black;
            font-size: 30px;
            
        }
        
        .card button {
            border: none;
            outline: 0;
            padding: 12px;
            color: white;
            background-color: #000;
            text-align: center;
            cursor: pointer;
            width: 100%;
            font-size: 18px;
        }
        .card button:hover {
            opacity: 0.7;
        }
        /* .row:after {
            content: "";
            display: table;
            clear: both;
        } */
        .column {
            float: left;
            width: 25%;
            padding: 0 5px;
        }
        @media screen and (max-width: 600px) {
        .column {
            width: 100%;
            display: block;
            margin-bottom: 20px;
        }
        .orderbutton
        {
            color: black;
            display: inline;
            margin: 1%;
            padding-bottom: 5%;
            font-size: large;
        }
        }
        h1
        {
            text-align:center;
            font-weight:bold;
        }
</style>
<body>

<div class="menu">
        <?php
        if (mysqli_num_rows($res) > 0) { ?>
        <div class="navbar">
        <a class="home" href="index.php?cus_id=<?php echo $_GET['cus_id']?>"><p ><button type="button" class="btn btn-primary btn-lg">Home</button></p></a>
<a class="logout" onclick="alert('All Items removed from the Cart');" href="DeleteCartItems.php?cus_id=<?php echo $_GET['cus_id']?>"><p ><button type="button" class="btn btn-primary btn-lg">Empty Cart</button></p></a>
<i class="fa fa-shopping-cart center" style="font-size:50px;color:white"></i>
</div>
        <?php
        while($ar = mysqli_fetch_assoc($res))
        {
                $ret[] = $ar;
        }
            foreach($ret as $ap)
            {
                $itemid=$ap['itemid'];
                $sql1 = "SELECT restaurantid,itemname,price FROM add_item WHERE itemid='$itemid'";
                $res1 = mysqli_query($conn, $sql1);
                $res11 = mysqli_fetch_array($res1);
                $restaurantid=$res11['restaurantid'];
                $itemname=$res11['itemname'];
                $price=$res11['price'];
                $sql2 = "SELECT restaurantname FROM restaurant_details WHERE restaurantid='$restaurantid'";
                $res2 = mysqli_query($conn, $sql2);
                $restaurantname = mysqli_fetch_array($res2);
            ?>
        <div class="column">
            <div class="card">
                <img src="https://media.istockphoto.com/photos/tasty-pepperoni-pizza-and-cooking-ingredients-tomatoes-basil-on-black-picture-id1083487948?k=6&m=1083487948&s=612x612&w=0&h=lK-mtDHXA4aQecZlU-KJuAlN9Yjgn3vmV2zz5MMN7e4=" alt="Denim Jeans" style="width:100%">
                <h1 style="text-align:center;"><?php echo $itemname; ?></h1>
                <p style="font-weight:bold;" class="price">Rs <?php echo $price; ?></p>
                <p class="restauname"><?php echo $restaurantname['restaurantname']; ?></p>
                <a href="DeleteCartItems.php?cus_id=<?php echo $_GET['cus_id']?>&item_id=<?php echo $itemid?>">
                <p ><button class="orderbutton">Remove from Cart</button></p></a>
            </div>
        </div>
        <?php 
     }} else{
         ?> 
         <br>
         <div class="navbar">
         <a class="home" href="index.php?cus_id=<?php echo $_GET['cus_id']?>"><p ><button type="button" class="btn btn-primary btn-lg">Home</button></p></a>
<i class="fa fa-shopping-cart center" style="font-size:50px;color:white"></i>
</div>
         <h1>Nothing in the Cart!!!</h1> <?php } ?>
    </div>
    <!-- <footer class="footer navbar-fixed-bottom">
    <a onclick="alert('All Items removed from the Cart');" href="DeleteCartItems.php?cus_id=<?php echo $_GET['cus_id']?>">
                <p ><button type="button" class="btn btn-primary btn-lg btn-block">Empty Cart</button></p></a>
    </footer> -->
</body>
</html>