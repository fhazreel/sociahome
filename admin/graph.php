<?php session_start(); 
//include( 'include/config.php'); 
if(strlen($_SESSION[ 'login'])==0) 
	{ 
		header( 'location:adminLogin.php'); 
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
								<h3>Complaint Report Graph</h3>
							</div>	
							
							<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">    
								<tr bgColor="#000000" style="font-family: sans-serif; color: white " >
										<h3><center>Complaint Data Graph</center></h3>
										<table><br>
											<?php

												// connect to database
												$con = mysqli_connect('localhost', 'root', '', 'sociahome');
												
												if($stmt = $con->query("SELECT subcategory, COUNT(subcategory) AS Total FROM tblcomplaints GROUP BY subcategory"))
													
												{
													echo "<center>No of records : ".$stmt->num_rows."<br><center>";
													
													 $php_data_array = Array(); // create PHP array

													while ($row = $stmt->fetch_row()) {
														
														$php_data_array[] = $row; // Adding to array
													}
													echo "</table>";
												}else{
													echo $con->error;
											}
												//print_r( $php_data_array);
												// You can display the json_encode output here. 
												//echo json_encode($php_data_array); 

												// Transfor PHP array to JavaScript two dimensional array 
												echo "<script>var my_2d = ".json_encode($php_data_array)."
												</script>";
											?>
											<br><br>
												<div id="chart_div" width="415" height="157" style="display: block; width: 750px; height: 357px;"></div>
													<br><br>
														<script type="text/javascript" src="jsLib/loader.js"></script>
														<script type="text/javascript">

														  // Load the Visualization API and the corechart package.
														  google.charts.load('current', {packages: ['corechart', 'bar']});
														  google.charts.setOnLoadCallback(drawChart);
														  
														  function drawChart() {
															//$l = "ml";
															// Create the data table.
															var data = new google.visualization.DataTable();
															data.addColumn('string', 'Type of Complaints');
															data.addColumn('number', 'Current Number');
															//data.addColumn('number', 'Profit');
															
															for(i = 0; i < my_2d.length; i++)
																data.addRow([my_2d[i][0], (parseFloat(my_2d[i][1]))]);
																	var options = {
																		  title: 'Category of Complaints',
																		  hAxis: {title: 'Type of Complaints',  titleTextStyle: {color: '#000'}},
																		  vAxis: {title: 'Current Number)' ,format: '#,####'}
																		};
																	
																var chart = new google.charts.Bar(document.getElementById('chart_div'));
																chart.draw(data, options);
															}
														</script> 
														<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="100%">    
															<td width=1%></td>
																<tr bgColor="#000000">
																	<td width="100%">&nbsp;</td>
																</tr>

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
