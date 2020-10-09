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
?>
<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.12.3, # -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets2/images/people-16x16.png" type="image/x-icon">
  <meta name="description" content="">
  
  
  <title>Complaint History</title>
  <link rel="stylesheet" href="assets2/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets2/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets2/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets2/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets2/tether/tether.min.css">
  <link rel="stylesheet" href="assets2/dropdown/css/style.css">
  <link rel="stylesheet" href="assets2/datatables/data-tables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets2/theme/css/style.css">
  <link rel="preload" as="style" href="assets2/mobirise/css/mbr-additional.css"><link rel="stylesheet" href="assets2/mobirise/css/mbr-additional.css" type="text/css">
  
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  
</head>
<body>
<?php include('includes/navigationBar.php'); ?>

<section class="section-table cid-rWfbRwLltX" id="table1-9">
	<div class="container container-table"><br><br>
		<h2 class="mbr-section-title mbr-fonts-style align-center pb-3 display-2">
			Complaint History
		</h2>
      <div class="table-wrapper">
        <div class="container">
          <div class="row search">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="dataTables_filter">
					<label class="searchInfo mbr-fonts-style display-7">Search:</label>
					<input class="form-control input-sm" disabled="">
                </div>
            </div>
          </div>
        </div>
        <div class="container scroll">
			<table class="table isSearch" cellspacing="0">
				<thead>
					<tr class="table-heads ">
						<th class="head-item mbr-fonts-style display-7">
							Complaint No
						</th>
						<th class="head-item mbr-fonts-style display-7">
							Register Date
						</th>
						<th class="head-item mbr-fonts-style display-7">
							Latest Updation Date
						</th>
						<th class="head-item mbr-fonts-style display-7">
						Status
						</th>
						<th class="head-item mbr-fonts-style display-7">
						Action
						</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				
					$query=mysqli_query($con,"select * from tblcomplaints where userId='".$_SESSION['id']."'");
					while($row=mysqli_fetch_array($query))
				{
				?>
				<tr>  
					<td class="body-item mbr-fonts-style display-7"><?php echo htmlentities($row['complaintNumber']);?></td>
					<td class="body-item mbr-fonts-style display-7"><?php echo htmlentities($row['regDate']);?></td>
					<td class="body-item mbr-fonts-style display-7"><?php echo htmlentities($row['lastUpdationDate']);?></td>
					<td class="body-item mbr-fonts-style display-7"><?php echo htmlentities($row['status']);?></td>
					<td class="body-item mbr-fonts-style display-7">
						<a href="complaintDetails.php?cid=<?php echo htmlentities($row['complaintNumber']);?>">View Details</a>
					</td>
				</tr>
		<?php 	} 	?>
				</tbody>
			</table>
        </div>
        <div class="container table-info-container">
			<div class="row info">
				<div class="col-md-6">
				<div class="dataTables_info mbr-fonts-style display-7">
					<span class="infoBefore">Showing</span>
					<span class="inactive infoRows"></span>
					<span class="infoAfter">entries</span>
					<span class="infoFilteredBefore">(filtered from</span>
					<span class="inactive infoRows"></span>
					<span class="infoFilteredAfter"> total entries)</span>
				</div>
				</div>
				<div class="col-md-6"></div>
			</div>
        </div>
      </div>
    </div>
</section>


  <script src="assets2/web/assets/jquery/jquery.min.js"></script>
  <script src="assets2/popper/popper.min.js"></script>
  <script src="assets2/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets2/tether/tether.min.js"></script>
  <script src="assets2/smoothscroll/smooth-scroll.js"></script>
  <script src="assets2/dropdown/js/nav-dropdown.js"></script>
  <script src="assets2/dropdown/js/navbar-dropdown.js"></script>
  <script src="assets2/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="assets2/datatables/jquery.data-tables.min.js"></script>
  <script src="assets2/datatables/data-tables.bootstrap4.min.js"></script>
  <script src="assets2/theme/js/script.js"></script>
  
  
</body>
</html>

<?php } ?>