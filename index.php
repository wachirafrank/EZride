<?php
//  to use session
session_start();

include('dbconfig/dbconfig.php');

$currentpage = 'index';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eride | Home</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="fa/css/font-awesome.min.css">
    <!-- sweet alert -->
    <link rel="stylesheet" href="style/sweetalert.css">
    <!-- site logo -->
    <!-- <link rel="stylesheet" href="images/design/logo.png"> -->
    <!-- custom style -->
    <link rel="stylesheet" href="style/customstyle.css">
    <!-- date picker -->
    <link rel="stylesheet" href="style/datarangepicker.css">

    
</head>
<body class="onepagebody">
    <?php include('_navigationbar.php'); ?>
    <div class="container">
        <div class="row indexpage">
            <?php if(isset($_SESSION['authentication'])): ?>
            <form action="firststepbooking.php" method="post">
                <div class="form-group">
                    <div class="col-md-5">
                        <label for="hirefrom">
                            <i class="fa fa-home">Hire from:</i>
                        </label>
                    </div>
                    <select name="officeid" required="required" id="hirefrom" class="form-control">
                    <?php
                    $sqlgetoffice = mysqli_query($conn,"SELECT * FROM offices");
                    while ($rowgetoffice = mysqli_fetch_assoc($sqlgetoffice)):
                    ?>
                    <option value="<?php echo $rowgetoffice['officeid']; ?>"><?php echo $rowgetoffice['officename'];?>Ofice</option>
                    <?php endwhile; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label for="driver" class="fa fa-male">
                        <i>driver:</i>
                    </label>
                    <select name="driver" required="required" on-change="Select-driver(this.value)" id="driver" class="form-control">
                    <option value="driver"> I want to hire a driver</option>
                    <option value="nodriver">No driver!</option>
                    </select>
                </div>

                <div class="form-group">
                    <input type="text" id="pickuplocation" name="pickuplocation" placeholder="Pick up location" class="form-control">
                </div>
                <div class="form-group">
                <input type="text" id="returnlocation" name="returnlocation" placeholder="Return up location" class="form-control">
                

                </div>
            </form>
                    <?php else: ?>
            <form action="index.php" method="post">
                <div class="form-group">
                <label for="customerusername">
                </label>
                <i class="fa fa-user-circle-o">Username</i>
            
                
                <div>
                    <input type="text" name="customerusername" required placeholder="Username" class="form-control">
                </div>
                </div>

                <div class="form-group">
                <label for="customerpassword">
                <i class="fa fa-unlock">Password</i>
                </label>
                <div>
                <input type="text" required name="customerpassword" placeholder="Password" class="form-control">
                </div>
                </div>
                
                <div class="form-group">
                        <div class="col-md-3"></div>
                        <button class="btn btn-success" type="submit" name="submit">
                        Login</button>
                        <a class="btn btn-primary" href="register.php">Register</a>
                </div>
                
            </form>
                    <?php endif;?>
        </div>
    </div>

    <!-- jQuery -->
	<script src="javascripts/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="javascripts/bootstrap.min.js"></script>
	<!-- SweetAlert -->
	<script src="javascripts/sweetalert-dev.js"></script>
	
	<script type="text/javascript" src="javascripts/moment.min.js"></script>
	<!-- Date Picker -->
	<script src="javascripts/daterangepicker.js"></script>

	<script>
		$(function() {
		    $('input[name="fromtodatetime"]').daterangepicker({
		        timePicker: true,
		        timePickerIncrement: 30,
		        locale: {
		            format: 'YYYY-MM-DD h:mm:ss A'
		        }
		    });
		});

		function SelectDriver(dri) {
			if (dri == 'nodriver') {
				var hirefrom = document.getElementById('hirefrom').options[document.getElementById('hirefrom').selectedIndex].text;
				document.getElementById('pickuplocation').value = hirefrom;
				document.getElementById('pickuplocation').type = "hidden";
				document.getElementById('returnlocation').value = hirefrom;
				document.getElementById('returnlocation').type = "hidden";
			}
			else{
				document.getElementById('pickuplocation').value = "";
				document.getElementById('pickuplocation').type = "text";
				document.getElementById('returnlocation').value = "";
				document.getElementById('returnlocation').type = "text";

			}
		}
	</script>
</body>

<?php
		
		if (isset($_POST['submit'])):

			$customerusername = $_POST['customerusername'];
			$customerrawpassword = $_POST['customerpassword'];
			$customerpassword = md5($customerrawpassword);

			$query = mysqli_query($conn,"SELECT * FROM Customers where customerusername = '$customerusername' AND customerpassword = '$customerpassword' and active = 1") or die(mysqli_error($conn));
			$querynumrow = mysqli_num_rows($query);

			if($querynumrow > 0)
			{
			    $_SESSION['authentication'] = true;
			    $_SESSION['customerusername'] = $customerusername;
			    $row = mysqli_fetch_assoc($query);
			    $customerid = $row['customerid'];
			    $_SESSION['customerid'] = $customerid;
		  		echo "<script>swal({
				  title: 'Success!',
				  text: 'You are now logged in!',
				  type: 'success',
				  timer: 1000,
				  showConfirmButton: false
				}, function(){
				      window.location.href = 'index.php';
				});</script>";
			}
			else{
				$checkban = mysqli_query($conn,"SELECT * FROM Customers where customerusername = '$customerusername' AND customerpassword = '$customerpassword' and active = 0") or die(mysqli_error($conn));
				$checkbanquerynumrow = mysqli_num_rows($checkban);
				if ($checkbanquerynumrow > 0) {
					echo "<script>swal({
					title: 'Oops!',
					text: 'Your account has been banned!',
					type: 'error',
					timer: 1000,
					showConfirmButton: false
					}, function(){
					window.location.href = 'index.php';
					});</script>";
				}
				else{
				echo "<script>swal({
				title: 'Oops!',
				text: 'Your username or password is wrong!',
				type: 'error',
				timer: 1000,
				showConfirmButton: false
				}, function(){
				window.location.href = 'index.php';
				});</script>";
				}
			}

		endif;
	?>
</html>


