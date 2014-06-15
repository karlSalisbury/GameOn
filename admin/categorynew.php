<?php
    $pageDescription = "Use this page to add a new category";
     $pageTitle = "Add New Category"; 
     include "../inc/connect.php"; 
     include 'inc/adminheader.php'; //session_start(); in this file 
?> 
 
<section id="content"> 
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
 
 <h1>Add New Category</h1> 
 
 <form action="categorynewprocessing.php" method="post"> 
     <label>Category *</label> <input class='form-control' type="text" name="category" required /><br /> 
     <label>Description *</label> 
     <textarea name="description" ></textarea><br /> 
     <p><input type="submit" name="categorynew" value="Add New Category" /></p> 
 </form> 
 
</section> <!-- end content --> 
 
<?php 
 include 'inc/adminfooter.php'; 
?> 
     