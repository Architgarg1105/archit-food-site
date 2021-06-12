<?php
include 'config.php';
$type=$_GET['type'];
$mobile= $_POST['phone'];

    #### 2Factor API Setting
    $APIKey='c57cdb75-c7af-11eb-8089-0200cd936042';
    $OTPMessage="<p>We have sent an OTP to $mobile,<br>Please enter the same below</p>";
    
    #### Custom Logic
    $otpValue=(( isset($_REQUEST['otp']) AND $_REQUEST['otp']<>'' ) ? $_REQUEST['otp'] : '' );
    
    if ( $otpValue =='' AND $mobile=="")
    {
        echo "<script type='text/javascript'> window.history.back(); </script>";
        die();
    }
    else
    if ( $mobile =='' AND $email=='' )
    {
        echo "<script type='text/javascript'> alert('Please provide either a mobile number or an email address to proceed');window.history.back(); </script>";
        die();
    }
    else if (  $mobile =='' AND $email <> '' )
    $forceSubmitWithEmail=1;

    if ( ( $mobile =='' OR strlen($mobile) <>10 OR substr($mobile,0,2) < 60) AND $email =='')
    {
        echo "<script type='text/javascript'> alert('Please enter valid mobile number');window.history.back(); </script>";
        die();
    }
     if ( $otpValue <> '') ### OTP value entered by user
    {
        ### Check if OTP is matching or not
        $VerificationSessionId=$_REQUEST['VerificationSessionId'];
        $API_Response_json=json_decode(file_get_contents("https://2factor.in/API/V1/$APIKey/SMS/VERIFY/$VerificationSessionId/$otpValue"),false);
        $VerificationStatus= $API_Response_json->Details;
            
            ### Check if OTP is matching
            if ( $VerificationStatus =='OTP Matched')
            {
                $type=$_GET['type'];
                if($type==1)
                {
                    $sql_u = "SELECT * FROM customer_details WHERE customercontactnumber='$mobile'";
                    $res_u = mysqli_query($conn, $sql_u);
                    if (mysqli_num_rows($res_u) > 0) {
                        echo "<script>alert('Number Already Exists!!!');
                        window.location.href='./GetMobileNumber.php?type=$type'; 
                        </script>";
                    }
                    else
                    {
                        $sql = "INSERT INTO customer_details (customercontactnumber) VALUES ( '$mobile')";
                        mysqli_query($conn, $sql);
                        header("Location:./CustomerRegister.php?number=$mobile");
                    }
                    die();
                }
                else
                {
                    $sql_u = "SELECT * FROM restaurant_details WHERE restaurantcontactnumber='$mobile'";
                    $res_u = mysqli_query($conn, $sql_u);
                    if (mysqli_num_rows($res_u) > 0) {
                        echo "<script>alert('Number Already Exists!!!');
                        window.location.href='./GetMobileNumber.php?type=$type'; 
                        </script>";
                        // header("Location:./GetMobileNumber.php?type=$type");
                        
                    }
                    else
                    {
                        $sql = "INSERT INTO restaurant_details( restaurantcontactnumber) VALUES ( '$mobile')";
                        mysqli_query($conn, $sql);
                        header("Location:./RestaurantRegister.php?number=$mobile");
                    }
                    die();
                }
                
            }
            else
            {
                echo "<script type='text/javascript'>alert('Sorry, OTP entered was incorrect. Please enter correct OTP');  window.history.back();  </script>";
                die();
            }
        
    }
    else
    {    
            ### Send OTP
            $API_Response_json=json_decode(file_get_contents("https://2factor.in/API/V1/$APIKey/SMS/$mobile/AUTOGEN"),false);
            $VerificationSessionId= $API_Response_json->Details;
            
    }

?>



<!--HTML Part-->


<html>
   <head>
      <meta charset="UTF-8">
      <style>
         form
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
      <form action="action_otp.php?type=<?php echo $type; ?>" method="post">
      <h2>Enter OTP</h2>
      <br>
         <input type="text" id='otp' name="otp" maxlength="6" placeholder="Enter OTP"  required="required">	
         <br>
         <br>
         <input type="hidden"  name="VerificationSessionId" value="<?php echo $VerificationSessionId; ?>" >
         <input type="hidden" name="name" value="<?php echo $name; ?>"  >	
         <input type="hidden"  name="email" value="<?php echo $email; ?>" >	
         <input type="hidden"  name="phone" value="<?php echo $mobile; ?>" >
         <input type="submit" value="Submit">
      </form>
   </body>
</html>