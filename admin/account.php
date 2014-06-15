<?php 
    $pageDescription = "Use this page to manage your account";
    $pageTitle = "My Account"; 
    include '../inc/connect.php'; 
    include 'inc/adminheader.php'; //session_start(); in this file 
?> 
 
<?php 
     $adminID = $_SESSION['user']; //retrieve the adminID from the current session 
     
     $sql = "SELECT * FROM admin WHERE adminID = '$adminID'"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     $row = mysqli_fetch_array($result); 
?> 
 
<section id="content"> 
 
 <?php 
    //error messages
    include 'inc/errormessage.php';
 ?> 
  
 <h1 class='page-header'>Update your account details.</h1> 
 
 <form action="accountprocessing.php" method="post"> 
 <div class='alert alert-warning'><label>Username *</label> <input class='form-control' type="text" name="username" required value="<?php echo $row['username'] ?>" readonly /><br /> 
 <p>Username cannot be updated.</p></div> 
 
<label>First Name *</label> <input class='form-control' type="text" name="firstName" required value="<?php echo $row['firstName'] ?>" /><br /> 
 <label>Last Name *</label> <input class='form-control' type="text" name="lastName" required value="<?php echo $row['lastName'] ?>" /><br /> 
 <label>Email *</label> <input class='form-control' type="email" name="email" required value="<?php echo $row['email'] ?>" /><br /> 
 <input type="hidden" name="adminID" value="<?php echo $adminID; ?>"> 
 <p><input type="submit" name="accountupdate" value="Update Account" /></p> 
 </form>
 
 <h1 class='page-header'>Update Password</h1> 
 <p>Passwords must have a minimum of 8 characters.</p> 
 
 <form action="accountpasswordprocessing.php" method="post"> 
 <div class='well'><label>New Password*</label> <input class='form-control' type="password" name="password" pattern=".{8,}" title= "Password must be 8 characters or more" required /><br /> 
 <input type="hidden" name="adminID" value="<?php echo $adminID; ?>"> 
 <p><input type="submit" name="passwordupdate" value="Update Password" /></p>
</div>     
 </form> 
 
</section> <!-- end content --> 
 
<?php 
    include 'inc/adminfooter.php'; 
?> 