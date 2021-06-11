<?php
include 'config.php';
?>
<?php
$output="Create your Restaurant Account!!!";
if(isset($_POST['submit']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $restaurantname = $_POST['restaurantname'];
    $address = $_POST['address'];
    $number=$_GET['number'];
    $sql_u = "SELECT * FROM restaurant_details WHERE username='$username'";
  	$res_u = mysqli_query($conn, $sql_u);
    if (mysqli_num_rows($res_u) > 0) {
        $output="Username already taken";
    }
    else
    {
        $sql = "UPDATE restaurant_details SET username='$username', restaurantpassword='$password', restaurantname='$restaurantname', address='$address' where restaurantcontactnumber=$number ";
        mysqli_query($conn, $sql);
        header ("Location:RestaurantLogin.php");
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
            background-color:black;
            background: url('https://images.unsplash.com/photo-1620589125156-fd5028c5e05b?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1965&q=80')no-repeat;
            height:100%;
        }
        .log-form
        {
            margin-top: 25%;
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
            height: 20px;
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
            height: 20px;
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
            height: 20px;
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
        h2
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
            height:20%;
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
    <center>
    <div class="log-form">
        <h2><?php echo $output ?></h2>
        <form method="POST">
        <button disabled>Username</button>
        <input type="text" name="username" placeholder="Username" required/>
        <br>
        <button disabled>Password</button>
        <input type="password" name="password" minlength="4" maxlength="8" placeholder="Password" required />
        <br>
        <button disabled>Restaurant Name</button>
        <input type="text" name="restaurantname" placeholder="Restaurant Name" required/>
        <br>
        <!-- <button disabled>Contact Number</button>
        <input type="number" name="contactnumber" pattern="[1-9]{1}[0-9]{9}" title="Must be of length 10, should not start with 0!" placeholder="Contact Number" required/>
        <br> -->
        <button disabled>Address</button>
        <input type="text" name="address" placeholder="Address" required/>
        <br>
        <input type="submit" name="submit" value="Register">
        <br>
        <p>Already a Registered Restaurant?
        <a class="register" href="RestaurantLogin.php">Login</a></p>
        </form>
      </div>
    </center>
</body>
</html>
