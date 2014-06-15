<?php 
     session_start(); 
     include "../inc/connect.php"; 
?> 
 
<?php 
     $category = mysqli_real_escape_string($connect, $_POST['category']); //prevent SQL injection 
     $description = mysqli_real_escape_string($connect, $_POST['description']); 
 
    $sql="INSERT INTO category (category, categoryDesc) VALUES ('$category', '$description')"; 
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
 
    $_SESSION['success'] = 'New category successfully added.'; //if new category is added successfully intialise a session called 'success' with a msg 
    header("location:categories.php"); //redirect to categories.php 
 
?>