<?php
session_start();
 include('dbconfig/dbconfig.php');
 $currentpage = 'register';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eride | Register</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <!-- Font awesome -->
    <link href="fa/css/font-awesome.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link rel="stylesheet" href="style/sweetalert.css">
    <!-- Custom Style -->
    <link href="style/customstyle.css" rel="stylesheet">
    <!-- Site Logo -->
    <link href = "images/design/logo.png" rel="icon" type="image/png">

</head>
<body class="other" >
    <?php include('_navigationbar.php'); ?>

    <div class="container adjustnavposition">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3 col-sm-offset-3 main-form" style="padding:20px;">
                <div class="row">
                    <form action="" method="post" class="form-horizontal form-label-left">
                    <h3 style="text-align:center"><i class="fa fa-user-circle"></i> Personal Detail</h3> <br>
                    <div id="personaldetail">

                        <div class="form-group">
                            <label for="customername" class="control-label col-md-4 col-sm-4 col-xs-12">
                                <i class="fa fa-user"></i> Full Name
                            </label>
                            <div class="col-md-7 col-sm-7 col-sm-12">
                                <input type="text" required name="customername" placeholder="John" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                                <label for="customeremail" class="control-label col-md-4 col-sm-4 col-xs-12">
                                    <i class="fa fa-envelope"></i> Email Address
                                </label>
                                <div class="col-md-7 col-sm-7 col-sm-12">
                                    <input type="text" required name="customeremail" placeholder="yourname@email.com" class="form-control">
                                </div>
                        </div>

                        <div class="form-group">
                                <label for="customerusername" class="control-label col-md-4 col-sm-4 col-xs-12">
                                    <i class="fa fa-user-circle-o"></i> Username
                                </label>
                                <div class="col-md-7 col-sm-7 col-sm-12">
                                    <input type="text" required name="customerusername"  title="8 characters minimum"  placeholder="johndoe123"class="form-control">
                                </div>
                        </div>
                        <!-- Customer password -->
                        <div class="form-group">
                                <label for="customerpassword" class="control-label col-md-4 col-sm-4 col-xs-12">
                                    <i class="fa fa-unlock"></i> password
                                </label>
                                <div class="col-md-7 col-sm-7 col-sm-12">
                                    <input type="password" required name="customerpassword"  title="8 characters minimum"  placeholder="must be atleast 8 characters"class="form-control">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="confirmpassword" class="control-label col-md-4 col-sm-4 col-xs-12">
                                <i class="fa fa-unlock"></i> Confirm Password
                            </label>
                            <div class="col-md-7 col-sm-7 col-xs-12">
                                <input type="password" class="form-control" required title="8 characters minimum" name="confirmpassword" placeholder="must be atleast 8 characters">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="customergender" class="control-label col-md-4 col-sm-4 col-xs-12">
                                <i class="fa fa-envelope"></i> Gender
                            </label>
                            <div class="col-md-4 col-sm-4 col-sm-12">
                                <input type="radio" id="male" value="male" required name="customergender" class="form-control"><label for="male"> Male</label> <i class="fa fa-male"></i>
                            </div>
                            <div class="col-md-4 col-sm-4 col-sm-12">
                                    <input type="radio" id="female" value="female" required name="customergender" class="form-control"><label for="female"> Female</label> <i class="fa fa-male"></i>
                                </div>
                        </div>

                        <div class="form-group">
                                <label for="customerdob" class="control-label col-md-4 col-sm-4 col-xs-12">
                                    <i class="fa fa-envelope"></i> Date of Birth
                                </label>
                                <div class="col-md-7 col-sm-7 col-sm-12">
                                    <input type="date" required name="customerdob"  placeholder="mm/dd/yyyy"class="form-control">
                                </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" value="Register" name="submit" class="btn btn-primary center-block">
                        </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JQuery -->
    <script src="javascripts/jquery.min.js"></script>
    <script src="javascripts/bootstrap.min.js"></script>
    <script src="javascripts/sweetalert-dev.js"></script>
    
</body>
<?php
if(isset($_POST['submit'])):
    $customername = $_POST['customername'];
    $customeremail = $_POST['customeremail'];
    $customerusername = $_POST['customerusername'];
    $customerpassword = $_POST['customerpassword'];
    $confirmpassword = $_POST['confirmpassword'];
    $customergender = $_POST['customergender'];
    $customerdob = $_POST['customerdob'];

    var_dump($customername, $customeremail,$customerusername, $customerpassword, $customergender, $customerdob);

    if($customerpassword != $confirmpassword){
        echo "<script>swal({
            title: 'Oops!',
            text: 'Your passwords do not match. Please Try Again!',
            type: 'error',
            timer: 1000,
            showConfirmButton: false
            }, function(){
            window.location.href = 'register.php';
            });</script>";
    } else {
        $checkmailsql = mysqli_query(conn,"select * from customers where customeremail = '$customeremail'");
        $checkmailnumrow = mysqli_num_rows($checkmailsql);
        if($checkmailnumrow > 0){
            echo "<script>swal({
                title: 'Oops!',
                text: 'Your Email is already in use. Please Try Again!',
                type: 'error',
                timer: 1000,
                showConfirmButton: false
                }, function(){
                window.location.href = 'register.php';
                });</script>";
        }  else{
            $checkusername = mysqli_query($conn, "select * FROM customers where customerusername = '$customerusername' ");
            $rownousername = mysqli_num_rows($checkusername);
            if($rownousername > 0){
                echo "<script>swal({
                    title: 'Oops!',
                    text: 'Your Username is already in use. Please Try Again!',
                    type: 'error',
                    timer: 1000,
                    showConfirmButton: false
                    }, function(){
                    window.location.href = 'register.php';
                    });</script>";
            } else {
                $customerpassword = md5($customerpassword);
                $getlatestid = mysqli_query($conn, "select customerid from customers where substring(customerid, 4) = (select max(cast(substring(customerid, 4) as signed)) from customers) ");
                $queryrow = mysqli_num_rows($getlatestid);
                if($queryrow < 1){
                    $customerid = 'cus1';
                } else {
                    while($row = mysqli_fetch_assoc($getlatestid)):
                        $lastid= $row['customerid'];
                        $lastid = preg_replace("/[^0-9]/", "", $lastid);
                    endwhile;
                    $lastid = $lastid + 1;
                    $customerid = 'cus'. $lastid;
                }

                $registersql = mysqli_query($conn, "insert into customers (customerid, customername, customerusername, customeremail,customerpassword, customergender,customerdob,customerphoto,signuptime) values ('$customerid','$customername', '$customerusername', '$customeremail','$customerpassword','$customergender','$customerdob', 'customer.png', NOW())") or die(mysqli_error($conn));
                $_SESSION['authentication'] = true;
                $_SESSION['customerusername'] = $customerusername;
                $_SESSION['customerid'] = $customerid;

                echo "<script>swal({
                    title: 'Success!',
                    text: 'Your account has been created!',
                    type: 'success',
                    timer: 1000,
                    showConfirmButton: false
                    }, function(){
                    window.location.href = 'profile.php';
                });</script>";

            }
       
        }

}


endif;

?>

</html>