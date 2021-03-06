<?php
	session_start();
	include('../dbconfig/dbconfig.php');
	if (!$_SESSION['managerauth']) {
		echo "<script>window.location='../adminlogin.php'</script>";
	}

	$staffid = $_SESSION['staffid'];
	$username = $_SESSION['staffusername'];

	$getstaffsql = mysql_query("Select * from Staffs where staffid = '$staffid'");
	$rowgetstaff = mysql_fetch_assoc($getstaffsql);
	$staffname = $rowgetstaff['staffname'];

	$officeid = $rowgetstaff['officeid'];
	$staffphoto = $rowgetstaff['staffphoto'];

	$getofficename = mysql_query("Select officename from Offices where officeid = '$officeid'");
	$rowgetoffice = mysql_fetch_assoc($getofficename);
	$officename = $rowgetoffice['officename'];

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>EZride - Staff Management</title>

		<!-- Bootstrap -->
		<link href="../style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="../fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Site Logo -->
		<link href = "../images/design/logo.png" rel="icon" type="image/png">

		<link href="../style/datatable.min.css" rel="stylesheet">

		<!-- Custom Theme Style -->
		<link href="../style/custom.min.css" rel="stylesheet">
		<link href="../style/customstyle.css" rel="stylesheet">
		<!-- Sweet Alert -->
		<link rel="stylesheet" href="../style/sweetalert.css">
	</head>

	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a href="mdashboard.php" class="site_title"><i class="fa fa-car"></i><span>EZride</span></a>
						</div>

						<div class="clearfix"></div>

						<!-- menu profile quick info -->
						<div class="profile clearfix">
							<div class="profile_pic">
								<img src="../images/staffphoto/<?php echo $staffphoto; ?>" alt="..." class="img-circle profile_img">
							</div>
							<div class="profile_info">
								<span>Welcome,</span>
								<h2><?php echo $staffname; ?></h2>
							</div>
							<div class="clearfix"></div>
						</div>
						<!-- /menu profile quick info -->

						<br />

						<!-- sidebar menu -->
						<?php
							include ('misc/_sidebarmenu.php');
						?>
					</div>
				</div>

				<!-- top navigation -->
						<?php
							include('misc/_navigationbar.php');
						?>
				<!-- /top navigation -->

				<!-- page content -->
				<div class="right_col" role="main">
					<div class="">
						<div class="page-title">
							<div class="title_left">
								<h3>All Staffs from the <?php echo $officename; ?> Office</h3>
							</div>
						</div>

						<div class="clearfix"></div>

						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_panel">
								<?php
									$getallstaffsql = mysql_query("Select * from Staffs where officeid = '$officeid' and Active = 1");
								?>
									<div class="x_content">
					                    <table id="datatable-fixed-header" class="table table-striped table-bordered">
											<thead>
												<tr>
													<td>Staff Name</td>
													<td>Staff Username</td>
													<td>Staff Email</td>
													<td>Staff Role</td>
													<td>Office ID</td>
													<td>Staff Gender</td>
													<td>Edit</td>
													<td>Delete</td>
												</tr>
											</thead>
											<tbody>
												<?php
													while ($rowgetallstaffs = mysql_fetch_assoc($getallstaffsql)) {
												?>
												<tr>
													<td><?php echo $rowgetallstaffs['staffname']; ?></td>
													<td><?php echo $rowgetallstaffs['staffusername']; ?></td>
													<td><?php echo $rowgetallstaffs['staffemail']; ?></td>
													<td><?php echo $rowgetallstaffs['staffrole']; ?></td>
													<td><?php echo $rowgetallstaffs['officeid']; ?></td>
													<td><?php echo $rowgetallstaffs['staffgender']; ?></td>
													<td>
														<a href="staffedit.php?staffid=<?php echo $rowgetallstaffs['staffid']; ?>"><button class="btn btn-round btn-primary btn-sm">Edit</button></a>
													</td>
													<td>
														<a href="staffdelete.php?staffid=<?php echo $rowgetallstaffs['staffid']; ?>"><button class="btn btn-round btn-danger btn-sm">Ban</button></a>
													</td>
												</tr>
												<?php
													}
												?>
												
											</tbody>
					                    </table>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /page content -->

				<!-- footer content -->
				<footer>
					<div class="pull-right">
						<!-- Xero - Online Car Rental by <a href="index.php">Xero</a> -->
					</div>
					<div class="clearfix"></div>
				</footer>
				<!-- /footer content -->
			</div>
		</div>

		<!-- jQuery -->
		<script src="../javascripts/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="../javascripts/bootstrap.min.js"></script>
		<!-- FastClick -->
		<script src="../javascripts/fastclick.js"></script>
		<!-- DataTable -->
		<script src="../javascripts/datatable.min.js"></script>
		
		<!-- Custom Theme Scripts -->
		<script src="../javascripts/custom.min.js"></script>
		<!-- SweetAlert -->
		<script src="../javascripts/sweetalert-dev.js"></script>
	</body>
</html>
