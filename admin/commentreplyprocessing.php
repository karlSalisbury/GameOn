<?php 
     session_start(); 
     include "../inc/connect.php"; 
?> 
 
<?php 
     $adminID = $_SESSION['user']; //retrieve the adminID from the current session 
     $commentID = $_POST['commentID']; //prevent SQL injection 
     $comment = mysqli_real_escape_string($connect, $_POST['comment']); 
     
     $sql="SELECT * FROM comment WHERE commentID=" . $commentID; //retrieve the reviewID 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     $row = mysqli_fetch_array($result); 
     $reviewID = $row['reviewID']; 
     
     $sql="INSERT INTO comment (commentContent, commentDate, adminID, reviewID) VALUES ('$comment', NOW(), '$adminID', '$reviewID')"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     $_SESSION['success'] = 'New comment successfully added.'; //if new category is added successfully intialise a session called 'success' with a msg 
     header("location:comments.php"); //redirect to comments.php 
?> 