<?php
session_start();

include('dbconfig/dbconfig.php');

if(!isset($_SESSION['authentication'])){
    echo "<script>window.location.href='index.php'; </script>";
}

$customerid =  $_SESSION['customerid'];
$getcustomer = mysqli_query($conn, "select * from customers where customerid = '$customerid'") or die(mysqli_error($conn));
$rowgetcustomerdata = mysqli_fetch_assoc($getcustomer);

$currentpage = 'index';

?>	

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eride | Profile</title>

    		<!-- Bootstrap -->
		<link href="style/bootstrap.min.css" rel="stylesheet">
		<!-- Font Awesome -->
		<link href="fa/css/font-awesome.min.css" rel="stylesheet">
		<!-- Sweet Alert -->
		<link rel="stylesheet" href="style/sweetalert.css">
		<!-- Custom Style -->
		<link href="style/customstyle.css" rel="stylesheet">
		<!-- Site Logo -->
		<link href = "images/design/logo.png" rel="icon" type="image/png">

</head>
<body class="other">
	<?php include('_navigationbar.php'); ?>
	
	<div class="container adjustnavpositon">
		<div class="row">
			<div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2 col-sm-offset-3 main_form" id="main" style="padding:20px;">
			<div class="pull-center" style="text-align:center;">
				<div id="divedit">
					<i onclick="changeinput()" class="fa fa-edit fa-lg pull-right" style="cursor: pointer;">Edit</i>
				</div>
				<div id="divcancel" style="display:none">
					<i  onclick="changecancel()" class="fa fa-ban fa-lg pull-right" style="cursor: pointer;">Cancel</i>
				</div>
				<h1>Customer Detail</h1>
				<hr>
				<div class="col-md-8 col-md-offset-2">
					<form action="" enctype="multipart/form-data" method="post">
						<div class="profile_img">
							<div id="crop-avatar">
								<!-- current-avatar -->
								<img src="images/customerphoto/<?php echo $rowgetcustomerdata['customerphoto']; ?>" alt="Avatar" width="200px" height="200px" alt="" class="center-block img-circle avatar-view">
								<br>
								<div class="form-grop">
									<input type="hidden" name="customerphoto" class="form-control" id="customerphoto">

								</div>
							</div>
						</div>
						<h4 id="divname">
							<i class="fa fa-user"></i> <?php echo $rowgetcustomerdata['customername']; ?>
						</h4>
						<div class="form-group">
							<input type="hidden" name="customername" id="customername" value="<?php echo $rowgetcustomerdata['customername']; ?>" required  class="form-control">
							<br>
						</div>
						<ul class="list-unstyled user_data">
							<li>
								<div id="divusername">
									<i class="fa fa-user-circle-o"></i> Username : <?php echo  $rowgetcustomerdata['customerusername']; ?> 
									
								</div>
								<div class="form-group">
									<input type="hidden" required=""  value="<?php echo $rowgetcustomerdata['customerusername']; ?>" readonly name ="customerusername" class="form-control" id="customerusername" >
								</div>

							</li>

							<li>
								<div id="divemail"><i class="fa fa-envelope"></i>Email: <?php echo $rowgetcustomerdata['customeremail']; ?>  </div>
									<div class="form-group">
										<input type="hidden" value="<?php echo $rowgetcustomerdata['customeremail'];?>" required=""  name="customeremail" class="form-control" id="customeremail">	

									</div>

							</li>

							<!-- gender -->
							<li>
								<div id="divgender"><i class="fa fa-male"></i>Gender: <?php echo $rowgetcustomerdata['customergender']; ?></div>
								<div class="form-group">
									<input type="hidden" required="" name="customergender" value="<?php echo $rowgetcustomerdata['customergender']; ?>" class="form-control" id="customergender">
								</div>
							</li>

							<!-- dob -->
							<li>	
								<div id="divdob"><i class="fa fa-calender"></i>Date of Birth: <?php echo $rowgetcustomerdata['customerdob']; ?></div>
								<div class="form-group">
									<input type="hidden" required="" name="customerdob" value="<?php echo $rowgetcustomerdata['customerdob']; ?>" class="form-control" id="customerdob">
								</div>
							</li>

							<div class="form-group">
								<input type="hidden" name="submit" value="Update" id="button" class="btn btn-primary center-block">
							</div>
							
						</ul>
					</form>
				</div>
			</div>
			</div>
		</div>
	</div>
    
