<?php
   session_start();
   include('include/config.php');
   if(strlen($_SESSION['login'])==0)
   	{	
   header('location:adminLogin.php');
   }
   else{
   
   if(isset($_POST['subcatdescription']))
   {
   	$subcatid=intval($_GET['cid']);    
	$categoryid=$_POST['category'];
	$subcatname=$_POST['subcategory'];
	$subcatdescription=$_POST['subcatdescription'];
	$query=mysqli_query($con,"update announcesubcategory set CategoryId='$categoryid',Subcategory='$subcatname',SubCatDescription='$subcatdescription' where SubCategoryId='$subcatid'");
	if($query)
	{
	$msg="Sub-Category Updated successfully ";
	}
	else{
	$error="Something went wrong . Please try again.";    
} 
}
   
   ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin| Edit Post Sub-Category</title>
      <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
      <link type="text/css" href="css/theme.css" rel="stylesheet">
      <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
      <link type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
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
                           <h3>Category</h3>
                        </div>
                        <div class="module-body">
                           <?php if(isset($_POST['submit']))
                              {?>
                           <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">×</button>
                              <strong>Well done!</strong>	<?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
                           </div>
                           <?php } ?>
                           <br />
                           <form class="form-horizontal row-fluid" name="Category" method="post" >
                              <?php
                                 $subcatid=intval($_GET['cid']);
                                 $query=mysqli_query($con, "Select announcecategory.CategoryName as catname,announcecategory.id as catid,announcesubcategory.Subcategory as subcatname,announcesubcategory.SubCatDescription as SubCatDescription,announcesubcategory.PostingDate as subcatpostingdate,announcesubcategory.UpdationDate as subcatupdationdate,announcesubcategory.SubCategoryId as subcatid from announcesubcategory join announcecategory on announcesubcategory.CategoryId=announcecategory.id where announcesubcategory.Is_Active=1 and  SubCategoryId='$subcatid'");
                                 $cnt=1;
								 while($row=mysqli_fetch_array($query))
                                 {
                                 ?>									
                              <div class="control-group">
                                 <label class="control-label" for="basicinput">Category Name</label>
                                 <div class="controls">
                                    <select class="form-control" name="category" required>
                                        <option value="<?php echo htmlentities($row['catid']);?>"><?php echo htmlentities($row['catname']);?></option>
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
								<label class="control-label" for="basicinput">Sub-Category Name</label>
								 <div class="controls">
                                      <input type="text" class="form-control" value="<?php echo htmlentities($row['subcatname']);?>" name="subcategory" required>
                                 </div>
							  </div>
                              <div class="control-group">
                                 <label class="control-label" for="basicinput">Description</label>
                                 <div class="controls">
                                    <textarea class="span8" name="subcatdescription" rows="5"><?php echo  htmlentities($row['SubCatDescription']);?></textarea>
                                 </div>
                              </div>
                              <?php } ?>	
                              <div class="control-group">
                                 <div class="controls">
                                    <button type="submit" name="submit" class="btn">Update</button>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <!--/.content-->
               </div>
               <!--/.span9-->
            </div>
         </div>
         <!--/.container-->
      </div>
      <!--/.wrapper-->
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