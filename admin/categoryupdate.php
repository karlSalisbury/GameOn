<?php
    $pageDescription = "Use this page to update category names and descriptions";
     $pageTitle = "Update Category"; 
     include "../inc/connect.php"; 
     include 'inc/adminheader.php'; //session_start(); in this file 
?> 
 
<?php 
     $categoryID = $_GET['categoryID']; //retrieve reviewID from URL 
     
     $sql = "SELECT * FROM category WHERE categoryID = '$categoryID'"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     $row = mysqli_fetch_array($result); 
?> 
 
<section id="content"> 
 
 <?php 
     //include '../includes/dashboardsidebar.php'; 
 ?> 
 <?php 
 //user messages
    if(isset($_SESSION['error'])) //if session error is set 
     { 
         echo '<div class="alert alert-danger">'; 
         echo '<p>' . $_SESSION['error'] . '</p>'; //display error message 
         echo '</div>'; 
         unset($_SESSION['error']); //unset session error 
     } 
         elseif(isset($_SESSION['success'])) //if session success is set 
     { 
         echo '<div class="alert alert-success">'; 
         echo '<p>' . $_SESSION['success'] . '</p>'; //display success message 
         echo '</div>'; 
         unset($_SESSION['success']); //unset session success 
     } 
 ?> 
 
 
 <form action="categoryupdateprocessing.php" method="post"> 
     <label>Category title *</label>
    <input type="text" class='form-control' name="category" required value="<?php echo $row['category'] ?>" /><br /> 
     <label>Description *</label> 
     <textarea name="description" required > <?php echo $row['categoryDesc'] ?></textarea><br /> 
     <input type="hidden" name="categoryID" value="<?php echo $categoryID; ?>"> 
     <p><input type="submit" name="categoryupdate" value="Update Category" /></p> 
 </form> 
</section> <!-- end content --> 
<?php 
     include 'inc/adminfooter.php'; 
?>