<?php
   session_start();
   error_reporting(0);
   include('includes/config.php');
   if(strlen($_SESSION['login'])==0)
     { 
   header('location:residentLogin.php');
   }
   else{
   date_default_timezone_set('Asia/Kolkata');// change according timezone
   $currentTime = date( 'd-m-Y h:i:s A', time () );
   
   
   if(isset($_POST['submit']))
   {
   $imgfile=$_FILES["image"]["name"];
   
   // get the image extension
   $extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
   // allowed extensions
   $allowed_extensions = array(".jpg","jpeg",".png",".gif");
   
   // Validation for allowed extensions .in_array() function searches an array for a specific value.
   if(!in_array($extension,$allowed_extensions))
   {
	   $warningmsg="Invalid format. Only jpg / jpeg/ png /gif format allowed";
		//echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
   }
   else
   {
   //rename the image file
   $imgnewfile=md5($imgfile).$extension;
   // Code for move image into directory
   move_uploaded_file($_FILES["image"]["tmp_name"],"userimages/".$imgnewfile);
   // Query for insertion data into database
   $query=mysqli_query($con,"update resident set userImage='$imgnewfile' where userEmail='".$_SESSION['login']."'");
   if($query)
   {
   $successmsg="Profile photo successfully updated!";
   }
   else
   {
   $errormsg="Profile photo not updated!";
   }
   }
   }
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<title>Change Image</title>
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
						if ($warningmsg)
						{
						?>
						<script>
							swal({
								title: "<?php echo htmlentities($warningmsg); ?>",
								//text: "You clicked the button!",
								icon: "warning",
								button: "OK",
							});
						<?php } ?>
						</script>

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
                    <?php echo htmlentities($row['fullName']);?>'s Image Update
                </h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                    Last Updated at :</b>&nbsp;&nbsp;<?php echo htmlentities($row['updationDate']);?>
                </h3>

            </div>
        </div>
    </div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="media-container-column col-lg-2">
				<div class="row">		
					<form enctype="multipart/form-data"  method="post" name="profile" class="custom-form">
						<div class="dragArea row">
							<div class="col-md-12  form-group">
								<label class="form-control-label mbr-fonts-style display-7">User Photo</label>
								<br>
								<?php $userphoto=$row['userImage'];
                                    if($userphoto==""):
                                    ?>
                                 <img src="userimages/noimage.png" width="300" height="300" >
                                 <?php else:?>
                                 <img src="userimages/<?php echo htmlentities($userphoto);?>" width="300" height="300">
                                 <?php endif;?>
                            </div>
							<div class="col-md-12  form-group">
								<label class="form-control-label mbr-fonts-style display-7">Upload New Photo</label>
								<input type="file" name="image"  required />
							</div>
							<?php } ?>
							
							<div class="col-md-7 input-group-btn align-center">
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
