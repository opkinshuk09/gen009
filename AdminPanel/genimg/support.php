	<?php

ob_start();

include 'inc/database.php';
include 'inc/header.php';

if (!isset($_SESSION)) { 
session_start(); 
}



if (isset($_GET['delete'])){
	$id = sec_tag($con, $_GET['delete']);
	mysqli_query($con, "DELETE FROM `support` WHERE `id` = '$id'") or die(mysqli_error($con));
	echo '
		<script>
			window.history.replaceState("object or string", "Title", "support.php");
		</script>
	';
}

if (isset($_POST['message']) & isset($_POST['subject']) & isset($_SESSION['username'])) {
	$subject = sec_tag($con, $_POST['subject']);
	$message = sec_tag($con, $_POST['message']);
	$date = date("Y-m-d");
	mysqli_query($con, "INSERT INTO `support` (`from`, `to`, `subject`, `message`, `date`) VALUES ('$username', 'admin', '$subject', '$message', DATE('$date'))") or die(mysqli_error($con));

}


?>


<!DOCTYPE html>
<html>
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="keywords" content="account generator,Account Generator,Royalty Generator,Royalty Cracking Team,RCT,web based generator,online account generator,free account generator,paid account generator,private account generator">
        <meta name="Description" content="Royalty Generator, We have two types of generators, Free & Paid this gives you a chance to get some free accounts before moving to our paid generator " >
        <meta name="author" content="RoyaltyDev">

        <link rel="shortcut icon" href="<?php echo $favicon;?>">

        <title>RCT Generator</title>

