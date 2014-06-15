<?php 
     session_start(); 
     include "../inc/connect.php"; 
?> 
 
<?php 
     $memberID = $_REQUEST['memberID']; //retrieve the memberID from the URL or hidden form field whichever is available 
     
     $sql = "DELETE member.* FROM member WHERE memberID = '$memberID'"; //delete the member details from both the login table and the member table 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     //user messages 
     $_SESSION['success'] = 'Member deleted successfully.'; //register a session with a success message 
     unset($_SESSION['member']); //unset the member session that was registered during the login process when the account is deleted 
     unset($_SESSION['user']); //unset the user session that was registered during the login process when the account is deleted 
     header('location: members.php'); 
?>