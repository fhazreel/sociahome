<?php session_start(); 
include('includes/config.php'); //Genrating CSRF Token 
if (empty($_SESSION['token'])) 
	{ 
	$_SESSION['token']= bin2hex(random_bytes(32)); 
	} 
	if(isset($_POST[ 'submit'])) 
	{ //Verifying CSRF Token 
		if (!empty($_POST[ 'csrftoken'])) 
		{ 
			if (hash_equals($_SESSION[ 'token'], $_POST[ 'csrftoken'])) 
			{ 
				$name=$_POST[ 'name']; 
				$email=$_POST[ 'email']; 
				$comment=$_POST[ 'comment']; 
				$postid=intval($_GET[ 'nid']); 
				$st1='0'; 
				$query=mysqli_query($con, "insert into tblcomments(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')"); 
				$msg="Comment successfully submit. Will display after admin review";
				
				?> <?php 			
		if ($msg)
		{
		?>
			<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
			<script>
			
			
				swal({
					title: "<?php echo htmlentities($msg); ?>",
					//text: "You clicked the button!",
					icon: "success",
					button: "OK",
					}).then(function() {
					window.location.href = "dashboard.php";
				});
	<?php } ?>
</script> 
<?php
					if ($errmsg)
					{
					?>
					<script>
						swal({
							title: "<?php echo htmlentities($errmsg); ?>",
							//text: "You clicked the button!",
							icon: "warning",
							button: "OK",
						});
					<?php } ?>
					</script>
					
					<?php
				
				
				
				//$errmsg="Something went wrong. Please try again";
				
				//if($query): echo "<script>alert('comment successfully submit. Comment will be display after admin review ');</script>"; 
				unset($_SESSION[ 'token']); 
				//else : echo "<script>alert('Something went wrong. Please try again.');</script>"; 
				//endif; 
				
			}
			else
			{	
				$errmsg="Something went wrong. Please try again";
			}
		} 
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- Site made with Mobirise Website Builder v4.12.3, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/people-16x16.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>News Site Details</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
	
	

</head>

<body>
	<!-- Navigation -->
	<?php include('includes/navigationBar.php'); ?>

	<!-- Page Content -->
	<div class="container"><br><br><br>
		<div class="row" style="margin-top: 4%">
			<!-- Blog Entries Column -->
			<div class="col-md-8">
				<!-- Blog Post -->
				<?php 
					$pid=intval($_GET['nid']); 
					$query=mysqli_query($con, "select announcements.PostTitle as posttitle,announcements.PostImage,announcecategory.CategoryName as category,announcecategory.id as cid,announcesubcategory.Subcategory as subcategory,announcements.PostDetails as postdetails,announcements.PostingDate as postingdate,announcements.PostUrl as url from announcements left join announcecategory on announcecategory.id=announcements.CategoryId left join  announcesubcategory on  announcesubcategory.SubCategoryId=announcements.SubCategoryId where announcements.id='$pid'"); 
					while ($row=mysqli_fetch_array($query)) 
				{ 
				?>
				<div class="card mb-4">
					<div class="card-body">
						<h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
						<p><b>Category : </b><?php echo htmlentities($row[ 'category']);?>
							</a>| <b>Sub Category : </b>
							<?php echo htmlentities($row['subcategory']);?> <b>| Posted on </b>
							<?php echo htmlentities($row['postingdate']);?>
						</p>
						<hr />
						<!--<img class="img-fluid rounded" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">--->
						<p class="card-text"><b>
							<?php $pt=$row[ 'posttitle']; echo (substr($pt,0));?>
						</b></p>
						<p class="card-text">
							<?php $pt=$row[ 'postdetails']; echo (substr($pt,0));?>
						</p>
					</div>
					<div class="card-footer text-muted"></div>
				</div>
				<?php } ?>
			</div>
			<!-- Sidebar Widgets Column -->
		</div>
		<!-- /.row -->
		<!---Comment Section --->
		<div class="row" style="margin-top: 2%">
			<div class="col-md-8">
				<div class="panel-item p-3">
					<h5 class="card-img pb-3">Leave a Comment:</h5>
					<div class="card-text">
						<form name="Comment" method="post">
							<input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
							<div class="form-group">
								<input type="text" name="name" class="form-control" placeholder="Enter your name" required>
							</div>
							<div class="form-group">
								<input type="email" name="email" class="form-control" placeholder="Enter your valid email" required>
							</div>
							<div class="form-group">
								<textarea class="form-control" name="comment" rows="3" placeholder="Comment" required></textarea>
							</div>
							<button type="submit" class="btn btn-primary" name="submit">Submit</button>
						</form>
					</div>
				</div>
				<!---Comment Display Section --->
				<?php 
					$sts=1; 
					$query=mysqli_query($con, "select name,comment,postingDate from  tblcomments where postId='$pid' and status='$sts'"); 
					while ($row=mysqli_fetch_array($query)) 
					{ ?>
				<div class="media mb-4">
					<img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
					<div class="media-body">
						<h5 class="mt-0"><?php echo htmlentities($row['name']);?> <br />
							<span style="font-size:11px;"><b>at</b> <?php echo htmlentities($row['postingDate']);?></span>
						</h5>
						<?php echo htmlentities($row['comment']);?><br><br>
					</div>
				</div>
				<?php } ?> 
			</div>
		</div>
	</div><br><br><br><br>
	<!-- Bootstrap core JavaScript -->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	
	<script src="assets/web/assets/jquery/jquery.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/tether/tether.min.js"></script>
    <script src="assets/smoothscroll/smooth-scroll.js"></script>
    <script src="assets/dropdown/js/nav-dropdown.js"></script>
    <script src="assets/dropdown/js/navbar-dropdown.js"></script>
    <script src="assets/touchswipe/jquery.touch-swipe.min.js"></script>
    <script src="assets/viewportchecker/jquery.viewportchecker.js"></script>
    <script src="assets/theme/js/script.js"></script>
</body>

</html>
