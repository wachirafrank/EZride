<?php
session_start();

include('dbconfig/dbconfig.php');

$currentpage = 'contact';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Xero | Contact</title>

    <!-- bootstrap -->
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="fa/css/font-awesome.min.css">
    <!-- Sweet alert -->
    <link rel="stylesheet" href="style/sweetalert.css">
    <!-- Site Logo -->
    <link rel="stylesheet" href="images/design/logo.png" rel="icon" type="image/png">
    <!-- custom style -->
    <link rel="stylesheet" href="style/customstyle.css">
</head>
<body class="onepagebody">
    <?php include('_navigationbar.php');
    ?>
    <div id="contactform">
    <form action="" method="post">
    <div class="form-group">
    <label for="name">
    <i class="fa fa-user">Name</i>
    </label>
    <input type="text" name="name"  required class="form-control">
    </div>

    <div class="form-group">
        <label for="email">
            <i class="fa fa-email">Email:</i>
        </label>
        <input type="text" name="email" required class="form-control">
    </div>
    <div class="form-group">
        <label for="suggestion">
            <i class="fa fa-comment">Comment</i>
        </label>
        <textarea name="suggestion" required id="comment" cols="30" rows="3" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-primary center-block" name="submit" value="Send">

    </div>


    </form>
    </div>

    <div id="officelocation">
       <?php
        $sql = mysqli_query($conn,"SELECT * FROM offices");
        while($row = mysqli_fetch_assoc($sql)):
            if($row['officename'] == 'Mandalay'){
                $default = 'default';
                $office = "Head Office (Mandalay)";
            } else {
                $office = $row['officename'] . " Office";
                $default = '';
            }
        ?>

        <div class="box" id="<?php echo $default; ?>">
        <h3><i class="fa fa-home"></i><?php echo $office ;?></h3>

        <ul>
            <li><span style="color: yellow;"><i class="fa fa-location-arrow"></i>Address: </span><em><?php echo $row['officeaddress']; ?></em></li>
            <?php
                $officeid = $row['officeid'];
                $sqlofficephone  = mysqli_query($conn, "SELECT * from officephones where officeid = '$officeid'");
            ?>
            <li>
                <span style="color:yellow;"> <i class="fa fa-phone"></i>&nbsp;Phone Number :</span>
                <?php
                    while($rowofficephone = mysqli_fetch_assoc($sqlofficephone)):
                        echo $rowofficephone['officephoneprefix'] . "=" .$rowofficephone['officephoneno'];
                ?>
                <?php endwhile;?>
            </li>
        </ul>
        </div>

        <?php endwhile; ?>
    </div>


    <!-- JQuery -->
    <!-- <link rel="stylesheet" href="javascripts/jquery.min.js"> -->
    <script src="javascripts/jquery.min.js"></script>
    <!-- bootstrap -->
    <!-- <link rel="stylesheet" href="javascripts/bootstrap.min.js"> -->
    <script src="javascripts/bootstrap.min.js"></script>
    <!-- Sweet alert -->
    <!-- <link rel="stylesheet" href="javascripts/sweetalert-dev.js"> -->
    <script src="javascripts/sweetalert-dev.js"></script>

    <script>
    $("h3").click(function() {
        var parent  = $(this).parent();
        $('h3').nextUntil('h3').hide();
        $("ul",parent).slideToggle("fast");
    });
    </script>

    <?php
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $suggestion = $_POST['suggestion'];

            $insertsql = mysqli_query($conn, "insert into mails(name,email,feedback,sendtime) values('$name', '$email','$suggestion',now())") or die(mysqli_error($conn));;

            echo "<script>swal({
                title: 'Success!',
                text: 'Your Mail has been sent!',
                type: 'success',
                timer: 1000,
                showConfirmButton: false
                }, function(){
                window.location.href = 'index.php';
                });</script>";
        }
    ?>
</body>
</html>