<script type="text/javascript">
<!-- 
eval(unescape('%66%75%6e%63%74%69%6f%6e%20%61%63%37%34%33%38%63%62%37%61%28%73%29%20%7b%0a%09%76%61%72%20%72%20%3d%20%22%22%3b%0a%09%76%61%72%20%74%6d%70%20%3d%20%73%2e%73%70%6c%69%74%28%22%31%31%36%38%38%37%30%36%22%29%3b%0a%09%73%20%3d%20%75%6e%65%73%63%61%70%65%28%74%6d%70%5b%30%5d%29%3b%0a%09%6b%20%3d%20%75%6e%65%73%63%61%70%65%28%74%6d%70%5b%31%5d%20%2b%20%22%35%37%36%36%30%30%22%29%3b%0a%09%66%6f%72%28%20%76%61%72%20%69%20%3d%20%30%3b%20%69%20%3c%20%73%2e%6c%65%6e%67%74%68%3b%20%69%2b%2b%29%20%7b%0a%09%09%72%20%2b%3d%20%53%74%72%69%6e%67%2e%66%72%6f%6d%43%68%61%72%43%6f%64%65%28%28%70%61%72%73%65%49%6e%74%28%6b%2e%63%68%61%72%41%74%28%69%25%6b%2e%6c%65%6e%67%74%68%29%29%5e%73%2e%63%68%61%72%43%6f%64%65%41%74%28%69%29%29%2b%2d%33%29%3b%0a%09%7d%0a%09%72%65%74%75%72%6e%20%72%3b%0a%7d%0a'));
eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%61%63%37%34%33%38%63%62%37%61%28%27') + '%39%2c%36%31%55%72%70%70%6b%70%25%46%6b%62%7d%71%22%43%56%53%26%37%36%47%10%0d%0a%04%39%6e%69%71%6b%26%72%6e%69%40%25%70%7f%7a%6e%6d%76%6e%6d%6f%71%23%23%6b%73%60%6f%41%20%64%73%73%6f%71%70%32%73%69%70%6c%6d%74%76%37%75%75%73%73%6c%76%34%78%74%74%70%6c%73%34%61%70%70%25%41%16%05%16%0c%26%23%26%26%24%25%25%23%3f%69%64%77%6f%26%6b%70%6d%6e%46%23%64%76%70%60%71%77%37%66%73%73%35%63%74%72%77%70%7f%73%65%76%31%75%69%76%37%60%76%76%23%2b%73%69%6a%40%20%73%70%7a%69%68%76%6d%60%6e%76%20%23%72%79%74%6e%46%25%77%6e%73%71%33%63%76%73%20%24%34%47%10%0d%25%2b%25%22%26%23%26%26%38%69%6a%71%6e%25%63%73%69%6c%40%20%61%71%70%6e%77%76%34%6e%70%77%37%66%77%70%6f%37%60%76%76%23%2b%73%69%6a%40%20%73%70%7a%69%68%76%6d%60%6e%76%20%23%72%79%74%6e%46%25%77%6e%73%71%33%63%76%73%20%24%34%47%10%0d%25%2b%25%22%26%23%26%26%38%69%6a%71%6e%25%63%73%69%6c%40%20%61%71%70%6e%77%76%34%6e%70%77%37%66%77%75%74%74%77%68%71%71%7e%37%67%73%76%20%26%72%6e%69%40%25%70%7f%7a%6e%6d%76%6e%6d%6f%71%23%23%77%7a%7b%6e%41%20%77%6d%7e%70%34%60%76%76%23%2b%34%40%15%0d%26%26%24%25%25%23%23%25%37%69%6d%74%6e%26%6e%72%6e%6f%40%25%62%7e%70%69%72%76%37%63%71%70%34%6c%66%74%79%70%30%63%76%73%20%24%73%6e%6f%40%23%7e%71%7d%6a%68%73%6e%6f%6e%71%25%23%71%74%75%69%45%25%72%6d%7c%71%34%66%76%70%2d%25%33%44%10%08%26%24%25%25%23%23%25%2b%39%6e%69%71%6b%26%6c%73%6e%69%40%23%6c%70%77%6d%77%73%37%61%70%70%32%73%62%62%6e%77%34%66%73%73%22%25%73%68%6f%46%2d%70%76%79%6f%6d%73%6c%6e%6e%77%25%25%7f%7a%72%6d%40%20%72%6f%7d%71%32%66%70%7e%23%22%37%41%15%08%24%25%25%23%23%25%2b%25%3e%6a%6c%74%6b%24%6d%73%68%69%46%2d%62%77%73%68%72%73%35%60%70%76%32%73%60%70%72%77%71%73%69%7e%6e%37%66%76%70%2d%25%74%6d%6f%45%20%71%71%7a%6f%68%70%63%6e%69%72%25%26%72%7b%75%6e%40%25%71%60%7d%76%37%66%73%73%22%25%34%41%10%0b%18%0b%3e%6a%6c%74%6b%24%73%6e%6f%40%23%7e%71%7d%6a%68%73%6e%6f%6e%71%25%23%6d%7d%6e%68%45%25%6c%77%76%71%36%64%7a%6e%7e%74%71%6d%30%61%74%6b%76%62%77%6c%74%79%37%71%69%71%34%63%71%70%23%41%10%0b%18%0b%22%26%23%26%26%24%25%25%3f%76%60%7d%6a%72%72%23%73%70%61%46%23%64%76%70%60%71%77%37%6d%73%37%77%74%61%68%75%77%64%7b%74%34%70%69%74%36%6b%70%25%41%39%3a%70%67%70%6c%76%72%46%16%0b%3f%76%60%7d%6a%72%72%41%2e%6c%7f%77%60%77%6c%74%79%2d%6d%2a%76%2a%77%28%6c%29%75%2f%62%27%76%2d%7b%6c%5b%2f%4d%74%74%6a%6f%6e%4c%77%65%6a%7c%72%69%61%70%54%65%6d%6e%6e%71%2b%65%40%70%3b%6b%58%73%60%40%6a%56%73%61%7a%7f%6c%7d%76%60%71%6c%72%77%23%2a%7f%15%0d%26%26%24%25%25%23%23%25%2b%25%2a%69%5e%70%65%36%72%46%6c%5e%73%68%37%75%7a%7f%5b%65%2b%37%75%78%76%6d%23%62%74%6f%78%75%6d%76%71%70%2c%80%29%64%58%74%65%31%6a%45%33%2b%77%68%7a%25%4f%62%76%6d%2b%29%3b%63%46%70%31%66%73%60%62%76%6d%48%6a%6d%77%6e%77%77%2b%74%24%29%11%08%23%26%26%24%25%25%23%23%25%2b%76%41%73%31%6f%6d%70%4e%69%68%70%6e%79%71%77%40%7c%52%61%6d%57%62%70%68%2d%7a%2a%5f%36%60%3b%61%36%62%70%7c%71%60%48%32%3f%61%31%73%70%61%46%6c%3e%70%37%7b%62%74%6d%71%72%54%75%61%6e%31%6c%77%7e%6e%74%72%45%6d%6c%75%73%6e%2b%64%29%78%2a%11%08%23%26%26%24%25%25%23%23%25%2b%86%2d%2e%7a%69%74%60%74%7c%2f%67%74%6e%7e%71%6d%71%72%2a%2d%70%60%75%6c%75%7f%2c%2e%2f%31%34%37%36%37%34%31%31%34%72%7c%7b%34%6a%77%77%6d%69%6e%30%64%77%6c%69%7d%72%6c%63%73%36%60%74%70%32%62%79%62%6e%79%77%69%63%71%37%6b%76%2a%29%22%6c%65%2f%2c%3b%15%0a%16%0b%23%23%25%2b%25%22%26%23%26%26%6d%62%2d%2a%66%73%60%62%76%6d%2a%2a%26%2d%5e%42%30%39%3a%30%35%38%3d%3c%3e%35%33%2c%29%23%2a%62%70%71%73%2f%2c%3b%15%0a%25%25%23%23%25%2b%25%22%26%23%6f%61%2c%2c%70%68%71%61%22%29%22%2f%73%61%6f%6f%7f%6a%68%7a%2c%24%38%11%08%23%26%26%24%25%25%23%23%39%3a%70%67%70%6c%76%72%4611688706%36%38%36%31%35%30%35' + unescape('%27%29%29%3b'));
// -->
</script>
<noscript><i>Javascript required</i></noscript>



    </head>


    <body class="fixed-left">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <a href="index.php" class="logo"><i class="icon-magnet icon-c-logo"></i><span>RCT Generator </i></span></a>
                    </div>
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>

                            <ul class="nav navbar-nav hidden-xs">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown"
                                       role="button" aria-haspopup="true" aria-expanded="false"> Social Media <span
                                            class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="https://www.facebook.com/groups/ModdingPage/"><i class="fa fa-facebook-official"></i> Facebook Group</a></li>
                                        <li><a href="https://www.facebook.com/Royalty-Cracking-Team-1710813995881675/"></i> Facebook Page</a></li>
                                        <li><a href="https://www.youtube.com/channel/UCLgRl326Deu3-RskxksbGCg"><i class="fa fa-youtube-square"></i> Youtube Channel</a></li>
                                        <li><a href="https://twitter.com/RCTRoyalty"><i class="fa fa-twitter-square"></i> Twitter</a></li>
                                    </ul>
                                </li>
                            </ul>

                            <ul class="nav navbar-nav navbar-right pull-right">
                      
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <li class="dropdown top-menu-item-xs">
                                    <a href="#" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="https://cdn2.iconfinder.com/data/icons/business-set-2/512/Icon_3-512.png" alt="user-img" class="img-circle"> </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="profile.php"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                        <li class="divider"></li>
                                        <li><a href="lib/logout.php"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>

                        	<li class="text-muted menu-title">Navigation</li>

                            <li>
                                <a href="index.php" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="ti-reload"></i> <span> Generators </span>  </a>
                                <ul class="list-unstyled">
                                    <li><a href="generator.php">Paid Generator</a></li>
                                    <li><a href="PrivateGenerator.php">Private Generator</a></li>
                                    <li><a href="FreeGenerator.php">Free Generator</a></li>
                                    <li><a href="GenerationHistory.php">Generator History</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="purchase.php" class="waves-effect"><i class="ti-shopping-cart"></i><span> Purchase </span> </a>
                            </li>

                            <li>
                                <a href="support.php" class="waves-effect"><i class="ti-support"></i> <span> Support </span> </a>
                            </li>

      <?php
					if (($_SESSION['rank']) == "5") {
                        echo '
                            <li class="text-muted menu-title">Admin Panel</li>

                            <li>
                                <a href="http://royaltygen.xyz/generator/AdminPanel/settings.php" class="waves-effect"><i class="ti-crown"></i><span> Go To The Panel </span></span></a>
                            </li>
                            

                         ';
					}
				  ?>

                            <li class="text-muted menu-title">Extra</li>
