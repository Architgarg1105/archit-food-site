<?php
include 'config.php';
?>

<?php
$output="Add Items In Your Menu!!!";
if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $itemname = $_POST['itemname'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    
    $sql_u = "SELECT * FROM restaurant_details WHERE username='$username' && restaurantpassword='$password'";
  	$row = mysqli_query($conn, $sql_u);
    if (mysqli_num_rows($row) < 1)
    {
        $output="Username or Password Mismatch!!!";
    }
    else
    {
        $restaurantid = mysqli_fetch_array($row);
        $resid=$restaurantid['restaurantid'];
        $sql_e = "SELECT * FROM add_item WHERE itemname='$itemname' && restaurantid='$resid'";
        $res_e = mysqli_query($conn, $sql_e);
        if (mysqli_num_rows($res_e) > 0)
        {
            $output="Itemname already exists!!!";
        }
        else{
            $sql = "INSERT INTO add_item (restaurantid, itemname, price, category) VALUES ('$resid', '$itemname', '$price', '$category')";
            mysqli_query($conn, $sql);
          }
    }
    
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
         body
        {
            background-color:cyan;
            background: url('https://images.unsplash.com/photo-1620589125156-fd5028c5e05b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1965&q=80')no-repeat;
            height:100%;
        }
        .log-form
        {
            margin-top: 20%;
            width: 50%;
            height: 50%;
            background-color: rgba(37,150,190,0.7);
            border-radius:10%;
            margin-left:40px;
            box-shadow:
    0 0 20px 20px #fff,  
    0 0 30px 30px #0ff;
        }
        input[type="submit"]
        {
            background-color: 	white;
            color: red;
            width: 25%;
            font-size: 20px;
            padding: 5px;
            border-radius:5px;
            font-weight:bold;
            cursor: pointer;
            box-shadow:
    0 0 10px 10px #fff,  
    0 0 10px 10px #0ff; 
            
        }
        input[type=text] {
            background-color: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
            font-size: 30px;
            border-bottom: 5px solid red;
            width: 50%;
            height: 25px;
            margin-left:20px;
            text-align: center;
            box-shadow:
    0 0 10px 10px #fff,
    0 0 10px 10px #0ff; 
        }
        input[type=password] {
            background-color: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
            font-size: 30px;
            border-bottom: 5px solid red;
            width: 50%;
            height: 25px;
            margin-left:20px;
            text-align: center;
            box-shadow:
    0 0 10px 10px #fff,
    0 0 10px 10px #0ff;

        }
        input[type=number] {
            background-color: rgb(255, 255, 255);
            color: rgb(0, 0, 0);
            font-size: 30px;
            border-bottom: 5px solid red;
            width: 50%;
            height: 25px;
            margin-left:20px;
            text-align: center;
            box-shadow:
    0 0 10px 10px #fff, 
    0 0 10px 10px #0ff; 

        }
        input
        {
            margin-top: 10px;
            margin-bottom: 10px;
            padding: 5px;
            border-radius:5px;
        }
        a
        {
            margin-top: 10px;
            margin-bottom: 10px;
            font-weight:bold;
            color:gold;
            
        }
        h1,h2
        {
            padding-top: 10px;
            color: white;
            text-shadow: 1px 1px 2px black, 0 0 25px purple, 0 0 5px darkblue;
        }
        b
        {
            font-size:35px;
            box-shadow:
    0 0 10px 10px #fff,  
    0 0 10px 10px #FF4500; 
    color:white;
        }
        p
        {
            font-size:25px;
            font-weight:bold;
            color: white;
            text-shadow: 1px 1px 2px black, 0 0 25px purple, 0 0 5px darkblue;
        }
        .register 
        {
            color: white;
            text-shadow: 1px 1px 2px black, 0 0 25px purple, 0 0 5px darkblue;
        }
        button
        {
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
    0 0 10px 10px #0ff;
            border:2px solid black;
        }
    </style>
    
</head>
<body>
    
    <header>
<?php 
    if (isset($_GET['res_id'])) { 
        $restau_id=$_GET['res_id'];
        $sql = "SELECT restaurantname FROM restaurant_details where restaurantid='$restau_id'";
        $res = mysqli_query($conn, $sql);
        $temp = mysqli_fetch_array($res);
        $restau_name=$temp['restaurantname'];
        ?>
            <h1 style="margin-left:5%;">
            <a href="index.php">
                <p ><button style="float:right;margin-right:10%;width:10%;font-size:25px;">Log Out</button></p></a>
            <?php
            echo("Loged in as ");
            echo($restau_name);?>
            </h1>
            <?php } ?>
            </header>
    <center>
        <div class="log-form">
            <h1><?php echo $output ?></h1>
            <form method="POST">
            <button disabled>Username</button>
            <input type="text" name="username" placeholder="Username" required/>
            <br>
            <button disabled>Password</button>
            <input type="password" name="password" placeholder="Password" required />
            <br>
            <button disabled>Item Name</button>
            <input type="text" name="itemname" placeholder="Item Name" required/>
            <br>
            <button disabled>Price</button>
            <input type="number" name="price" placeholder="Price" required/>
            <br>
            <button disabled>Category</button>
            <input type="text" name="category" placeholder="Veg/Non-Veg" required/>
            <br>
            <br>
            <input type="submit" name="submit" value="Submit">
            <h1><a class="register" href="ViewOrders.php?res_id=<?php echo $_GET['res_id']?>">View Your Orders</a></h1>
            </form>
          </div>
        </center>
    </div>
</body>
</html>