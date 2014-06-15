<?php 
     session_start(); 
     include "../inc/connect.php"; 
?> 
 
<?php 
    $commentID = $_GET['commentID']; //retrieve the commentID from the URL 
 
    $sql = "DELETE comment.* FROM comment WHERE commentID = '$commentID'"; //delete the comment from the comment table 
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
 
    //user messages 
    $_SESSION['success'] = 'Comment deleted successfully.'; //register a session with a success message 
    header('location: comments.php'); 
?> 