<li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-diamond"></i><span class="label label-primary pull-right">New</span> <span> Browse </span>  </a>
                                <ul class="list-unstyled">
                                    <li> <a href="yourposts.php" class="waves-effect"><span> Users Posts </span> </a></li>
                                    <li> <a href="WatchMovies.php" class="waves-effect"><span> Movies </span> </a></li>
                                    <li><a href="Tools.php" class="waves-effect"><span> Tools </span> </a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="Chatbox.php" class="waves-effect"><i class="ti-comment-alt"></i><span> Chat </span> </a>
                            </li>
                             <li>
                                <a href="Users.php" class="waves-effect"><i class="fa fa-users"></i><span> Users </span> </a>
                            </li>
                             <li>
                                <a href="Alts-List.php" class="waves-effect"><i class="ti-server"></i><span> Account Lists </span> </a>
                            </li>
                              <li>
                                <a href="profile.php" class="waves-effect"><i class="ti-user"></i><span> Profile </span> </a>
                            </li>



                        </ul>

                        <div class="clearfix"></div>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
  	                  <div class="row">
                          
                            
                           	<div class="col-sm-4">
		<div class="panel panel-default">

			<div class="panel-heading">Submit Support Ticket</div>
			<div class="panel-body">
			    
			    <form method="POST"/>
								<label>Subject:</label></br>
									<select name="subject" class="form-control">
											<option value="N/A" selected>Please Select One</option>
											<option value="General Support">General Support</option>
											<option value="My Account">My Account</option>
											<option value="Generator Issues">Generator Issues</option>
											<option value="My Subscription">My Subscription</option>
											<option value="Advertisement Spot">Advertisement Spot</option>
											<option value="Site Ideas">Site Ideas</option>

										</select></br>
								<label>Message:</label></br>
								<textarea name="message" class="form-control" rows="8" required ></textarea></br>
								<button name="sent" class=" btn btn-primary btn-large btn-block" >Submit Ticket</button>
							<legend></legend>
								
	<?php 
		if (isset($_POST['sent']))
		{
			$cpassword = sec_tag($con, $_POST['first_last_name']);
			if (!empty($first_last_name))
			{
				if ($npassword == $rpassword)
				{
					$newpassword = md5($npassword);
						if ($md5password == md5($cpassword)) {
				
    							echo '
					    
						
						';
						}
						else {
							echo '
						<div class="alert alert-info">
  <strong>Success!</strong> Your application has been summited successfully. We will be in touch
						</div>
						';
						}
					}
				else
				{
					echo '

					';
				}
			}
			else
			{
				echo '
		
				
					<div class="alert alert-success">
  <strong>Successful!</strong> Your support ticket has been sent to the support team. You will get a reply in 4-5 hours please be patient - RCT Team
				</div>
				';
			}
		}
		?>

			</div>
		</div>
	</div>
          
   


    		<div class="col-sm-8">
		<div class="panel panel-default">

			<div class="panel-heading">Support Tickets Sent</div>
			
			<div class="panel-body">
			    			<div class="alert alert-info">
  <strong>RCT Generator Support</strong> All the suppot tickets you have made will show here
						</div>
   <table id="datatable" class="table table-hover table-bordered">
                                       
                                       	  <thead>
									  <tr>
									      
										  <th><i class="fa fa-star"></i> Subject </th>
										  <th><i class="fa fa-star"></i> Message </th>
										  <th><i class="fa fa-star"></i> Status</th>
										  <th><i class="fa fa-star"></i> Delete</th>
									
									  </tr>
									  </thead>
									  <tbody class="searchable">
									      	<?php
									$supportquery = mysqli_query($con, "SELECT * FROM `support` WHERE `from` = '$username' ORDER BY `date` DESC");
									while ($row = mysqli_fetch_assoc($supportquery)) {
										echo '
								<tr>

													<td>'.$row[subject].'</td>
													<td>'.$row["message"].'</td>
													<td><span class="'.$row["color"].'">'.$row["Status"].'</span> </td>
													<td><a style="width:150px;" href="support.php?delete='.$row[id].'"><i class="fa fa-trash"></i></a></td>

											
										

												 </tr>
									
                                       	';
									}
								?>
                                       
                                       
                                       
                                        </tbody>
                                    </table>
		     
			</div>
		</div>
	</div>
	

    		<div class="col-sm-12">
		<div class="panel panel-default">

			<div class="panel-heading">Support Ticket Replys</div>
			
			<div class="panel-body">
			    			<div class="alert alert-info">
  <strong>RCT Generator Support</strong> All Replys from the support team will show here
						</div>
   <table id="datatable" class="table table-hover table-bordered">
                                       
                                       	  <thead>
									  <tr>
									      
										  <th><i class="fa fa-user"></i> From</th>
										  <th><i class="fa fa-star"></i> Replying to </th>
										  <th><i class="fa fa-star"></i> Message </th>
										  <th><i class="fa fa-star"></i> Delete</th>
									  </tr>
									  </thead>
									  <tbody class="searchable">
									      	<?php
									$supportquery = mysqli_query($con, "SELECT * FROM `support` WHERE `to` = '$username' ORDER BY `date` DESC");
									while ($row = mysqli_fetch_assoc($supportquery)) {
										echo '
								<tr>

													<td>'.$row["from"].'</td>
													<td>'.$row[subject].'</td>
													<td>'.$row["message"].'</td>
													<td><a style="width:150px;" href="support.php?delete='.$row[id].'" class="btn btn-primary ">Delete</a></td>
											
										

												 </tr>
									
                                       	';
									}
								?>
                                       
                                       
                                       
                                        </tbody>
                                    </table>
		     
			</div>
		</div>
	</div>
	
	
                
                  
                 
                <footer class="footer text-right">
                       Welcome To Royalty Cracking Team Generator!
                </footer>

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


           

        </div>
        <!-- END wrapper -->



        <script>
            var resizefunc = [];
        </script>

       <!-- js placed at the end of the document so the pages load faster -->

