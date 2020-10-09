<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
	{ 
	header('location:residentLogin.php');
	}
	else
	{
		date_default_timezone_set('Asia/Kuala_Lumpur');// change according timezone
		$currentTime = date( 'd-m-Y h:i:s A', time () );
		
		if(isset($_POST['submit']))
		{
			$sql=mysqli_query($con,"SELECT password FROM  resident where password='".md5($_POST['password'])."' && userEmail='".$_SESSION['login']."'");
			$num=mysqli_fetch_array($sql);
		if($num>0)
		{
			$con=mysqli_query($con,"update resident set password='".md5($_POST['newpassword'])."', updationDate='$currentTime' where userEmail='".$_SESSION['login']."'");
			$successmsg="Password changed successfully!";
			//echo '<script> alert("Password Changed Successfully !!")</script>';
		}
		else
		{
			$errormsg="Old password not match!";
			//echo '<script> alert("Old Password not match !!")</script>';
		}
		}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Change Password</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Pretty-Registration-Form.css">
    <link rel="stylesheet" href="assets/css/styles.css">
	
	<!-- Site made with Mobirise Website Builder v4.12.3, # -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="generator" content="Mobirise v4.12.3, mobirise.com">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
	<link rel="shortcut icon" href="assets1/images/people-16x16.png" type="image/x-icon">
	<meta name="description" content="">
	
	<link rel="stylesheet" href="assets1/web/assets/mobirise-icons/mobirise-icons.css">
	<link rel="stylesheet" href="assets1/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets1/bootstrap/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="assets1/bootstrap/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="assets1/tether/tether.min.css">
	<link rel="stylesheet" href="assets1/dropdown/css/style.css">
	<link rel="stylesheet" href="assets1/theme/css/style.css">
	<link rel="preload" as="style" href="assets1/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets1/mobirise/css/mbr-additional.css" type="text/css">

	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>

<?php include('includes/navigationBar.php'); ?>

						<?php
						if ($successmsg)
						{
						?>
						<script>
							swal({
								title: "<?php echo htmlentities($successmsg); ?>",
								//text: "You clicked the button!",
								icon: "success",
								button: "OK",
							}).then(function() {
							window.location.href = "dashboard.php";
						});
						<?php } ?>
						</script>

<section class="mbr-section form1 cid-rW8VRkd2Se" id="form1-8">    
    <div class="container">
        <div class="row justify-content-center">
		<form method="post" name="profile" name="chngpwd" class="custom-form" onSubmit="return valid();">
            <div class="title col-12 col-lg-8">
				<br><br>
				<?php 
					$query=mysqli_query($con,"select * from resident where userEmail='".$_SESSION['login']."'");
					while($row=mysqli_fetch_array($query)) 
					{
					?> 
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    <?php echo htmlentities($row['fullName']);?>'s Password Change
                </h2>
				<?php } ?>
            </div>
        </div>
    </div>
    <div class="container">
		<div class="row justify-content-center">
			<div class="media-container-column col-lg-8">
				<div class="row">
					<?php
					if ($errormsg)
					{
					?>
					<script>
						swal({
							title: "<?php echo htmlentities($errormsg); ?>",
							//text: "You clicked the button!",
							icon: "warning",
							button: "OK",
						});
					<?php } ?>
					</script>
					
	
						<div class="dragArea row">
							<div class="col-md-12  form-group">
								<label class="form-control-label mbr-fonts-style display-7">Current Password</label>
								<input type="password" placeholder="Enter your current Password"  name="password" required="required" class="form-control">
							</div>
							<div class="col-md-12  form-group">
								<label class="form-control-label mbr-fonts-style display-7">New Password</label>
								<input type="password" placeholder="Enter your new current Password"  name="newpassword" required="required" class="form-control">
							</div>
							<div class="col-md-12  form-group">
								<label class="form-control-label mbr-fonts-style display-7">Reconfirm Password</label>
								<input type="password" placeholder="Enter your new Password again"  name="confirmpassword" required="required"  class="form-control"> 
							</div>
							
							<div class="col-md-12 input-group-btn align-center">
								<button type="submit" name="submit" class="btn btn-primary btn-form display-4">Submit</button>
							</div>
						</div>
					</form><!---Formbuilder Form--->
						
				</div>
			</div>
		</div>
	</div>
</section>

					<script type="text/javascript">
						function valid()
						{
							if(document.chngpwd.password.value=="")
							{
								alert("Current Password Filed is Empty !!");
								document.chngpwd.password.focus();
								return false;
							}
							else if(document.chngpwd.newpassword.value=="")
							{
								alert("New Password Filed is Empty !!");
								document.chngpwd.newpassword.focus();
								return false;
							}
							else if(document.chngpwd.confirmpassword.value=="")
							{
								alert("Confirm Password Filed is Empty !!");
								document.chngpwd.confirmpassword.focus();
								return false;
							}
							else if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
							{
								alert("Password and Confirm Password Field do not match  !!");
								document.chngpwd.confirmpassword.focus();
								return false;
							}
						return true;
						}
					</script>




  <script src="assets1/web/assets/jquery/jquery.min.js"></script>
  <script src="assets1/popper/popper.min.js"></script>
  <script src="assets1/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets1/tether/tether.min.js"></script>
  <script src="assets1/smoothscroll/smooth-scroll.js"></script>
  <script src="assets1/dropdown/js/nav-dropdown.js"></script>
  <script src="assets1/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets1/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets1/theme/js/script.js"></script>
  <script src="assets1/formoid/formoid.min.js"></script>
  

</body>
</html>
<?php } ?>
