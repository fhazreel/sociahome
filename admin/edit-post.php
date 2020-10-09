<?php session_start(); 
include( 'include/config.php'); 
error_reporting(0); 
	if(strlen($_SESSION['login'])==0) { 
		header( 'location:adminLogin.php'); 
		} 
		else
		{
			// For adding post 
			if(isset($_POST['update'])) 
			{
				
				$posttitle			=$_POST['posttitle']; 
				$catid				=$_POST['category']; 
				$subcatid			=$_POST['subcategory']; 
				$postdetails		=$_POST['postdescription']; 
				$arr				=explode(" ",$posttitle); 
				$status=1; 
				$postid=intval($_GET['pid']);
				$query=mysqli_query($con, "update announcements set PostTitle='$posttitle',CategoryId='$catid',SubCategoryId='$subcatid',PostDetails='$postdetails',PostUrl='$url',Is_Active='$status' where id='$postid'");
				
				if($query) 
				{ 
				$msg="Post successfully updated " ; } 
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
	<title>Admin| Edit Posts</title>
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
								<h3>Admin | Edit Posts</h3>
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
								
								<?php
								// Feching active categories
									$postid=intval($_GET['pid']);
									$ret=mysqli_query($con,"select announcements.id as postid,announcements.PostImage,announcements.PostTitle as title,announcements.PostDetails,announcecategory.CategoryName as category,announcecategory.id as catid,announcesubcategory.SubCategoryId as subcatid,announcesubcategory.Subcategory as subcategory from announcements left join announcecategory on announcecategory.id=announcements.CategoryId left join announcesubcategory on announcesubcategory.SubCategoryId=announcements.SubCategoryId where announcements.id='$postid' and announcements.Is_Active=1 ");
									while($row=mysqli_fetch_array($ret))
									{    
									?>
								
								<div class="row">
								   <div class="col-md-10 col-md-offset-1">
									  <div class="p-6">
											<form class="form-horizontal row-fluid" name="addpost" method="post">
											   <div class="control-group">
												  <label class="control-label">Post Title </label>
												<div class="controls">
												  <input type="text" class="span8 tip" value="<?php echo htmlentities($row['title']);?>" id="posttitle" name="posttitle" required>
												</div>
											   </div>
											  
											   <div class="control-group">
												  <label class="control-label">Category </label>
												<div class="controls">
												  <select class="span8 tip" name="category" id="category" onChange="getSubCat(this.value);" required>
													 <option value="<?php echo htmlentities($row['catid']);?>"><?php echo htmlentities($row['category']);?></option>
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
												  <option value="<?php echo htmlentities($row['subcatid']);?>"><?php echo htmlentities($row['subcategory']);?></option>
												  </select>
												</div>
											   </div>
											   <div class="control-group">
													<label class="control-label">Post Details</label>
												<div class="controls">
													<textarea class="span10" name="postdescription" required rows="5"><?php echo htmlentities($row['PostDetails']);?></textarea>
												</div>
											   </div>
											   <!--<div class="control-group">
													<label class="control-label">Feature Image</label>
												<div class="controls">
													<input type="file" class="span8 tip" id="postimage" name="postimage">
												</div>
											   </div>-->
											   <?php } ?>
											   <div class="control-group">
													<div class="controls">
														<button type="submit" name="update" class="btn">Update</button>
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