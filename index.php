<?php
include 'config.php';
?>
<?php
    function get_product_details()
    {
        include 'config.php';
        $ret = array();
        $sql = "SELECT * FROM add_item";
        $res = mysqli_query($conn, $sql);

        while($ar = mysqli_fetch_assoc($res))
        {
            $ret[] = $ar;
        }
        return $ret;
    }
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
        .container-fluid
        {
            background: linear-gradient(#eacda3 , #d6ae7b);
            height:100%;
        }
        .navbar
        {
            flex-direction:column;
        }
        header
        {
            margin-bottom: 2%;
            padding-top: 1px;
        }
        h1
        {
            font-weight:bold;
         
            /* color: white;
            text-shadow: 1px 1px 2px black, 0 0 25px purple, 0 0 5px darkblue; */
        }
        .register
        {
            
            display: inline;
            margin: 18%;
            background-color: 	white;
            color: red;
            width: 25%;
            height:45px;
            font-size: 20px;
            padding: 5px;
            border-radius:5px;
            font-weight:bold;
            box-shadow:
                0 0 10px 10px #fff,  
                0 0 10px 10px purple; 
            border:2px solid black;
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
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
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
   </style>
</head>
<body>
<div class="container-fluid">
    <header>
        <h1 style="text-align:center;">FoodShala</h1>
        <?php 
        if (!isset($_GET['cus_id'])) {?>
        <a style="float:right;margin-right:5%;" href="RestaurantLogin.php"><button type="button" class="btn btn-primary btn-lg">Login as Restaurant</button></a>
        <a style="float:right;margin-right:5%;" href="CustomerLogin.php"><button type="button" class="btn btn-primary btn-lg">Login as Customer</button></a>
        
        <?php } else{ 
            $custo_id=$_GET['cus_id'];
            $sql = "SELECT customername FROM customer_details where customerid='$custo_id'";
            $res = mysqli_query($conn, $sql);
            $temp = mysqli_fetch_array($res);
            $custo_name=$temp['customername'];
            ?>
            
            <!-- <a style="float:right;margin-right:5%;" class="btn btn-info btn-lg" href="index.php">
            <span class="glyphicon glyphicon-log-out"></span> Log out
            </a> -->
            <a style="float:left;margin-left:5%;" class="btn btn-info btn-lg" href="CartItems.php?cus_id=<?php echo $_GET['cus_id']?>">
                <span  class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart
            </a>
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
            <h1 style="margin-left:5%;">
            <!-- <?php
            echo("Loged in as ");
            echo($custo_name);?> -->
            </h1>
            <?php } ?>
        <br>
        <br>
    </header>
    <div class="menu">
        <?php 
            $products = get_product_details(); 

            foreach($products as $ap)
            {
                $itemname = $ap['itemname'];
                $price = $ap['price'];
                $restaurantid=$ap['restaurantid'];
                $itemid=$ap['itemid'];
                $sql_e = "SELECT restaurantname FROM restaurant_details WHERE restaurantid='$restaurantid'";
                $res_u = mysqli_query($conn, $sql_e);
                $restaurantname = mysqli_fetch_array($res_u);
            ?>
        <div class="column">
            <div class="card">
                <img src="https://media.istockphoto.com/photos/tasty-pepperoni-pizza-and-cooking-ingredients-tomatoes-basil-on-black-picture-id1083487948?k=6&m=1083487948&s=612x612&w=0&h=lK-mtDHXA4aQecZlU-KJuAlN9Yjgn3vmV2zz5MMN7e4=" alt="Denim Jeans" style="width:100%">
                <h1 style="text-align:center;"><?php echo $itemname; ?></h1>
                <p style="font-weight:bold;" class="price">Rs <?php echo $price; ?></p>
                <p class="restauname"><?php echo $restaurantname['restaurantname']; ?></p>
                <a <?php if (isset($_GET['cus_id'])) { ?> onclick="alert('Food Ordered');" href="FoodOrdered.php?cus_id=<?php echo $_GET['cus_id']?>&res_id=<?php echo $restaurantid?>&item_id=<?php echo $itemid?>" <?php } ?>href="CustomerLogin.php">
                <p ><button class="orderbutton">Order Now</button></p></a>
                <a <?php if (isset($_GET['cus_id'])) { ?> href="AddIntoCart.php?cus_id=<?php echo $_GET['cus_id']?>&item_id=<?php echo $itemid?>" <?php } ?>href="CustomerLogin.php">
                <p ><button class="orderbutton">Add To Cart</button></p></a>
            </div>
        </div>
        <?php 
     } ?>
    </div>
    </div>
</body>
</html>

