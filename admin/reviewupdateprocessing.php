<?php
	session_start();
	include "../inc/connect.php";
?>

<?php
	$reviewID = $_POST['reviewID'];//retrieve reviewID from hidden form field
	
	$title = mysqli_real_escape_string($connect, $_POST['title']);//prevent SQL injection
	$content = mysqli_real_escape_string($connect, $_POST['content']);//prevent SQL injection
	$adminID = mysqli_real_escape_string($connect, $_POST['adminID']);//prevent SQL injection
	$categoryID = mysqli_real_escape_string($connect, $_POST['categoryID']);//prevent SQL injection
	$rating = mysqli_real_escape_string($connect, $_POST['rating']);//prevent SQL injection

	$sql="UPDATE review SET title='$title', content='$content', date=NOW(), adminID='$adminID', categoryID='$categoryID', rating='$rating' WHERE reviewID='$reviewID'";

	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//run query
	
	$_SESSION['success'] = 'Review updated successfully';//if registration is successful initialise a session called success with a msg

	header("location:reviewupdate.php?reviewID=" . $reviewID); //redicred to reviewupdate.php
?>