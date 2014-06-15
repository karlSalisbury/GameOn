<?php
     $pageDescription = "Use this page to add a new Administrator";
     $pageTitle = "Add New Administrator"; 
     include '../inc/connect.php'; 
     include 'inc/adminheader.php'; //session_start(); in this file 
?> 
 
<section id="content"> 
 
<?php
    //code to display error messages
    include 'inc/errormessage.php';
?>
  
 <form action="administratornewprocessing.php" method="post"> 
 <label>Username *</label> <input class='form-control' type="text" name="username" required /><br /> 
 <label>Password *</label> <input class='form-control' type="password" name="password" required pattern=".{8,}" title= "Password must be 8 characters or more" /><br /> 
 <label>First Name *</label> <input class='form-control' type="text" name="firstName" required /><br /> 
 <label>Last Name *</label> <input class='form-control' type="text" name="lastName" required /><br /> 
 <label>Email *</label> <input class='form-control' type="email" name="email" required /><br /> 
 <p><input type="submit" name="newadministrator" value="Add New Administrator" /></p> 
 </form> 
 
</section> <!-- end content --> 
 
<?php 
 include 'inc/adminfooter.php'; 
?>