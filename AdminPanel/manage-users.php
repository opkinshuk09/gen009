<?php

include "inc/header.php";

if ($_SESSION['rank'] < "5") {
	header('Location: index.php?error=no-admin');
	exit();
}

if (isset($_GET['delete'])){
	$id = mysqli_real_escape_string($con, $_GET['delete']);
	mysqli_query($con, "DELETE FROM `users` WHERE `id` = '$id'") or die(mysqli_error($con));
	echo '
		<script>
			window.history.replaceState("object or string", "Title", "manage-users.php");
		</script>
	';
}

if (isset($_POST['adduser']) && isset($_POST['adduser']) && isset($_POST['password']) && isset($_POST['rank'])){
	$username = mysqli_real_escape_string($con, $_POST['adduser']);
	$first_last_name = mysqli_real_escape_string($con, $_POST['fullname']);
	$password = mysqli_real_escape_string($con, md5($_POST['password']));
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$rank = mysqli_real_escape_string($con, $_POST['rank']);
	mysqli_query($con, "INSERT INTO `users` (`first_last_name`, `username`, `password`, `email`, `rank`, `date`) VALUES ('$first_last_name', '$username', '$password', '$email', '$rank', DATE('$date'))") or die(mysqli_error($con));
}

if (isset($_GET['ban'])){
	$id = mysqli_real_escape_string($con, $_GET['ban']);
	mysqli_query($con, "UPDATE `users` SET `status` = '0' WHERE `id` = '$id'") or die(mysqli_error($con));
	echo '
		<script>
			window.history.replaceState("object or string", "Title", "manage-users.php");
		</script>
	';
}

if (isset($_GET['unban'])){
    $id = mysqli_real_escape_string($con, $_GET['unban']);
    mysqli_query($con, "UPDATE `users` SET `status` = '1' WHERE `id` = '$id'") or die(mysqli_error($con));
    echo '
        <script>
            window.history.replaceState("object or string", "Title", "manage-users.php");
        </script>
    ';
}

if (isset($_POST['userid']) && isset($_POST['editrank'])){
	$id = mysqli_real_escape_string($con, $_POST['userid']);
	$rank = mysqli_real_escape_string($con, $_POST['editrank']);
	mysqli_query($con, "UPDATE `users` SET `rank` = '$rank' WHERE `id` = '$id'") or die(mysqli_error($con));
	if(!empty($_POST['editpassword'])){
		$password = mysqli_real_escape_string($con, md5($_POST['editpassword']));
		mysqli_query($con, "UPDATE `users` SET `password` = '$password' WHERE `id` = '$id'") or die(mysqli_error($con));
	}
}

$result = mysqli_query($con, "SELECT * FROM `users`") or die(mysqli_error($con));
$totalusers = mysqli_num_rows($result);

$result = mysqli_query($con, "SELECT * FROM `users` WHERE `status` = '1'") or die(mysqli_error($con));
$activeusers = mysqli_num_rows($result);

$result = mysqli_query($con, "SELECT * FROM `users` WHERE `status` = '0'") or die(mysqli_error($con));
$bannedusers = mysqli_num_rows($result);

$result = mysqli_query($con, "SELECT * FROM `users` WHERE `date` = '$date'") or die(mysqli_error($con));
$todaysusers = mysqli_num_rows($result);
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


