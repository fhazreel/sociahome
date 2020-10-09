<?php session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:residentLogin.php');
}
else{ ?>
<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.12.3, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/people-16x16.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Home</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/dropdown/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="preload" as="style" href="assets/mobirise/css/mbr-additional.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
</head>
<body>

<?php include('includes/navigationBar.php'); ?>
	
	<section class="counters1 counters cid-rVVPyk0fom" id="counters1-3">
		<div class="container"><br><br>
			<h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">
				Complaint Status
			</h2>
			<h3 class="mbr-section-subtitle mbr-fonts-style display-5">
				Here are the status of your complaints progress
			</h3>

			<div class="container pt-4 mt-2">
				<div class="media-container-row">
					<div class="card p-3 align-center col-12 col-md-6 col-lg-4">
						<div class="panel-item p-3">
							<div class="card-img pb-3">
								<span class="mbr-iconfont mbri-edit"></span>
							</div>

							<div class="card-text">
								<?php 
									$rt = mysqli_query($con,"SELECT * FROM tblcomplaints where userId='".$_SESSION['id']."' and status is null");
									$num1 = mysqli_num_rows($rt);
									{?>
								<h3 class="count pt-3 pb-3 mbr-fonts-style display-2">
									  <?php echo htmlentities($num1);?>
								</h3>
								<h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">
									Pending Complaint
								</h4>
								<p class="mbr-content-text mbr-fonts-style display-7">
									
								</p>
								<?php }?>
							</div>
						</div>
					</div>


					<div class="card p-3 align-center col-12 col-md-6 col-lg-4">
						<div class="panel-item p-3">
							<div class="card-img pb-3">
								<span class="mbr-iconfont mbri-pages"></span>
							</div>
							<div class="panel-item p-3">
								<?php 
									$status="in Process";                   
									$rt = mysqli_query($con,"SELECT * FROM tblcomplaints where userId='".$_SESSION['id']."' and  status='$status'");
									$num1 = mysqli_num_rows($rt);
									{?>
								<h3 class="count pt-3 pb-3 mbr-fonts-style display-2">
									  <?php echo htmlentities($num1);?>
								</h3>
								<h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">
									Complaint in Process
								</h4>
								<p class="mbr-content-text mbr-fonts-style display-7">
									
								</p>
								<?php }?>
							</div>
						</div>
					</div>

					<div class="card p-3 align-center col-12 col-md-6 col-lg-4">
						<div class="panel-item p-3">
							<div class="card-img pb-3">
								<span class="mbr-iconfont mbri-cust-feedback"></span>
							</div>
							<div class="card-text">
								<?php 
									$status="closed";                   
									$rt = mysqli_query($con,"SELECT * FROM tblcomplaints where userId='".$_SESSION['id']."' and  status='$status'");
									$num1 = mysqli_num_rows($rt);
									{?>
								<h3 class="count pt-3 pb-3 mbr-fonts-style display-2">
									  <?php echo htmlentities($num1);?>
								</h3>
								<h4 class="mbr-content-title mbr-bold mbr-fonts-style display-7">
									Closed Complaint
								</h4>
								<p class="mbr-content-text mbr-fonts-style display-7">
									
								</p>
								<?php }?>
							</div>
						</div>
					</div>  
				</div>
			</div>
	   </div>	   
	</section>
	
	<section class="timeline1 cid-rVW1aPUrcp" id="timeline1-5">
		<div class="container align-center">
			<h2 class="mbr-section-title pb-3 mbr-fonts-style display-2">
				Announcements Board
			</h2>
			<h3 class="mbr-section-subtitle pb-5 mbr-fonts-style display-5">
				Connect and keep the updated event news here
			</h3>
					
			<div class="container timelines-container">
				<!-- Blog Post -->		
				<?php 
							if (isset($_GET['pageno'])) {
							$pageno = $_GET['pageno'];
							} else {
								$pageno = 1;
							}
							$no_of_records_per_page = 8;
							$offset = ($pageno-1) * $no_of_records_per_page;
						
							$total_pages_sql = "SELECT COUNT(*) FROM announcements";
							$result = mysqli_query($con,$total_pages_sql);
							$total_rows = mysqli_fetch_array($result)[0];
							$total_pages = ceil($total_rows / $no_of_records_per_page);

							
							$query=mysqli_query($con,"select announcements.id as pid,announcements.PostTitle as posttitle,announcements.PostImage,announceCategory.CategoryName as category,announceCategory.id as cid,announceSubCategory.Subcategory as subcategory,announcements.PostDetails as postdetails,announcements.PostingDate as postingdate,announcements.PostUrl as url from announcements left join announceCategory on announceCategory.id=announcements.CategoryId left join  announceSubCategory on  announceSubCategory.SubCategoryId=announcements.SubCategoryId where announcements.Is_Active=1 order by announcements.id desc  LIMIT $offset, $no_of_records_per_page");
							while ($row=mysqli_fetch_array($query)) 
						{ 
						?>
				<div class="row timeline-element reverse separline">
					 <div class="timeline-date-panel col-xs-12 col-md-6  align-left">   
						<div class="time-line-date-content">
							<p class="mbr-timeline-date mbr-fonts-style display-5">
								Posted on: <?php echo htmlentities($row['postingdate']);?>
							</p>
						</div>
					</div>
					   <span class="iconBackground" >
					   </span>
					<div class="col-xs-12 col-md-6 align-right">
						<div class="timeline-text-content">
								<h4 class="mbr-timeline-title pb-3 mbr-fonts-style display-5">
									<?php echo htmlentities($row['posttitle']);?>
								</h4>
							<p class="mbr-timeline-text mbr-fonts-style display-7">
								<p><b>Category : </b><?php echo htmlentities($row['category']);?></a> </p>
								<a href="newsDetails.php?nid=<?php echo htmlentities($row['pid'])?>" class="btn btn-primary">Read More &rarr;</a>
							</p>
						 </div>
					</div>
				</div> <?php } ?>   
			</div>
		<!-- Pagination -->
		<ul class="pagination justify-content-center mb-4">
			<li class="page-item">
				<a href="?pageno=1"  class="page-link">First</a>
			</li>
			<li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
				<a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Prev</a>
			</li>
			<li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
				<a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
			</li>
			<li class="page-item">
				<a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a>
			</li>
		</ul>
		</div>
	</section>


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
<?php } ?>