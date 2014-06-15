<?php
	session_start();
	include "../inc/connect.php";
?>

<?php
	$reviewID = $_GET['reviewID'];
	
	$sql = "DELETE review.* FROM review WHERE reviewID = '$reviewID'";//delete the member details from both the login table and the member table
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run the query
	
	//User messages
	
	$_SESSION['success'] = 'Review deleted successfully.'; //register a session with a success message
	
	header('location:reviews.php');
?>