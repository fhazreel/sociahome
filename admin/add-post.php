<?php session_start(); 
include( 'include/config.php'); 
error_reporting(0); 
	if(strlen($_SESSION['login'])==0) { 
		header( 'location:adminLogin.php'); 
		} 
		else
		{
			// For adding post 
			if(isset($_POST['submit'])) 
			{
				
				$posttitle			=$_POST['posttitle']; 
				$catid				=$_POST['category']; 
				$subcatid			=$_POST['subcategory']; 
				$postdetails		=$_POST['postdescription']; 
				$arr				=explode(" ",$posttitle); 
				//$url				=implode("-",$arr); $imgfile=$_FILES[ "postimage"][ "name"]; // get the image extension 
				//$extension			=substr($imgfile,strlen($imgfile)-4,strlen($imgfile)); // allowed extensions 
				//$allowed_extensions	=array( ".jpg", "jpeg", ".png", ".gif"); // Validation for allowed extensions .in_array() function searches an array for a specific value. 
				// if(!in_array($extension)) 
				// { 
				// echo "<script>alert('Invalid format');</script>"; 
				// } 
				// else 
				// { //rename the image file 
				// $imgnewfile=md5($imgfile).$extension; // Code for move image into directory 
				// move_uploaded_file($_FILES[ "postimage"][ "tmp_name"], "postimages/".$imgnewfile); 
				
				$status=1; 
				$query=mysqli_query($con, "insert into announcements(PostTitle,CategoryId,SubCategoryId,PostDetails,PostUrl,Is_Active) values('$posttitle','$catid','$subcatid','$postdetails','$url','$status')"); 
				//$query=mysqli_query($con, "insert into announcements(PostTitle,CategoryId,SubCategoryId,PostDetails,PostUrl,Is_Active,PostImage) values('$posttitle','$catid','$subcatid','$postdetails','$url','$status','$imgnewfile')"); 
				if($query) 
				{ 
				$msg="Post successfully added " ; } 
				else
				{
				$error="Something went wrong . Please try again." ; 
				} 
				
			} 
		?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Add Posts</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	<script>
		function getSubCat(val) {
		  $.ajax({
		  type: "POST",
		  url: "get_subcategory.php",
		  data:'catid='+val,
		  success: function(data){
		    $("#subcategory").html(data);
		  }
		  });
		  }
	</script>
</head>

<body>
<?php include( 'include/header.php');?>
	<div class="wrapper">
		<div class="container">
			<div class="row">
				<?php include( 'include/sidebar.php');?>
				<div class="span8">
					<div class="content">
						<div class="module">
							<div class="module-head">
								<h3>Admin | Add Posts</h3>
							</div>
							<div class="module-body">
								<div class="row">
									<div class="col-sm-6">  
									<!---Success Message--->  
										<?php if($msg){ ?>
										<div class="alert alert-success" role="alert">
										<strong>Well done!</strong> <?php echo htmlentities($msg);?>
										</div>
										<?php } ?>

										<!---Error Message--->
										<?php if($error){ ?>
										<div class="alert alert-danger" role="alert">
										<strong>Oh snap!</strong> <?php echo htmlentities($error);?></div>
										<?php } ?>
									</div>
								</div>
								
								<div class="row">
								   <div class="col-md-10 col-md-offset-1">
									  <div class="p-6">
											<form class="form-horizontal row-fluid" name="addpost" method="post" >
											   <div class="control-group">
												  <label class="control-label">Post Title </label>
												<div class="controls">
												  <input type="text" class="span8 tip" id="posttitle" name="posttitle" placeholder="Enter title" required>
												</div>
											   </div>
											  
											   <div class="control-group">
												  <label class="control-label">Category </label>
												<div class="controls">
												  <select class="span8 tip" name="category" id="category" onChange="getSubCat(this.value);" required>
													 <option value=""> Select Category </option>
													
													 <?php
														// Feching active categories
														$ret=mysqli_query($con,"select id,CategoryName from  announcecategory where Is_Active=1");
														while($result=mysqli_fetch_array($ret))
														{    
														?>
													 <option value="<?php echo htmlentities($result['id']);?>"><?php echo htmlentities($result['CategoryName']);?></option>
													 <?php } ?>
													
												  </select>
												</div>  
											   </div>
											   <div class="control-group">
												  <label class="control-label">Sub Category</label>
												<div class="controls">
												  <select class="span8 tip" name="subcategory" id="subcategory">
												  </select>
												</div>
											   </div>
											   <div class="control-group">
													<label class="control-label">Post Details</label>
												<div class="controls">
													<textarea class="span10" required name="postdescription" rows="5"></textarea>
												</div>
											   </div>
											   <!--<div class="control-group">
													<label class="control-label">Feature Image</label>
												<div class="controls">
													<input type="file" class="span8 tip" id="postimage" name="postimage">
												</div>
											   </div>-->
											   <div class="control-group">
													<div class="controls">
														<button type="submit" name="submit" class="btn">Save and Post</button>
														<button type="button" class="btn">Discard</button>
													</div>
											   </div>											   
											</form>
										 </div>
									  </div>
								</div> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<?php include( 'include/footer.php');?>	
	

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
</body>
</html>
<?php } ?>
