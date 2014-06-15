<?php 
    session_start(); 
    include "../inc/connect.php"; 
?> 
 
<?php 
    $comment = mysqli_real_escape_string($connect, $_POST['comment']); //prevent SQL injection 
    $reviewID = $_POST['reviewID']; //retrieve the reviewID from the hidden form field 
    $memberID = $_SESSION['user']; //retrieve the memberID from the $_SESSION created when the user logged in 
 
    $sql = "INSERT INTO comment (reviewID, memberID, commentDate, commentContent) VALUES ('$reviewID', '$memberID', NOW(), '$comment')"; 
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
 
 //user messages 
    if($result) 
    { 
    $_SESSION['success'] = 'Comment added successfully'; //register a session with a success message 
    header("location:blogpost.php?reviewID=" . $reviewID); //redirect to the full review page with the appropriate reviewID 
    } 
    else 
    { 
    $_SESSION['error'] = 'An error has occurred. Comment not added.'; //register a session with an error message 
    header("location:blogpost.php?reviewID=" . $reviewID); //redirect to the full review page with the appropriate reviewID 
    }
?> 