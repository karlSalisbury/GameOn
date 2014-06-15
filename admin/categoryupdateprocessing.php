<?php 
     session_start(); 
     include "../inc/connect.php"; 
?> 
 
<?php 
     $categoryID = $_POST['categoryID']; //retrieve reviewID from hidden form field 
     
     $category = mysqli_real_escape_string($connect, $_POST['category']); //prevent SQL injection 
     $description = mysqli_real_escape_string($connect, $_POST['description']); 
     
     $sql="UPDATE category SET category='$category', categoryDesc='$description' WHERE categoryID ='$categoryID'"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($con)); //run the query 
     
     $_SESSION['success'] = 'Category updated successfully'; //if category update is successful intialise a session called 'success' with a msg 
     header("location:categoryupdate.php?categoryID=" . $categoryID); //redirect to categoryupdate.php 
?> 