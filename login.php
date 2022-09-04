<?php
ob_start();
include 'inc/database.php';
$result = mysqli_query($con, "SELECT * FROM `settings` LIMIT 1") or die(mysqli_error($con));
while($row = mysqli_fetch_assoc($result)){
    $website = $row['website'];
    $favicon = $row['favicon'];
}
if (!isset($_SESSION)) { 
    session_start(); 
}
if (isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}


if(isset($_POST['LogMein'])){
    $username = htmlspecialchars($_POST['usernameoremail']);
	$password = htmlspecialchars($_POST['password']);
	$passwordhashed = password_hash($password, PASSWORD_BCRYPT);
	
    $result = mysqli_query($con, "SELECT * FROM `users` WHERE `username` = '$username' OR `email` = '$username'") or die(mysqli_error($con));
	
    $ip = $_SERVER['REMOTE_ADDR'];
    mysqli_query($con, "INSERT INTO `login_logs` (`username`, `ip`) VALUES ('$username', '$ip')") or die(mysqli_error($con));
    if(mysqli_num_rows($result) < 1)
	{
       header("Location: login.php?error=no-exist");
    }
    while($row = mysqli_fetch_array($result))
	{
		if(password_verify($password,$row['password']))
		{
			if($row['status'] == "0")
			{
			;;	header("Location: login.php?error=banned");
			}
			if($row['active'] == "0")
			{
			;;	header("Location: login.php?error=verify");
			}
			else
			{
				$_SESSION['id'] = $row['id'];
				$id = $_SESSION['id'];
				$_SESSION['username'] = $row['username'];
				$_SESSION['email'] = $row['email'];
				$_SESSION['rank'] = $row['rank'];
				$ip = $_SERVER['REMOTE_ADDR'];
				mysqli_query($con, "UPDATE `users` SET `ip` = '$ip' WHERE `id` = '$id'") or die(mysqli_error($con));
                header("Location: index.php");
			}
		}		
		else
		{
           header("Location: login.php?error=incorrect-password");
		}	
    }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>
      <?php echo $website ?>
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo $website ?>, Account, Premium, Cheap, Netflix, free, Spotify, Hulu, account gen, account generator, Best, Minecraft, Account Gen, Amazon, account, topaccgen, best account generator, cheap account generator, topaccgen generator">
    <meta name="description" content="<?php echo $website ?> is the best account generator on the market! Generate thousands of premium accounts for a small one time cost. Generate Netflix, Hulu, Minecraft, and much more Free to Sign Up!">
    <meta name="author" content="Best Account Generator">
    <link rel="shortcut icon" href="<?php echo $favicon ?>">
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="ll_files/bootstrap.css">
    <link rel="stylesheet" href="ll_files/icons.css">
    <link rel="stylesheet" type="text/css" href="ll_files/style.css">
    <link rel="stylesheet" type="text/css" href="ll_files/responsive.css">
    <link rel="stylesheet" type="text/css" href="ll_files/color.css">
	<link href="css/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
  </head>
  <body onload="test(this)">
    <div class="pageloader" style="display: none;">
      <div class="loader">
        <div class="cssload-thecube"> 
          <div class="cssload-cube cssload-c1">
          </div> 
          <div class="cssload-cube cssload-c2">
          </div> 
          <div class="cssload-cube cssload-c4">
          </div> 
          <div class="cssload-cube cssload-c3">
          </div>
        </div>                                    
      </div>
    </div>
    <!-- Page Loader -->
    <div class="login-page" style="height: 600px;">
      <div class="login-box">
        <br>
        <center> 
          <h3 style="font-weight:bold;color:#6991f7;text-shadow: 0px 0px 7px #6991f7">
            <?php echo $website ?> - Login
          </h3>
        </center>
        <strong>Login To Your Account
        </strong>
        <form method="POST" action="login.php" class="form-signin">
            <div class="form-group">
                <?php 
    				if($_GET['error'] == "incorrect-password"){
    					echo '<div class="alert alert-danger alert-alt"><center><strong>Your Password Is Incorrect</strong></center> <br> <center>Please Try Again</center></div>';
    				} 
    				if($_GET['error'] == "banned"){
    					echo '<div class="alert alert-danger alert-alt"><center><strong>Your Account Has Been Banned</strong></center></div>';
    				} 
    				if($_GET['error'] == "no-exist"){
    					echo '<div class="alert alert-danger alert-alt"><center><strong>There Isnt An Account With Those Details</strong></center></div>';
    				} 
				?>
            </div>
          <div class="form-group">
            <label class="control-label" for="username">Username or Email
            </label>
            <input type="text" id="usernameoremail" name="usernameoremail" class="form-control" placeholder="Enter Your Username | Email" required>
            <span class="help-block small">Your unique username
            </span>
          </div>
          <div class="form-group">
            <label class="control-label" for="password">Password
            </label>
            <input type="password" id="password" name="password" class="form-control" placeholder="********" required>
            <span class="help-block small">Your strong password
            </span>
          </div>
             
                     <button type="submit" name="LogMein" id="LogMein" class="btn btn-primary">Login</button>
            
                     <a class="btn btn-default" href="register.php">Register</a>
              
                    <a class="btn btn-default" href="forgotpassword.php">Forgot Password</a>
     
        </form>
       </div>
    </div>
    </div>
  </section>
<!-- End main content-->
</div>
<!-- End wrapper-->
<style>
  a:hover {
    cursor: pointer;
  }
  a {
    display: inline-block;
    position: relative;
    text-decoration: none;
    &:hover {
      @linkBlue: #0000ee;
      a {
        color: @linkBlue;
        display: inline-block;
        position: relative;
        text-decoration: none;
        &:before {
          background-color: @linkBlue;
          content: '';
          height: 2px;
          position: absolute;
          bottom: -1px;
          transition: width 0.3s ease-in-out;
          width: 100%;
        }
        &:hover {
          &:before {
            width: 0;
          }
        }
      }
</style>
</form>		
</div>
</div>
<script src="ll_files/jquery.js">
</script>
<script src="ll_files/bootstrap.js">
</script>
<script src="ll_files/toggles.js">
</script>
<script src="ll_files/isotope.js">
</script>
<script src="ll_files/script.js">
</script>

<script src="css/toastr.min.js"></script>
<script type="text/javascript">
  jQuery(document).ready(function(){
    var full_height = $(window).height();
    $('.login-page').css({
      "height":full_height            
    }
                        );
  }
                        );
</script>

</body>
<?php
if(isset($_GET['error'])){
	echo "<script type='text/javascript'>
	$(document).ready(function(){
	$('#error').modal('show');
	});
	</script>"
	;
}
?>
</html>
