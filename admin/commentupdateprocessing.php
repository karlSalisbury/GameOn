<?php 
     session_start(); 
     include "../inc/connect.php"; 
?> 
 
<?php 
     $commentID = $_POST['commentID']; //retrieve commentID from hidden form field 
     $type = $_POST['type']; //retrieve the type of user 
     
     $comment = mysqli_real_escape_string($connect, $_POST['comment']); //prevent SQL injection 
     $reviewID = mysqli_real_escape_string($connect, $_POST['reviewID']); 
 
 if($type == 1) //if the user is a member UPDATE the following columns 
     { 
     $memberID = mysqli_real_escape_string($connect, $_POST['memberID']); 
     
     $sql="UPDATE comment SET commentContent='$comment', memberID='$memberID', reviewID='$reviewID', commentDate=NOW() WHERE commentID='$commentID'"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query
         $_SESSION['success'] = 'Comment updated successfully'; //if registration is successful intialise a session called 'success' with a msg 
     header("location:commentupdate.php?type=1&&commentID=" . $commentID); 
    //redirect to commentupdate.php 
     } 
 else //if the user is an admin UPDATE the following columns 
     { 
     $sql="UPDATE comment SET commentContent='$comment', commentDate=NOW() WHERE commentID='$commentID'"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
         $_SESSION['success'] = 'Comment updated successfully'; //if registration is successful intialise a session called 'success' with a msg 
     header("location:commentupdate.php?type=0&&commentID=" . $commentID); 
     //redirect to commentupdate.php 
 } 
?>