<!-- to use session -->
session_start();

<!-- for mysql db connection -->
include('dbconfig/dbconfig.php');

if(!isset($_SESSION['authentication'])){
    echo "<script>window.location.href='index.php';</script>";
}

$durationinhours = $_SESSION['durationinhours'];

$currrentpage = 'cars';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eride | Choose cars</title>

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
<?php include('navigationbar.php'); ?>
<div class="container adjustnavpositon">
	<div class="row div col-md-9">
		<h3>Choose cars from Eride Car Rental</h3>

	</div>

	<div class="col-md-3">
		<input type="text" id="filter" placeholder="Filter car" class="text-input form-control"/>
	</div>

</div> <!-- /container-->

<div class="row">
	<div class="col-md-3 car-filter">
		<h3>Booking Detail</h3>
		<ul class="list-unstyled user_data">
			<li>
				<i class="fa fa-home user-profile-icon"></i> Pick up from <?php echo $_SESSION['pickuplocation']; ?>
			</li>

			<li>
					<i class="fa fa-map-marker user-profile-icon"></i> Return to  <?php echo $_SESSION['returnlocation']; ?>
			</li>

			<li>
					<i class="fa fa-clock-o user-profile-icon"></i> to <?php echo $_SESSION['returntime']; ?>
			</li>
		</ul>

		<hr>

		<h3>Customer Detail</h3>
		<div class="profile_img">
			<div id="crop-avatar">
				<!-- Current avatar-->
				<img src="images/customerphoto/<?php echo $rowgetcustomer['customerphoto'];" width="200px; height="200px" alt="" class="img-circle avatar-view">
			</div>
		</div><!-- profile_img-->
		<h4><?php echo  $rowgetcustomer['customername']; ?></h4>
		<ul class="list-unstyled user_data">
			<li></li>
		</ul>
	</div>
</div>

    
</body>
</html>