<?php 
     session_start(); 
     include "../inc/connect.php"; 
?> 
 
<?php 
     $themeID = $_POST['themeID']; //retrieve the themeID from the hidden form field 
     
     $sql = "UPDATE current SET themeID = '$themeID'"; //update themeID in the current table 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     //user messages 
     $_SESSION['success'] = 'Theme updated successfully.'; //register a session with a success message 
     header('location: themes.php') ; 
?>