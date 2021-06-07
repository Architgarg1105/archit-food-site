<?php
include 'config.php';
?>
<?php
$customerid=$_GET['cus_id'];
$sql="SELECT * FROM customer_details WHERE customerid='$customerid'";
$res=mysqli_query($conn,$sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Document</title>
</head>
<style>
       
       body
        {
            background: rgb(228, 167, 35);
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
        h1
        {
            text-align:center;
            font-weight:bold;
        }
        tr 
        {
            border: 1px solid black;
            padding-left:20px;
        }
        th {
            border: 1px solid black;
            padding-left:20px;
            font-size:30px;
        }
        td 
        {
            padding:20px;
            font-size:25px;
            color:lightgreen;
        }
        table 
        {
            width:40%;
            margin:auto;
            border: 1px solid black;
        }
</style>
<body>
        <div class="navbar">
        <a class="home" href="index.php?cus_id=<?php echo $_GET['cus_id']?>"><p ><button type="button" class="btn btn-primary btn-lg">Home</button></p></a>
        <i class='fas fa-user-alt' style='font-size:36px'></i>
        </div>
        <div>
        <br>
        <br>
        <br>
        <br>
       <h1>Profile Page</h1>
       <br>
       <br>
<table>
        <?php
        while($ar = mysqli_fetch_assoc($res))
        {
                $ret[] = $ar;
        }
            foreach($ret as $ap)
            {
                $customername=$ap['customername'];
                $customercontactnumber=$ap['customercontactnumber'];
                $address=$ap['address'];
                $preferance=$ap['preferance'];
            ?>
                <tr>
                <th>Customer Name</th>
                <td><?php echo $customername; ?></td>
                </tr>
                <tr>
                <th>Contact Number</th>
                <td><?php echo $customercontactnumber; ?></td>
                </tr>
                <tr>
                <th>Address</th>
                <td><?php echo $address; ?></td>
                </tr>
                <tr>
                <th>Food Preferance</th>
                <td><?php echo $preferance; ?></td>
                </tr>
        <?php 
     } ?>
    </table>
    </div>
</body>
</html>