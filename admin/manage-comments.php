<?php
   session_start();
   include('include/config.php');
   error_reporting(0);
   if(strlen($_SESSION['login'])==0)
     { 
   header('location:adminLogin.php');
   }
   else{
   if( $_GET['disid'])
   {
   	$id=intval($_GET['disid']);
   	$query=mysqli_query($con,"update tblcomments set status='0' where id='$id'");
   	$msg="Comment unapprove ";
   }
   // Code for restore
   if($_GET['appid'])
   {
   	$id=intval($_GET['appid']);
   	$query=mysqli_query($con,"update tblcomments set status='1' where id='$id'");
   	$msg="Comment approved";
   }
   
   // Code for deletion
   if($_GET['action']=='del' && $_GET['rid'])
   {
   	$id=intval($_GET['rid']);
   	$query=mysqli_query($con,"delete from  tblcomments  where id='$id'");
   	$delmsg="Category deleted forever";
   }
   
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin| Manage Posts</title>
	<link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link type="text/css" href="css/theme.css" rel="stylesheet">
	<link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App title -->
        <title>SociaHome | Manage Posts</title>

        <!--Morris Chart CSS -->
		<link rel="stylesheet" href="../plugins/morris/morris.css">

        <!-- jvectormap -->
        <link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="../plugins/switchery/switchery.min.css">

		<script language="javascript" type="text/javascript">
			var popUpWin=0;
			function popUpWindow(URLStr, left, top, width, height)
			{
			 if(popUpWin)
			{
			if(!popUpWin.closed) popUpWin.close();
			}
			popUpWin = open(URLStr,'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width='+600+',height='+600+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
			}

		</script>
</head>

<body>
<?php include('include/header.php');?>

	<div class="wrapper">
		<div class="container">
			<div class="row">
			<?php include('include/sidebar.php');?>				
				<div class="span9">
					<div class="content">
						<div class="module">
							<div class="module-head">
								<h3>Approved Comments</h3>
							</div>
							<div class="module-body table">
								<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" width="100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Name</th>
											<th>Email Id</th>
											<th width="300">Comment</th>
											<th>Status</th>
											<th>Post / News</th>
											<th>Posting Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
									<?php 
									$query=mysqli_query($con,"Select tblcomments.id,  tblcomments.name,tblcomments.email,tblcomments.postingDate,tblcomments.comment,announcements.id as postid,announcements.PostTitle from  tblcomments join announcements on announcements.id=tblcomments.postId where tblcomments.status=1");
									
									$cnt=1;
									while($row=mysqli_fetch_array($query))
									{
									?>									
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($row['name']);?></td>
											<td><?php echo htmlentities($row['email']);?></td>
											<td><?php echo htmlentities($row['comment']);?></td>
											<td><?php $st=$row['status'];
												if($st=='0'):
												echo "Wating for approval";
												else:
												echo "Approved";
												endif;
												?></td>
											<td><a href="edit-post.php?pid=<?php echo htmlentities($row['postid']);?>"><?php echo htmlentities($row['PostTitle']);?></a> </td>
											<td><?php echo htmlentities($row['postingDate']);?></td>
											<td>
											  <?php if($st==0):?>
											  <a href="manage-comments.php?disid=<?php echo htmlentities($row['id']);?>">
												<button type="button" class="btn btn-primary">Disapprove</button> 
											  <?php else :?>
											  <a href="manage-comments.php?appid=<?php echo htmlentities($row['id']);?>">
												<button type="button" class="btn btn-primary">Approve</button>
											  <?php endif;?>
											  &nbsp;<a href="manage-comments.php?rid=<?php echo htmlentities($row['id']);?>&&action=del"> 
												<button type="button" class="btn btn-primary">Delete</button>
											</td>
											
											

										</tr>
										<?php $cnt=$cnt+1; }  ?>
									</tbody>
								</table>
							</div>
						</div>						
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

<?php include('include/footer.php');?>

	<script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
	<script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="scripts/datatables/jquery.dataTables.js"></script>
	
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');
		} );
	</script>
</body>
<?php } ?>