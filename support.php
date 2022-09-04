	<?php

ob_start();

include 'inc/database.php';
include 'inc/header.php';

if (!isset($_SESSION)) { 
session_start(); 
}
// Create a new CSRF token.
if (! isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
}
// Check a POST is valid.
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    // POST data is valid.
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
// Test Input Function
function testInput($data){
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}
// Username Verification
$message = testInput($_POST['message']);
if (!preg_match("/^[a-zA-Z ]*$/",$message)) {
$message = mysqli_real_escape_string($con, $message);
die("In message field Only letters allowed"); 
}


if (isset($_POST['message']) & isset($_POST['subject']) & isset($_SESSION['username'])) {
	$subject = mysqli_real_escape_string($con, $_POST['subject']);
	$message = mysqli_real_escape_string($con, $_POST['message']);
	$username = $_SESSION['username'];
	$date = date("Y-m-d");
	mysqli_query($con, "INSERT INTO `support` (`from`, `to`, `subject`, `message`, `date`) VALUES ('$username', 'admin', '$subject', '$message', DATE('$date'))") or die(mysqli_error($con));
}
$totalalts = 0;
$result = mysqli_query($con, "SELECT * FROM `generators`") or die(mysqli_error($con));

while($row = mysqli_fetch_assoc($result)) {
	$result2 = mysqli_query($con, "SELECT * FROM `generator$row[id]` WHERE `status` != '0'") or die(mysqli_error($con));
	$totalalts = $totalalts + mysqli_num_rows($result2);
}
$result = mysqli_query($con, "SELECT * FROM `freegenerators`") or die(mysqli_error($con));

while($row = mysqli_fetch_assoc($result)) {
    $result2 = mysqli_query($con, "SELECT * FROM `freegenerator$row[id]` WHERE `status` != '0'") or die(mysqli_error($con));
    $totalfree = $totalfree + mysqli_num_rows($result2);
}

$totalfreenpaid = $totalalts + $totalfree + $privtotalalts;
$result = mysqli_query($con, "SELECT * FROM `users`") or die(mysqli_error($con));
$totalusers = mysqli_num_rows($result);

if (isset($_GET['delete'])){
	$id = mysqli_real_escape_string($con, $_GET['delete']);
	mysqli_query($con, "DELETE FROM `news` WHERE `id` = '$id'") or die(mysqli_error($con));

	echo '
		<script>
			window.history.replaceState("object or string", "Title", "index.php");
		</script>
	';
}
if (isset($_POST['addnews'])){
    $title = sec_tag($con, $_POST['addtitle']);
	$message = sec_tag($con, $_POST['addnews']);
    $colourp = sec_tag($con, $_POST['coloured']);
	mysqli_query($con, "INSERT INTO `news` (`title`, `message`, `writer`, `date`, `colour`) VALUES ('$title', '$message', '$_SESSION[username]', '$datetime', '$colourp')") or die(mysqli_error($con));
}

if (isset($_POST['newsid']) && isset($_POST['editmessage'])){
	$id = sec_tag($con, $_POST['newsid']);
	$title = sec_tag($con, $_POST['edittitle']);
	$message = sec_tag($con, $_POST['editmessage']);
	mysqli_query($con, "UPDATE `news` SET `message` = '$message' WHERE `id` = '$id'") or die(mysqli_error($con));
	mysqli_query($con, "UPDATE `news` SET `title` = '$title' WHERE `id` = '$id'") or die(mysqli_error($con));

}
$result = mysqli_query($con, "SELECT * FROM `news`") or die(mysqli_error($con));
$totalnews = mysqli_num_rows($result);
$result = mysqli_query($con, "SELECT * FROM `news` WHERE DATE(date) = '$date'") or die(mysqli_error($con));
$todaysnews = mysqli_num_rows($result);
$generatestotal = 0;
$result = mysqli_query($con, "SELECT * FROM `statistics` WHERE `username` = '$username'") or die(mysqli_error($con));
while($row = mysqli_fetch_assoc($result)) {
	$generatestotal = $generatestotal + $row['generated'];
}
$result = mysqli_query($con, "SELECT * FROM `users` WHERE `date` = '$date'") or die(mysqli_error($con));

$todaysusers = mysqli_num_rows($result);
$result = mysqli_query($con, "SELECT * FROM `subscriptions` WHERE `active` = '1' AND `expires` >= '$date'") or die(mysqli_error($con));
$activesubscriptions = mysqli_num_rows($result);
$privtotalalts = 0;
$result = mysqli_query($con, "SELECT * FROM `privgenerators`") or die(mysqli_error($con));

while($row = mysqli_fetch_assoc($result)) {
	$result2 = mysqli_query($con, "SELECT * FROM `privgenerator$row[id]` WHERE `status` != '0'") or die(mysqli_error($con));
	$privtotalalts = $privtotalalts + mysqli_num_rows($result2);
}
$privgeneratestotal = 0;
$result = mysqli_query($con, "SELECT * FROM `privstatistics` WHERE `username` = '$username'") or die(mysqli_error($con));
while($row = mysqli_fetch_assoc($result)) {
	$privgeneratestotal = $privgeneratestotal + $row['generated'];
}

?>

<?php include("noob/header.php"); ?>
  	                
         <div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <center><h4 class="card-title">Support Tickets</h4></center>
                  
                  
                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                      <table id="sortable-table-2" class="table table-striped">
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
  	</div>
                  
   </div>
  	</div>
           


    	<div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <center><h4 class="card-title">All the support tickets you have made will show here</h4></center>
               
                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                      <table id="sortable-table-2" class="table table-striped">
                                       
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
		</div>
                  	</div>	</div>
            <?php include("noob/footer.php"); ?>
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