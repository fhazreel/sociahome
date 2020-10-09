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
		if(isset($_POST['submit']))
		{
			$uid				=$_SESSION['id'];
			$category			=$_POST['category'];
			$subcat				=$_POST['subcategory'];
			$complaintype		=$_POST['complaintype'];
			$noc				=$_POST['noc'];
			$complaintdetails	=$_POST['complaindetails'];
			$compfile			=$_FILES["compfile"]["name"];

			move_uploaded_file($_FILES["compfile"]["tmp_name"],"complaintdocs/".$_FILES["compfile"]["name"]);
			$query				=mysqli_query($con,"insert into tblcomplaints(userId,category,subcategory,complaintType,noc,complaintDetails,complaintFile)values('$uid','$category','$subcat','$complaintype','$noc','$complaintdetails','$compfile')");
			// code for show complaint number
			$sql				=mysqli_query($con,"select complaintNumber from tblcomplaints order by complaintNumber desc limit 1");
			while($row=mysqli_fetch_array($sql))
				{
				 $cmpn=$row['complaintNumber'];
				}
			$complainno=$cmpn;
			$successmsg="Your complain has been successfully filled";
			//echo '<script> alert("Your complain has been successfully filled and your complaint no is  "+"'.$complainno.'")</script>';
		}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Site made with Mobirise Website Builder v4.12.3, # -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets1/images/people-16x16.png" type="image/x-icon">
  <meta name="description" content="">
  
  
	<title>Lodge Complaint</title>
	<link rel="stylesheet" href="assets1/web/assets/mobirise-icons/mobirise-icons.css">
	<link rel="stylesheet" href="assets1/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets1/bootstrap/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="assets1/bootstrap/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="assets1/tether/tether.min.css">
	<link rel="stylesheet" href="assets1/dropdown/css/style.css">
	<link rel="stylesheet" href="assets1/theme/css/style.css">
	<link rel="preload" as="style" href="assets1/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets1/mobirise/css/mbr-additional.css" type="text/css">
	
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	
	<script>
		function getCat(val) {
		//alert('val');
		  $.ajax({
		  type: "POST",
		  url: "getSubCategory.php",
		  data:'catid='+val,
		  success: function(data){
			$("#subcategory").html(data);	
		  }
		  });
		  }
	</script>
	
</head>
<body>

<?php include('includes/navigationBar.php'); ?>

<section class="mbr-section form1 cid-rW8VRkd2Se" id="form1-8">    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
				<br><br>
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    Lodge Form
                </h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                    Easily add subscribe and contact forms without any server-side integration.
                </h3>
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

            </div>
					
					
                <!---Formbuilder Form--->
                <form method="post" name="complaint" class="mbr-form form-with-styler" data-form-title="Mobirise Form" enctype="multipart/form-data">
                    <div class="dragArea row">
                        <div class="col-sm-4  form-group" data-for="category">
                            <label class="form-control-label mbr-fonts-style display-7">Category</label>
								<select name="category" id="category" class="form-control" onChange="getCat(this.value);" required="">
									<option value="">Select Category</option>
										<?php $sql=mysqli_query($con,"select id,categoryName from category ");
											while ($rw=mysqli_fetch_array($sql)) {
										?>
									<option value="<?php echo htmlentities($rw['id']);?>"><?php echo htmlentities($rw['categoryName']);?></option>
								<?php
								}
								?>
								</select>
                        </div>
                        <div class="col-md-4  form-group">
                            <label class="form-control-label mbr-fonts-style display-7">Sub Category</label>
                            <select name="subcategory" id="subcategory" class="form-control" required="">
								<option value="">Select Sub Category</option>
							</select> 
                        </div>
                        <div class="col-md-4  form-group">
                            <label class="form-control-label mbr-fonts-style display-7">Complaint Type</label>
                            <select name="complaintype" id="complaintype" class="form-control" required="">
								<option value="">Select Complaint</option>
								<option value="Complaint">Complaint</option>
								<option value="Suggestion">Suggestion</option>
								<option value="Improvement">Improvement</option>
							</select>
                        </div>
						<div class="col-md-12  form-group">
                            <label class="form-control-label mbr-fonts-style display-7">Subject</label>
							<input type="text" name="noc" required="required" value="" required="" placeholder="Complaint's Title" class="form-control">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="form-control-label mbr-fonts-style display-7">Details</label>
                            <textarea name="complaindetails" maxlength="2000" placeholder="Complaint Details" class="form-control display-7"></textarea>
                        </div>
						<div class="col-md-12 form-group">
                            <label class="form-control-label mbr-fonts-style display-7">Complaint Related Doc(if any)</label>
                            <input type="file" name="compfile" class="form-control" value="">
                        </div>
                        <div class="col-md-12 input-group-btn align-center">
                            <button type="submit" name="submit" class="btn btn-primary btn-form display-4">Submit</button>
                        </div>
                    </div>
                </form><!---Formbuilder Form--->
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