</body>
<!-- jQuery -->
<script src="javascripts/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="javascripts/bootstrap.min.js"></script>
	<!-- SweetAlert -->
	<script src="javascripts/sweetalert-dev.js"></script>
	<script>

		function changeinput() {
				document.getElementById('customerphoto').type = "file";

				document.getElementById('customerusername').type = "text";
				document.getElementById('customerusername').required = "required";
				document.getElementById("divusername").style.visibility = "hidden";

				document.getElementById('customername').type = "text";
				document.getElementById('customername').required = "required";
				document.getElementById("divname").style.visibility = "hidden";

				document.getElementById('customeremail').type = "text";
				document.getElementById('customeremail').required = "required";
				document.getElementById("divemail").style.visibility = "hidden";

				document.getElementById('customergender').type = "text";
				document.getElementById('customergender').required = "required";
				document.getElementById("divgender").style.visibility = "hidden";

				document.getElementById('customerdob').type = "date";
				document.getElementById('customerdob').required = "required";
				document.getElementById("divdob").style.visibility = "hidden";

				document.getElementById('button').type = "submit";
				document.getElementById('divedit').style.display = "none";
				document.getElementById('divcancel').style.display = "block";
				document.getElementById('paypalbutton').style.display = "none";

			}

		function changecancel(){
				document.getElementById('customerphoto').type = "hidden";

				document.getElementById('customerusername').type = "hidden";
				document.getElementById('customerusername').required = "";
				document.getElementById("divusername").style.visibility = "visible";

				document.getElementById('customername').type = "hidden";
				document.getElementById('customername').required = "";
				document.getElementById("divname").style.visibility = "visible";

				document.getElementById('customeremail').type = "hidden";
				document.getElementById('customeremail').required = "";
				document.getElementById("divemail").style.visibility = "visible";

				document.getElementById('customergender').type = "hidden";
				document.getElementById('customergender').required = "";
				document.getElementById("divgender").style.visibility = "visible";

				document.getElementById('customerdob').type = "hidden";
				document.getElementById('customerdob').required = "";
				document.getElementById("divdob").style.visibility = "visible";

				document.getElementById('button').type = "hidden";
				document.getElementById('divedit').style.display = "block";
				document.getElementById('divcancel').style.display = "none";

		}

	</script>

	<?php
		if (isset($_POST['submit'])) {
			$customername = $_POST['customername'];
			$customergender = $_POST['customergender'];
			$customeremail = $_POST['customeremail'];
			$customerdob = $_POST['customerdob'];
	
			$customerphoto = $_FILES['customerphoto']['name'];
			$tmp = $_FILES['customerphoto']['tmp_name'];

			if ($customerphoto) {

				$allowfiletype =  array('GIF','PNG' ,'JPG', 'gif', 'png', 'jpg');
				$ext = end((explode(".", $customerphoto)));
				if(!in_array($ext, $allowfiletype) ) {
					echo "<script>swal({
					title: 'Oops!',
					text: 'Only Image Files (gif, png, jpg) are allowed!',
					type: 'error',
					timer: 1000,
					showConfirmButton: false
					}, function(){
					window.location.href = 'profile.php';
					});</script>";
				}
				else{
					move_uploaded_file($tmp, "images/customerphoto/$customerphoto");
					$updatesql = mysqli_query($conn,"update customers set customername = '$customername',  customeremail = '$customeremail', customergender = '$customergender', customerphoto = '$customerphoto' where customerid = '$customerid'") or die(mysqli_error($conn));
					echo "<script>swal({
					title: 'Success!',
					text: 'Your Profile has been updated!',
					type: 'success',
					timer: 1000,
					showConfirmButton: false
					}, function(){
					window.location.href = 'profile.php';
					});</script>";
				}
			}
			else{
				$updatesql = mysqli_query($conn,"update customers set customername = '$customername',  customeremail = '$customeremail', customergender = '$customergender' where customerid = '$customerid'") or die(mysqli_error($conn));
				echo "<script>swal({
				title: 'Success!',
				text: 'Your Profile has been updated!',
				type: 'success',
				timer: 1000,
				showConfirmButton: false
				}, function(){
				window.location.href = 'profile.php';
				});</script>";
			}
		}

		?>

</html>


