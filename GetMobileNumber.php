<?php
include 'config.php';
$type=$_GET['type'];

if(isset($_POST['submit']))
{
   $number=$_POST['phone'];
   $type=$_GET['type'];
   if($type==1)
   {
      $sql="SELECT * FROM customer_details WHERE customercontactnumber=$number";
      $res=mysqli_query($conn,$sql);
      if (mysqli_num_rows($res) > 0) {
         echo '<script>alert("Number already exist")</script>';
         header("Location:./GetMobileNumber.php?type=$type");
     }
   }
   else
   {
      $sql="SELECT * FROM restaurant_details WHERE restaurantcontactnumber=$number";
      $res=mysqli_query($conn,$sql);
      if (mysqli_num_rows($res) > 0) {
         echo '<script>alert("Number already exist")</script>';
         header("Location:./GetMobileNumber.php?type=$type");
     }
   }
   header("Location:./action_otp.php?type=$type");
}



?>

<html >
   <head>
      <meta charset="UTF-8">
      <style>
         .form
         {
            width:30%;
            height:25%;
            display: table;
            margin:auto;
            margin-top:20%;
            text-align:center;
            background-color:lightgreen;
            border-radius:15%;
         }
         input[type="submit"]
         {
            background-color:skyblue;
         }
         input[type="text"]
         {
            height:30px;
         }
      </style>
   </head>
   <body>
   <div class="form">
      <h2>Provide Phone Number</h2>
     <br>
      <form method="post">
         
         <input type="text" name="phone" placeholder="Enter Phone Number" value="" autofocus="on" required>
         <br><br>
         <input type="submit" value="Send OTP">
      </form>
      </div>
   </body>
</html>


