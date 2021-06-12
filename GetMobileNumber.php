<?php
include 'config.php';
$type=$_GET['type'];
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
      <form method="post" action="action_otp.php?type=<?php echo $type;?>">
         
         <input type="text" name="phone" placeholder="Enter Phone Number" value="" autofocus="on" required>
         <br><br>
         <input type="submit" name="submit" value="Send OTP">
      </form>
      </div>
   </body>
</html>


