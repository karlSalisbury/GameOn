<?php 
	session_start(); 
	include "../inc/connect.php"; 
?> 
<?php 
	$reviewID = $_POST['reviewID']; 
	$username = mysqli_real_escape_string($connect, $_POST['username']); //prevent SQL injection
	$password = mysqli_real_escape_string($connect, $_POST['password']); //prevent SQL injection 
 
	$sql = "(SELECT member.username, member.password, member.salt FROM member WHERE username='$username') UNION (SELECT admin.username, admin.password, admin.salt FROM admin WHERE username='$username')"; 
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
 
	$row = mysqli_fetch_array($result); //create a variable called '$row' to store the results 
	$salt = $row['salt']; //retrieve the the random salt from the database 
 
	$password = hash('sha256', $password.$salt); //generate the hashed password with the salt value 
  
	$sql = "(SELECT memberID AS user, username, password, type FROM member WHERE member.username='$username' AND member.password='$password') UNION (SELECT adminID AS user, username, password, type FROM admin WHERE admin.username='$username' AND admin.password='$password')"; 
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
 
	$row = mysqli_fetch_array($result); //create a variable called '$row' to store the results 
	$count=mysqli_num_rows($result); //count the number of rows returned by the query 
 
	if(($count==1) && ($row['type']==1) && ($reviewID > 0)) //if the number of matching records equals 1 and $reviewID > 0 
	{ 
	$_SESSION['member'] = $row['username']; //initialise a session called 'login' to have a value of username 
	$_SESSION['user'] = $row['user']; //initialise a session called 'user' to have a value of the memberID 
	header('location: blogpost.php?reviewID=' . $reviewID . '#comment'); //redirect to review page to leave a comment on successful login 
	} 
	elseif(($count==1) && ($row['type']==0)) //if the number of matching records equals 1 and the user type equals 0 (admin user) 
	{ 
	$_SESSION['admin'] = $row['username']; //initialise a session called 'login' to have a value of username 
	$_SESSION['user'] = $row['user']; //initialise a session called 'user' to have a value of the adminID 
	header('location: ../admin/index.php'); //redirect to the entry page of the dashboard on successful login 
	} 
	elseif(($count==1) && ($row['type']==1)) //if the number of matching records equals 1 
	{ 
	$_SESSION['member'] = $row['username']; //initialise a session called 'login' to have a value of username 
	$_SESSION['user'] = $row['user']; //initialise a session called 'user' to have a value of the memberID 
	header('location: index.php'); //redirect to index.php on successful login 
	} 
	else 
	{ 
	$_SESSION['error'] = "Incorrect Username or Password."; //if an error occurs create a session called 'error' 
	header('location: login.php'); //redirect to login.php on unsuccessful login 
	} 
?>