<div class="row">
         <div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <center><h4 class="card-title">Manage Users</h4></center>
                  
                  
                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                      <table id="sortable-table-2" class="table table-striped">
                        				<div id="collapse">

										<button class="btn btn-primary btn-large btn-block" data-toggle="collapse" data-target="#adduser" data-parent="#collapse"><i class="icon-plus"></i> Add User</button></br>

										<div id="adduser" class="sublinks collapse">
											<legend></legend>
											<form action="manage-users.php" method="POST">
											    <input type="text" name="fullname" class="form-control" placeholder="Full Name e.g. John Doe"></br>
												<input type="text" name="adduser" class="form-control" placeholder="Username"></br>
												<input type="password" name="password" class="form-control" placeholder="Password"></br>
												<input type="email" name="email" class="form-control" placeholder="Email"></br>
												<select name="rank" class="form-control">
													<option value="1">Member</option>
													<option value="4">Cracker</option>
													<option value="5">Admin</option>
												</select></br>
												<button type="submit" class="btn btn-primary btn-large btn-block"><i class="fa fa-plus"></i> Add User</button>
											</form>
										</div>
                   <p></p>
                    
			    
                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                       
                                       	  <thead>
									  <tr>
										  <th><i class="fa fa-user-circle"></i> Username</th>
										  <th><i class="fa fa-users"></i> Full Names</th>
										  <th><i class="fa fa-envelope-o"></i> Email</th>
										  <th><i class="fa fa-calendar"></i> Date</th>
										  <th><i class="fa fa-globe"></i> IP</th>
										  <th><i class="fa fa-star"></i> Rank</th>
										  <th><i class="fa fa-times-circle"></i> Ban</th>
										  <th><i class="fa fa-cogs"></i> Edit & Delete</th>
									  </tr>
									  </thead>
									  <tbody class="searchable">
										<?php
										$result = mysqli_query($con, "SELECT * FROM `users` WHERE `status` = '1'") or die(mysqli_error($con));
										while ($row = mysqli_fetch_array($result)) {
											echo'<tr>
													<td><a href="#">'.$row['username'].'</a></td>
													<td>'.$row['first_last_name'].'</td>
													<td>'.$row['email'].'</td>
													<td>'.$row['date'].'</td>
													<td>'.$row['ip'].'</td>';
													if($row['rank'] == "1"){echo '<td>Member</td>';}elseif($row['rank'] == "5"){echo '<td>Admin</td>';}elseif($row['rank'] == "4"){echo '<td>Cracker</td>';}else{echo '<td></td>';}
											echo '
													<td><a class="btn btn-default btn-xs" href="manage-users.php?ban=' . $row['id'] . '"><i class="fa fa-trash "> Ban</i></a></td>
													<td>
														<a class="btn btn-primary btn-xs" data-toggle="modal" href="#edit" data-username="'.$row['username'].'" data-rank="'.$row['rank'].'" data-userid="'.$row['id'].'"><i class="fas fa-cogs"></i></a>
														<a class="btn btn-danger btn-xs" href="manage-users.php?delete=' . $row['id'] . '"><i class="fa fa-trash "></i></a>
													</td>
												 </tr>
											';
										}
										?>
                                       
                                       
                                       
                                       
                                        </tbody>
                                    </table>
			</div>
		</div>
	</div></div>
                   
                     <div class="col-md-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <center><h4 class="card-title">Banned Users</h4></center>
                  
                  
                    <div class="table-sorter-wrapper col-lg-12 table-responsive">
                      <table id="sortable-table-2" class="table table-striped">
                                          <thead>
                                      <tr>
                                          <th><i class="fa fa-user-circle"></i> Username</th>
                                          <th><i class="fa fa-users"></i> Full Names</th>
                                          <th><i class="fa fa-cogs"></i> Unban</th>
                                      </tr>
                                      </thead>
                                      <tbody class="searchable">
                                        <?php
                                        $result = mysqli_query($con, "SELECT * FROM `users` WHERE `status` = '0'") or die(mysqli_error($con));
                                        while ($row = mysqli_fetch_array($result)) {
                                            echo'<tr>
                                                    <td><a href="#">'.$row['username'].'</a></td>
                                                    <td>'.$row['first_last_name'].'</td>
                                                    <td>
                                                        <a class="btn btn-danger btn-xs" href="manage-users.php?unban=' . $row['id'] . '"> Unban</a>
                                                    </td>
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
              
         
                   
                   
                   <!-- Modal -->
		  <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-sm">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						  <h4 class="modal-title">Edit User</h4>
					  </div>
					  <div class="modal-body">
					   <form action="manage-users.php" method="POST">
					    <input type="hidden" name="userid">
						<div class="form-group">
						  <label>Username</label>
						  <input type="text" class="form-control" name="editusername" disabled>
						</div>
						<div class="form-group">
						  <label>Password</label>
						  <input type="password" class="form-control" name="editpassword">
						</div>
						<div class="form-group">
						  <label>Rank</label>
						  <select class="form-control" name="editrank">
							<option value="1">Member</option>
							<option value="4">Cracker</option>
							<option value="5">Admin</option>
						  </select>
						</div>
					  </div>
					  <div class="modal-footer">
						<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
						<button class="btn btn-warning" type="submit"> Update</button>
                      </div>
					   </form>
				  </div>
			  </div>
		  </div>
		  <!-- modal -->
                   
                   
                        </div><!-- container -->


                    </div> <!-- Page content Wrapper -->

              

       <?php include("noob/footer.php"); ?>
  <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
                $('#datatable-keytable').DataTable( { keys: true } );
                $('#datatable-responsive').DataTable();
                $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
                var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
            } );
            TableManageButtons.init();

        </script>
	<script>
		$(document).ready(function () {

			(function ($) {

				$('#filter').keyup(function () {

					var rex = new RegExp($(this).val(), 'i');
					$('.searchable tr').hide();
					$('.searchable tr').filter(function () {
						return rex.test($(this).text());
					}).show();

				})

			}(jQuery));

		});
		
		$('#info').on('show.bs.modal', function(e) {
		    var first_last_name = $(e.relatedTarget).data('first_last_name');
			var username = $(e.relatedTarget).data('username');
			var date = $(e.relatedTarget).data('date');
			var rank = $(e.relatedTarget).data('rank');
			$(e.currentTarget).find('input[name="first_last_name"]').val(first_last_name);
			$(e.currentTarget).find('input[name="username"]').val(username);
			$(e.currentTarget).find('input[name="date"]').val(date);
			$(e.currentTarget).find('input[name="rank"]').val(rank);
		});
		
		$('#edit').on('show.bs.modal', function(e) {
			var username = $(e.relatedTarget).data('username');
			var userid = $(e.relatedTarget).data('userid');
			var rank = $(e.relatedTarget).data('rank');
			$(e.currentTarget).find('input[name="editusername"]').val(username);
			$(e.currentTarget).find('input[name="userid"]').val(userid);
		});
	
	</script>
    </body>

</html>