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
		$fname=$_POST['fullname'];
		$contactno=$_POST['contactno'];
		$address=$_POST['address'];
		$state=$_POST['state'];
		$country=$_POST['country'];
		$pincode=$_POST['pincode'];
		$query=mysqli_query($con,"update resident set fullName='$fname',contactNo='$contactno',address='$address',State='$state',country='$country',pincode='$pincode' where userEmail='".$_SESSION['login']."'");
		
		if($query)
		{
			$successmsg="Profile successfully updated!";
			//echo '<script> alert("Your profile has been successfully updated")</script>';
		
		}
		else
		{
			$errormsg="Profile not updated!";
			//echo '<script> alert("Failed updating profile")</script>';
		}
		
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Profile</title>
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

<section class="mbr-section form1 cid-rW8VRkd2Se" id="form1-8">    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
				<br><br>
				<?php 
					$query=mysqli_query($con,"select * from resident where userEmail='".$_SESSION['login']."'");
					while($row=mysqli_fetch_array($query)) 
					{
					?> 
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    <?php echo htmlentities($row['fullName']);?>'s Profile
                </h2>
               <!-- <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                    Last Updated at :</b>&nbsp;&nbsp;<?php //echo htmlentities($row['updationDate']);?>
                </h3> -->
            </div>
        </div>
    </div>
    <div class="container">
		<div class="row justify-content-center">
			<div class="media-container-column col-lg-8">
				<div class="row">
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
		

		
					<div class="dragArea row" >
						<div class="col-md-12  form-group" class="center">
							<label class="form-control-label mbr-fonts-style display-7">User Photo</label>
							<div class="col-md-12  form-group center">
								<?php $userphoto=$row['userImage'];
								if($userphoto==""):
								?>
								<img src="userimages/noimage.png" width="300" height="300" >
								<a href="updateImage.php">Change Photo</a><br>
								<?php else:?>
									<img src="userimages/<?php echo htmlentities($userphoto);?>" width="300" height="300">
									<a href="updateImage.php"><br><br>Change Photo</a>
								<?php endif;?><br><br>
							</div>
						</div>
					</div>
					<form method="post" name="profile" class="custom-form">
						<div class="dragArea row">
							<div class="col-md-6  form-group">
								<label class="form-control-label mbr-fonts-style display-7">Full Name</label>
								<input type="text" name="fullname" required="required" value="<?php echo htmlentities($row['fullName']);?>" class="form-control">
							</div>
							<div class="col-md-6  form-group">
								<label class="form-control-label mbr-fonts-style display-7">User Email</label>
								<input type="text" name="useremail" required="required" value="<?php echo htmlentities($row['userEmail']);?>" readonly class="form-control"> 
							</div>
							<div class="col-md-6  form-group">
								<label class="form-control-label mbr-fonts-style display-7">Contact Number</label>
								<input type="text" name="contactno" required="required" value="<?php echo htmlentities($row['contactNo']);?>" class="form-control">
							</div>
							<div class="col-md-6  form-group">
								<label class="form-control-label mbr-fonts-style display-7">Registration Date</label>
								<input type="text" name="regdate" required="required" value="<?php echo htmlentities($row['regDate']);?>" readonly class="form-control"> 
							</div>
							<div class="col-md-12 form-group">
								<label class="form-control-label mbr-fonts-style display-7">Address</label>
								<textarea name="address" data-form-field="Message" maxlength="2000" class="form-control display-7"><?php echo htmlentities($row['address']);?></textarea>
							</div>
							<div class="col-md-4  form-group">
								<label class="form-control-label mbr-fonts-style display-7">State</label>
								<input type="text" name="state" required="required" value="<?php echo htmlentities($row['State']);?>" class="form-control">
							</div>
							<div class="col-md-4  form-group">
								<label class="form-control-label mbr-fonts-style display-7">Country</label>
								<input type="text" name="country" required="required" value="<?php echo htmlentities($row['country']);?>" class="form-control">
							</div>
							<div class="col-md-4  form-group">
								<label class="form-control-label mbr-fonts-style display-7">Pincode</label>
								<input type="text" name="pincode" required="required" value="<?php echo htmlentities($row['pincode']);?>" class="form-control">
							</div>
							
				<?php 	} ?>
							
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
