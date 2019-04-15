<?php 
session_start();

include('dbconfig/dbconfig.php');

if(!isset($_SESSION['authentication'])){
    echo "<script>Window.location.href='index.php';</script>";
}

$customerid = $_SESSION['customerid'];
$getbookingsql = mysqli_query($conn ,"SELECT * from bookings where customerid = '$customerid' order by bookingtime desc") or die(mysqli_error($conn));
$checkgetbooking = mysqli_num_rows($getbookingsql);
$currentpage = 'reservation';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eride | Reservation</title>

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
			<div class="col-md-11 col-md-offset-1 reservation">
				<?php if($checkgetbooking < 1) { 
					?>
					<h1>There's no reservation in your account!</h1>
					<?php 
				} else {
					?>
					<table class="table table-responsive reservation-table">
						<thead>
							<tr>
								<td>Booking ID</td>
								<td>Office name</td>
								<td>Pickup time</td>
								<td>Return Time</td>
								<td>Pickup Location</td>
								<td>Return Location</td>
								<td>Total Cost</td>
								<td>Booking Time</td>
								<td>Status</td>
							</tr>
						</thead>
						<?php while($rowbooking = mysqli_fetch_assoc($getbookingsql)): $bookingid = $rowbooking['bookingid']; ?>
						<tr>
							<td><?php echo $rowbooking['bookingid']; ?></td>
							<td>
								<?php 

								$officeid = $rowbooking['officeid'];
								$getofficesql = mysqli_query($conn ,"SELECT * from offices where officeid = '$officeid'") or die(mysqli_error($conn));
								$rowoffice = mysqli_fetch_assoc($getofficesql);
								echo $rowoffice['officename'];
								?>
							</td>
							<td><?php echo $rowbooking['pickuptime']; ?></td>
							<td><?php echo $rowbooking['returntime']; ?></td>
							<td><?php echo $rowbooking['pickuplocation']; ?></td>
							<td><?php echo $rowbooking['returnlocation']; ?></td>
							<td>Ksh<?php echo $rowbooking['totalcost']; ?></td>
							<td><?php echo $rowbooking['bookingtime']; ?></td>
							<td>
								<?php 
								switch($rowbooking['confirmstatus']){
									case 'pending':
									echo "Reservation Pending";
									break;
									case  'confirmed':
									echo "Reservation Accepted";
									break;
									case 'declined':
									echo "Reservation Denied";
									break;
									case 'completed':
									echo "Reservation Completed";
									break;
									default: 
									
									break;

								}
								?>
							</td>
							<td>
								<a href="viewbookingdetail.php?bookingid=<?php echo $bookingid; ?>" class="btn btn-primary"> <i class="fa fa-info-circle"></i>View Detail</a>

							</td>
							<?php if(($rowbooking['confirmstatus'] == 'confirmed') || ($rowbooking['confirmstatus'] == 'pending') ): ?>
							<td>
							
								<?php
								$date1=strtotime("$rowbooking[pickuptime]");
								$date2 = date("Y-m-d H:i:s");
								$date2=strtotime("$date2");
								$days = abs(($date1 - $date2)/60/60/24);
								if ($days > 5):
								?>
								<a href="_cancelbooking.php?bookingid=<?php echo $bookingid; ?>" class="btn btn-default"><i class="fa fa-minus-circle"></i> Cancel</a>
								<?php
								else:
								?>
								<span style="color: red"><em>Can't Cancel</em></span>
								<?php
								endif;
								?>
										
							</td>
							<?php endif; ?>

							</tr>
							<?php endwhile; ?>
						
					</table>
				<?php }  ?>
			</div>
		</div>
	</div>
</body>
</html>
