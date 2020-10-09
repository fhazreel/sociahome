<?php session_start(); 
include( 'include/config.php'); 
if(strlen($_SESSION['login'])==0) 
	{ 
		header( 'location:residentLogin.php'); 
	} 
	else
	{ 
		date_default_timezone_set( 'Asia/Kuala_Lumpur');// change according timezone $currentTime=d ate( 'd-m-Y h:i:s A', time () ); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin | Dashboard</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<script type="text/javascript"></script>
	
	
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
    <style> 
       
        * { 
            box-sizing: border-box; 
        } 
          
        body { 
            text-align: center; 
        } 
        
        /* Float three columns */ 
        .column { 
            float: left; 
            width: 33%; 
            padding: 0 10px; 
        } 
          
        .row { 
            margin: 0 -5px; 
        } 
        
        /* Clear floats after the columns */ 
        .row:after { 
            content: ""; 
            display: table; 
        } 
        
        
        /* Style the cards */ 
        .card { 
            padding: 10px; 
            text-align: center; 
            background-color: white; 
            color: black; 

        } 
          
        .card:hover { 
            transform: scale(1.1); 
            background-color: grey; 
            transition-duration: 2s; 
            color: black; 
        } 
          
        .fa { 
            font-size: 90px; 
        } 
    </style> 
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
								<h3>Admin Manage Complaint</h3>
							</div>
							<div class="module-body">
								<section>
									<div class="row"> 
									<div class="column"> 
											<div class="card"> 
												<p><i class="fa fa-tasks"></i></p> 
												<?php 
												$query=mysqli_query($con, "SELECT * FROM tblcomplaints where status is null"); $countcomplaintprocess=mysqli_num_rows($query); ?>
												<h3 style="color:black;"><?php echo htmlentities($countcomplaintprocess);?></h3> 
												<p>Pending Complaint</p> 
											</div> 
										</div> 
										<div class="column"> 
											<div class="card"> 
												<p><i class="fa fa-book"></i></p> 
												<?php 
												$status="in Process" ;
												$query=mysqli_query($con, "SELECT * FROM tblcomplaints where status='$status'"); $countpendingcomplaint=mysqli_num_rows($query); ?>
												<h3 style="color:black;"><?php echo htmlentities($countpendingcomplaint);?></h3> 
												<p>In-Process Complaint</p> 
											</div> 
										</div> 
										<div class="column"> 
											<div class="card"> 
												<p><i class="fa fa-smile-o"></i></p> 
												<?php 
												$status="closed" ;
												$query=mysqli_query($con, "SELECT * FROM tblcomplaints where status='$status'"); $countclosedcomplaint=mysqli_num_rows($query); ?>
												<h3 style="color:black;"><?php echo htmlentities($countclosedcomplaint);?></h3> 
												<p>Closed Complaints</p> 
											</div> 
										</div> 
									</div>
								</section>
								<br>
							</div>
							
							<div class="module-head">
								<h3>Admin Manage Bulletin</h3>
							</div>
							<div class="module-body">
								<section>
									<div class="row"> 
									<div class="column"> 
											<div class="card"> 
												<p><i class="fa fa-home"></i></p> 
												<?php $query=mysqli_query($con, "select * from announcecategory where Is_Active=1"); $countcat=mysqli_num_rows($query); ?>
												<h3 style="color:black;"><?php echo htmlentities($countcat);?></h3> 
												<p>News Category</p> 
											</div> 
										</div> 
										<div class="column"> 
											<div class="card"> 
												<p><i class="fa fa-car"></i></p> 
												<?php $query=mysqli_query($con, "select * from announcesubcategory where Is_Active=1"); $countsubcat=mysqli_num_rows($query); ?>
												<h3 style="color:black;"><?php echo htmlentities($countsubcat);?></h3> 
												<p>News Sub-Category</p> 
											</div> 
										</div> 
										<div class="column"> 
											<div class="card"> 
												<p><i class="fa fa-group"></i></p> 
												<?php $query=mysqli_query($con, "select * from announcements where Is_Active=1"); $countposts=mysqli_num_rows($query); ?>
												<h3 style="color:black;"><?php echo htmlentities($countposts);?></h3> 
												<p>Live News</p> 
											</div> 
										</div> 
									</div>
								</section>
								<br>
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

	<?php include( 'include/footer.php');?>	
		<script>
		var resizefunc = [];
	</script>
	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	

	<!-- Counter js  -->
	<script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
	<script src="../plugins/counterup/jquery.counterup.min.js"></script>
	<!-- App js -->
	<script src="assets/js/dbcounter/jquery.core.js"></script>
	<script src="assets/js/dbcounter/jquery.app.js"></script>
</body>
<?php } ?>
