<?php

include('inc/database.php');
    if(isset($_POST['fpassreset']))
    {
        $email = $con->real_escape_string($_POST['email']);

        $SQLquery = $con->query("SELECT `id` FROM `users` WHERE `email` = '$email'");

        if($SQLquery->num_rows > 0)
        {
            $generate_token = "1234567890abcdefghijklmnopqrstuvwxyz";
            $generate_token = str_shuffle($generate_token);
            $generate_token = substr($generate_token, 0, 15);
	$passwordhashed = password_hash($password, PASSWORD_BCRYPT);
            $special_url = "https://digidripz.us/test2/resetpassword.php?token=$generate_token&email=$email";
            mail($email, "Digi Dripz Generator Password Reset Inquiry", "Hey there, you have recently requested a password request use the link to reset it \n $special_url THIS IS AN AUTOMATED RESPONSE. 
***DO NOT RESPOND TO THIS EMAIL****", "From: support@digidripz.us\r\n");

            $con->query("UPDATE `users` SET token = '$generate_token' WHERE email = '$email'");

            echo '<br><p> <div class="alert alert-success">
  <strong>Successful</strong> Please check your email for a password reset link , Make sure to check your SPAM folder if its not in your inbox - Thanks 
</div>';
        }
        else
        {
            echo '<br><p> <div class="alert alert-danger">
  <strong>Error</strong> This email is not in our database, please use the email you signed up with 
</div> </p>';
        }
     }
     $result = mysqli_query($con, "SELECT * FROM `settings` LIMIT 1") or die(mysqli_error($con));
while($row = mysqli_fetch_assoc($result)){
    $website = $row['website'];
    $favicon = $row['favicon'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="<?php echo $favicon;?>">

    <!-- Page title -->
    <title>Forgot Password</title>

    <!-- Vendor styles -->
    <link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.css"/>
    <link rel="stylesheet" href="vendor/animate.css/animate.css"/>
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.css"/>

    <!-- App styles -->
    <link rel="stylesheet" href="styles/pe-icons/pe-icon-7-stroke.css"/>
    <link rel="stylesheet" href="styles/pe-icons/helper.css"/>
    <link rel="stylesheet" href="styles/stroke-icons/style.css"/>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body class="blank">

<!-- Wrapper-->
<div class="wrapper">


    <!-- Main content-->
    <section class="content">


        <div class="container-center animated slideInDown">


            <div class="view-header">
                <div class="header-icon">
                    <i class="pe page-header-icon pe-7s-unlock"></i>
                </div>
                <div class="header-title">
                    <h3>Password Recovery</h3>
                    <small>
                        Please follow the instruction to continue 
                    </small>
                </div>
            </div>
<div class="panel panel-filled">
                <div class="panel-body">
                     <form class="form-signin" action="forgotpassword.php" method="POST">
                        <div class="form-group">
                            <label class="control-label" for="email">Your Email</label>
                            <form method="post" action="forgotpassword.php" style="margin-left: 500px; margin-right: 500px;">
                            <input type="text" id="email" name="email" class="form-control" placeholder="Enter your email here..." required>
                            <span class="help-block small">Please enter your email to recive a message </span>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary brn-block" name="fpassreset">Submit</button>
                            <a class="btn btn-default pull-right" href="login.php">Login</a>
                            <a class="btn btn-default pull-right" href="register.php">Register</a>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </section>
    <!-- End main content-->
    
   


</div>
<!-- End wrapper-->

<!-- Vendor scripts -->
<script src="vendor/pacejs/pace.min.js"></script>
<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- App scripts -->
<script src="scripts/luna.js"></script>

</body>

</html>