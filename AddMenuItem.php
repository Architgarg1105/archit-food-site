<?php
include 'config.php';
?>

<?php
$output="Add Items In Your Menu!!!";
if(isset($_POST['submit']))
{
    $itemname = $_POST['itemname'];
    $price = $_POST['price'];
    $category = $_POST['category'];
        $resid=$_GET['res_id'];
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
    .form-style-6{
	font: 95% Arial, Helvetica, sans-serif;
	max-width: 400px;
	padding: 16px;
	background: #F7F7F7;
}
h1
{
    text-align:center;
    font-weight:bold;
}
.form-style-6 h1{
	background: #43D1AF;
	padding: 20px 0;
	font-size: 140%;
    font-weight:bold;
	text-align: center;
	color: #fff;
	margin: -16px -16px 16px -16px;
}
.form-style-6 input[type="text"],
.form-style-6 input[type="date"],
.form-style-6 input[type="datetime"],
.form-style-6 input[type="email"],
.form-style-6 input[type="number"],
.form-style-6 input[type="search"],
.form-style-6 input[type="time"],
.form-style-6 input[type="url"],
.form-style-6 textarea,
.form-style-6 select 
{
	-webkit-transition: all 0.30s ease-in-out;
	-moz-transition: all 0.30s ease-in-out;
	-ms-transition: all 0.30s ease-in-out;
	-o-transition: all 0.30s ease-in-out;
	outline: none;
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	width: 100%;
	background: #fff;
	margin-bottom: 4%;
	border: 1px solid #ccc;
	padding: 3%;
	color: #555;
	font: 95% Arial, Helvetica, sans-serif;
}
.form-style-6 input[type="text"]:focus,
.form-style-6 input[type="date"]:focus,
.form-style-6 input[type="datetime"]:focus,
.form-style-6 input[type="email"]:focus,
.form-style-6 input[type="number"]:focus,
.form-style-6 input[type="search"]:focus,
.form-style-6 input[type="time"]:focus,
.form-style-6 input[type="url"]:focus,
.form-style-6 textarea:focus,
.form-style-6 select:focus
{
	box-shadow: 0 0 5px #43D1AF;
	padding: 3%;
	border: 1px solid #43D1AF;
}

.form-style-6 input[type="submit"],
.form-style-6 input[type="button"]{
	box-sizing: border-box;
	-webkit-box-sizing: border-box;
	-moz-box-sizing: border-box;
	width: 100%;
	padding: 3%;
	background: #43D1AF;
	border-bottom: 2px solid #30C29E;
	border-top-style: none;
	border-right-style: none;
	border-left-style: none;	
    font-weight:bold;
	color: #fff;
}
.form-style-6 input[type="submit"]:hover,
.form-style-6 input[type="button"]:hover{
	background: #2EBC99;
}
</style>
    
</head>
<body>
<nav class="navbar" style="padding-bottom:1%;background-color:#43D1AF;"><h1>Add Items</h1>
<div class="dropdown" style="position:fixed;top:3%;left:85%;"> 
<?php 
    if (isset($_GET['res_id'])) { 
        $restau_id=$_GET['res_id'];
        $sql = "SELECT restaurantname FROM restaurant_details where restaurantid='$restau_id'";
        $res = mysqli_query($conn, $sql);
        $temp = mysqli_fetch_array($res);
        $restau_name=$temp['restaurantname'];
        ?>
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php echo($restau_name);?> <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a onMouseOver="this.style.fontWeight='bold'" onMouseOut="this.style.fontWeight='normal'" href="ViewOrders.php?res_id=<?php echo $_GET['res_id']?>">View Orders</a></li>
                    <hr>
                    <div class="dropdown-divider"></div>
                    <li><a onMouseOver="this.style.fontWeight='bold',this.style.color='red'" onMouseOut="this.style.fontWeight='normal',this.style.color='#000000'"  class="dropdown-item" href="index.php">Log Out</a></li>
                </ul>
           
            <?php } ?>
            </div>  
            </nav>
    <center>
    <div class="form-style-6" style="margin-top:10%;">
            <h1><?php echo $output ?></h1>
            <form method="POST" >
            <input type="text" name="itemname" placeholder="Item Name" required/>
            <input type="number" name="price" placeholder="Price" required/>
            <input type="text" name="category" placeholder="Veg/Non-Veg" required/>
            <input type="submit" name="submit" value="Submit">
            </form>
    </div>
    </center>
</body>
</html>