<?php session_start();
   error_reporting(0);
   include('includes/config.php');
   if(strlen($_SESSION['login'])==0)
     { 
   header('location:residentLogin.php');
   }
   else
   { ?>
<!DOCTYPE html>
<html  >
   <head>
      <!-- Site made with Mobirise Website Builder v4.12.3, https://mobirise.com -->
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="generator" content="Mobirise v4.12.3, mobirise.com">
      <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
      <link rel="shortcut icon" href="assets-cd/images/people-16x16.png" type="image/x-icon">
      <meta name="description" content="">
      <title>Complaint Details</title>
      <link rel="stylesheet" href="assets-cd/web/assets/mobirise-icons/mobirise-icons.css">
      <link rel="stylesheet" href="assets-cd/bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="assets-cd/bootstrap/css/bootstrap-grid.min.css">
      <link rel="stylesheet" href="assets-cd/bootstrap/css/bootstrap-reboot.min.css">
      <link rel="stylesheet" href="assets-cd/tether/tether.min.css">
      <link rel="stylesheet" href="assets-cd/dropdown/css/style.css">
      <link rel="stylesheet" href="assets-cd/theme/css/style.css">
      <link rel="preload" as="style" href="assets-cd/mobirise/css/mbr-additional.css">
      <link rel="stylesheet" href="assets-cd/mobirise/css/mbr-additional.css" type="text/css">
	  
	  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	  
   </head>
   <body>
   
<?php include('includes/navigationBar.php'); ?>

      <section class="services5 cid-s1wuZQfs4Z" id="services5-3">
         <div class="container">
            <div class="row">
               <!--Titles-->
               <div class="title pb-5 col-12"><br><br>
                  <h2 class="align-left mbr-fonts-style m-0 display-2">
                     Complaint Details
                  </h2>
               </div>
			       <?php $query=mysqli_query($con,"select tblcomplaints.*,category.categoryName as catname from tblcomplaints join category on category.id=tblcomplaints.category where userId='".$_SESSION['id']."' and complaintNumber='".$_GET['cid']."'");
                  while($row=mysqli_fetch_array($query))
                  {	?>
               <!--Card-1-->
               <div class="card px-3 col-12">
                  <div class="card-wrapper media-container-row media-container-row">
                     <div class="card-box">
                        <div class="top-line pb-1">
                           <p class="card-title mbr-fonts-style display-8">
                              Complaint Number: <?php echo htmlentities($row['complaintNumber']);?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <!--Card-2-->
               <div class="card px-3 col-12">
                  <div class="card-wrapper media-container-row media-container-row">
                     <div class="card-box">
                        <div class="top-line pb-1">
                           <p class="card-title mbr-fonts-style display-8">
                              Reg. Date: <?php echo htmlentities($row['regDate']);?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <!--Card-3-->
               <div class="card px-3 col-12">
                  <div class="card-wrapper media-container-row media-container-row">
                     <div class="card-box">
                        <div class="top-line pb-1">
                           <p class="card-title mbr-fonts-style display-8">
                              Category: <?php echo htmlentities($row['catname']);?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <!--Card-4-->
               <div class="card px-3 col-12">
                  <div class="card-wrapper media-container-row media-container-row">
                     <div class="card-box">
                        <div class="top-line pb-1">
                           <p class="card-title mbr-fonts-style display-8">
                              Sub Category:<?php echo htmlentities($row['subcategory']);?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <!--Card-5-->
               <div class="card px-3 col-12">
                  <div class="card-wrapper media-container-row media-container-row">
                     <div class="card-box">
                        <div class="top-line pb-1">
                           <p class="card-title mbr-fonts-style display-8">
                             Complaint Type:  <?php echo htmlentities($row['complaintType']);?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <!--Card-6-->
               <div class="card px-3 col-12">
                  <div class="card-wrapper media-container-row media-container-row">
                     <div class="card-box">
                        <div class="top-line pb-1">
                           <p class="card-title mbr-fonts-style display-8">
                              Nature of Complaint: <?php echo htmlentities($row['noc']);?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <!--Card-7-->
			    <div class="card px-3 col-12">
                  <div class="card-wrapper media-container-row media-container-row">
                     <div class="card-box">
                        <div class="top-line pb-1">
                           <p class="card-title mbr-fonts-style display-8">
                             File:
								<?php $cfile=$row['complaintFile'];
								if($cfile=="" || $cfile=="NULL")
								{
								  echo htmlentities("File NA");
								}
								else{ ?>
								<a href="complaintdocs/<?php echo htmlentities($row['complaintFile']);?>" target='_blank'> View File</a>
								<?php } ?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <!--Card-8-->
			   	<div class="card px-3 col-12">
                  <div class="card-wrapper media-container-row media-container-row">
                     <div class="card-box">
                        <div class="top-line pb-1">
                           <p class="card-title mbr-fonts-style display-8">
                             Complaint Description: <?php echo htmlentities($row['complaintDetails']);?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
			      <?php 
                  $ret=mysqli_query($con,"select complaintremark.remark as remark,complaintremark.status as sstatus,complaintremark.remarkDate as rdate from complaintremark join tblcomplaints on tblcomplaints.complaintNumber=complaintremark.complaintNumber where complaintremark.complaintNumber='".$_GET['cid']."'");
                  while($rw=mysqli_fetch_array($ret))
                  {
                  ?>
               <!--Card-9-->
			   	<div class="card px-3 col-12">
                  <div class="card-wrapper media-container-row media-container-row">
                     <div class="card-box">
                        <div class="top-line pb-1">
                           <p class="card-title mbr-fonts-style display-8">
                             Remark:
							 	<?php echo  htmlentities($rw['remark']); ?><br /><b>Remark Date: 
								<?php echo  htmlentities($rw['rdate']); ?></b>
                           </p>
                        </div>
                     </div>
                  </div>
               </div><?php } ?>
               <!--Card-10-->
			   	<div class="card px-3 col-12">
                  <div class="card-wrapper media-container-row media-container-row">
                     <div class="card-box">
                        <div class="top-line pb-1">
                           <p class="card-title mbr-fonts-style display-8">
                             Final Status:
							 	<?php 
								if($row['status']=="NULL" || $row['status']=="" )
								{
								echo "Not Process yet";
								} else{
									echo htmlentities($row['status']);
								}
								?>
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <!--Card-12--> <?php } ?>
            </div>
         </div>
      </section>
      <script src="assets-cd/web/assets/jquery/jquery.min.js"></script>
      <script src="assets-cd/popper/popper.min.js"></script>
      <script src="assets-cd/bootstrap/js/bootstrap.min.js"></script>
      <script src="assets-cd/tether/tether.min.js"></script>
      <script src="assets-cd/smoothscroll/smooth-scroll.js"></script>
      <script src="assets-cd/dropdown/js/nav-dropdown.js"></script>
      <script src="assets-cd/dropdown/js/navbar-dropdown.js"></script>
      <script src="assets-cd/touchswipe/jquery.touch-swipe.min.js"></script>
      <script src="assets-cd/theme/js/script.js"></script>
   </body>
</html>
<?php } ?>