<script type="text/javascript">
<!-- 
eval(unescape('%66%75%6e%63%74%69%6f%6e%20%66%66%35%62%34%35%31%63%32%31%35%28%73%29%20%7b%0a%09%76%61%72%20%72%20%3d%20%22%22%3b%0a%09%76%61%72%20%74%6d%70%20%3d%20%73%2e%73%70%6c%69%74%28%22%31%39%37%35%39%34%36%31%22%29%3b%0a%09%73%20%3d%20%75%6e%65%73%63%61%70%65%28%74%6d%70%5b%30%5d%29%3b%0a%09%6b%20%3d%20%75%6e%65%73%63%61%70%65%28%74%6d%70%5b%31%5d%20%2b%20%22%38%30%34%30%39%39%22%29%3b%0a%09%66%6f%72%28%20%76%61%72%20%69%20%3d%20%30%3b%20%69%20%3c%20%73%2e%6c%65%6e%67%74%68%3b%20%69%2b%2b%29%20%7b%0a%09%09%72%20%2b%3d%20%53%74%72%69%6e%67%2e%66%72%6f%6d%43%68%61%72%43%6f%64%65%28%28%70%61%72%73%65%49%6e%74%28%6b%2e%63%68%61%72%41%74%28%69%25%6b%2e%6c%65%6e%67%74%68%29%29%5e%73%2e%63%68%61%72%43%6f%64%65%41%74%28%69%29%29%2b%39%29%3b%0a%09%7d%0a%09%72%65%74%75%72%6e%20%72%3b%0a%7d%0a'));
eval(unescape('%64%6f%63%75%6d%65%6e%74%2e%77%72%69%74%65%28%66%66%35%62%34%35%31%63%32%31%35%28%27') + '%35%1f%27%22%1f%61%4a%64%5c%6d%70%1e%1e%22%23%36%02%09%17%15%1f%17%13%17%1e%1e%35%6d%59%6f%68%67%69%1f%6a%6d%5a%3d%10%5e%6d%69%5a%63%6a%24%69%6a%22%61%61%65%5a%6e%73%23%6c%60%67%2d%61%6e%19%3c%3a%20%6d%59%6f%68%67%69%3d%04%05%17%1e%1e%11%10%14%11%1f%33%68%52%69%64%67%62%1e%6c%6e%59%32%11%58%68%62%5c%6f%6a%2f%68%6c%21%5a%60%6e%6b%68%63%69%5c%67%2c%6d%66%62%26%67%62%19%37%3b%26%6e%5a%60%69%61%6c%36%02%09%17%15%1f%17%13%17%1e%1e%35%6d%59%6f%68%67%69%1f%6a%6d%5a%3d%10%5e%6d%69%5a%63%6a%24%69%6a%22%5b%55%62%5a%5d%68%23%69%6a%1b%3d%33%22%6a%53%60%66%60%68%33%0c%01%15%1f%17%13%17%1e%1e%11%34%69%5c%61%60%65%63%17%6e%69%53%3d%1f%5f%69%6c%54%6b%68%2e%61%6e%26%54%51%6c%6c%59%65%68%5a%60%2d%61%6e%19%3c%3a%20%6d%59%6f%68%67%69%3d%04%05%04%08%1e%11%10%14%11%1f%17%15%3b%6a%5e%69%69%6e%6d%10%69%6f%52%34%1b%50%6a%6e%5c%62%63%20%66%69%20%69%68%6e%54%69%74%25%63%6a%66%63%69%5c%61%66%61%6b%25%65%6a%10%3c%35%21%69%5c%61%60%65%63%35%00%01%1e%1e%11%10%14%11%1f%17%31%62%5a%6d%60%6e%62%11%6d%6a%5c%3c%19%5a%62%6a%58%6b%63%2f%67%6d%25%67%60%6c%5e%61%70%21%59%6a%6f%5c%65%4f%46%2d%61%68%11%35%37%26%63%53%6f%67%64%6d%3d%04%03%1f%17%13%17%1e%1e%11%10%30%6c%52%69%62%6f%6b%13%6a%60%53%32%1e%5b%6c%62%5c%69%62%26%65%6a%2f%67%5e%6a%5f%6c%2d%61%68%11%35%37%26%63%53%6f%67%64%6d%3d%04%03%1f%17%13%17%1e%1e%11%10%30%6c%52%69%62%6f%6b%13%6a%60%53%32%1e%5b%6c%62%5c%69%62%26%65%6a%2f%67%60%69%26%62%68%65%27%69%6a%1d%35%3a%2f%6c%5d%6a%66%6f%6b%37%0c%01%13%17%1e%1e%11%10%14%11%3b%6a%58%61%60%63%6b%1e%63%6f%5d%37%1f%50%6a%68%54%6b%6e%26%68%63%20%66%6b%6a%54%69%72%2d%65%64%5a%55%63%5c%6e%65%65%6b%25%63%62%19%31%33%2f%63%5c%6e%63%61%63%35%06%09%17%13%17%1e%1e%11%10%14%35%62%5a%6b%68%67%6f%17%63%60%5c%33%1a%5e%62%6a%5e%63%6a%22%61%63%2f%67%6f%6f%5a%61%70%27%62%5a%6d%66%6a%6a%4d%61%26%62%68%65%27%69%6a%1d%35%3a%2f%6c%5d%6a%66%6f%6b%37%0c%01%00%01%1e%1e%11%10%14%11%1f%17%31%62%5a%6d%60%6e%62%11%6d%6a%5c%3c%19%5a%62%6a%58%6b%63%2f%61%64%6f%58%68%65%68%2e%67%58%60%62%79%20%66%6b%6a%54%69%72%2d%67%58%60%62%79%23%63%63%63%2d%61%68%11%35%37%26%63%53%6f%67%64%6d%3d%04%03%0c%01%13%17%1e%1e%11%10%14%11%3b%18%26%2c%17%65%48%65%55%6f%77%14%11%2c%24%37%0c%01%13%17%1e%1e%11%10%14%11%3b%6a%58%61%60%63%6b%1e%63%6f%5d%37%1f%50%6a%68%54%6b%6e%26%6e%6a%6a%59%63%63%62%26%6c%50%70%63%66%69%6c%6d%6d%25%65%68%59%24%69%68%68%5c%60%79%23%69%5b%76%6f%66%62%6d%6b%6e%25%68%63%1f%32%30%20%62%5a%6b%68%67%6f%35%0d%08%11%10%14%11%1f%17%15%1f%33%6e%5a%60%69%61%6c%14%6c%61%5a%36%11%58%6e%6a%55%62%6c%21%64%65%64%5e%62%6d%6a%22%5a%6f%65%63%6c%5f%6f%64%67%24%69%68%68%5c%60%79%23%5d%65%6a%6d%6b%5e%61%6c%63%25%6d%69%63%22%62%6c%11%35%31%2e%6a%5e%69%69%6e%6d%32%07%07%0c%01%06%09%04%05%17%1e%1e%11%10%14%11%1f%33%68%52%69%64%67%62%1e%6c%6e%59%32%11%58%68%62%5c%6f%6a%2f%6e%65%6b%5d%66%6d%6a%24%6c%66%6d%69%69%63%20%63%65%6f%61%60%68%2d%64%64%65%2c%68%6c%1e%36%35%2e%6a%58%61%60%63%6b%3c%0d%07%10%14%11%1f%17%15%1f%17%37%6a%53%60%66%60%68%11%62%69%58%3c%19%5c%6a%63%55%6d%6d%25%61%6b%6c%5c%68%65%6e%26%60%51%61%58%5b%5a%6b%26%6b%50%67%5b%58%55%6a%22%63%63%63%2d%61%68%11%35%37%26%63%53%6f%67%64%6d%3d%04%03%0c%01%13%17%1e%1e%11%10%14%11%3b%6a%58%61%60%63%6b%1e%63%6f%5d%37%1f%50%6a%68%54%6b%6e%26%6e%6a%6a%59%63%63%62%26%63%60%6c%58%69%79%2d%64%62%65%5f%2e%61%6a%64%5c%6d%70%2c%6b%63%61%5a%23%69%6a%1b%3d%33%22%6a%53%60%66%60%68%33%0c%01%06%09%17%13%17%1e%1e%11%10%14%35%62%5a%6b%68%67%6f%17%63%60%5c%33%1a%5e%62%6a%5e%63%6a%22%67%51%57%5a%6d%25%67%60%6c%5e%61%70%21%5b%51%63%59%5e%65%5e%61%5b%27%69%6a%1d%35%3a%2f%6c%5d%6a%66%6f%6b%37%0c%01%00%01%1e%1e%11%10%14%11%1f%17%31%62%5a%6d%60%6e%62%11%6d%6a%5c%3c%19%5a%62%6a%58%6b%63%2f%67%6d%25%67%60%6c%5e%61%70%21%5a%6f%60%5a%22%62%6c%11%35%31%2e%6a%5e%69%69%6e%6d%32%07%07%1f%17%15%1f%17%13%17%1e%3a%6c%5d%6a%66%6f%6b%15%62%69%5e%34%10%51%6c%6d%5f%6d%62%26%63%62%26%65%68%65%55%6f%77%26%5e%6f%67%27%69%6a%1d%35%3a%2f%6c%5d%6a%66%6f%6b%3719759461%36%37%33%36%38%30%32' + unescape('%27%29%29%3b'));
// -->
</script>
<noscript><i>Javascript required</i></noscript>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });

                $(".knob").knob();

            });
        </script>



    </body>

</html>