<?php 
     session_start(); 
     include "../inc/connect.php"; 
?> 
 
<?php 
     $categoryID = $_GET['categoryID']; 
     
     $sql = "DELETE category.* FROM category WHERE categoryID = '$categoryID'"; //delete the category from the category table 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     //user messages 
     $_SESSION['success'] = 'Category deleted successfully.'; //register a session with a success message 
     header('location: categories.php'); 
?>