<?php
	session_start();
	include "../inc/connect.php";
?>

<?php
	$memberID = $_POST['memberID'];
	$username = mysqli_real_escape_string($connect, $_POST['username']);//Prevent SQL injection
	$firstName = mysqli_real_escape_string($connect, $_POST['firstName']);//Prevent SQL injection	
	$lastName = mysqli_real_escape_string($connect, $_POST['lastName']);//Prevent SQL injection	
	$street = mysqli_real_escape_string($connect, $_POST['street']);//Prevent SQL injection	
	$suburb = mysqli_real_escape_string($connect, $_POST['suburb']);//Prevent SQL injection	
	$state = mysqli_real_escape_string($connect, $_POST['state']);//Prevent SQL injection		
	$postcode = mysqli_real_escape_string($connect, $_POST['postcode']);//Prevent SQL injection		
	$country = mysqli_real_escape_string($connect, $_POST['country']);//Prevent SQL injection			
	$phone = mysqli_real_escape_string($connect, $_POST['phone']);//Prevent SQL injection	
	$mobile = mysqli_real_escape_string($connect, $_POST['mobile']);//Prevent SQL injection		
	$email = mysqli_real_escape_string($connect, $_POST['email']);//Prevent SQL injection			
	$gender = mysqli_real_escape_string($connect, $_POST['gender']);//Prevent SQL injection
	$newsletter = mysqli_real_escape_string($connect, $_POST['newsletter']);//Prevent SQL injection			
	
	$sql = "SELECT * FROM member WHERE username='$username'";//check if the username is taken
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//run the query
	$numrow = mysqli_num_rows($result); //count how many rows are returned
	
	if($numrow > 1)//if number of rows in numrow variable is greater than 1, which tells us that the username already exists in the database...
	{
		$_SESSION['error'] = 'The Username you chose is already taken by another person. Please pick another Username';//Put an error message into the $_SESSION superglobal variable if the user picks a username that already exists in the dataase
	}
	elseif($username == "" || $firstName == "" || $lastName == "" || $postcode == "" || $country == "" || $email == "" || $gender == "" || $newsletter == "") //Check if any fields are empty
	{
		$_SESSION['error'] = "All * fields are required.";//if an error occurs initialise a session called 'error' with a msg
		header("location:account.php");//redicrect to registration.php
		exit();
	}
	elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))//Check if email is valid
	{
		$_SESSION['error'] = 'Pleae enter a valid email address.'; //if an error occurs
		header("location:account.php");//Redirect to registration.php
		exit();
	}
	else
	{
		$sql = "UPDATE member SET username='$username', firstName='$firstName', lastName='$lastName', street='$street', suburb='$suburb', state='$state', postcode='$postcode', country='$country', phone='$phone', mobile='$mobile', email='$email', gender='$gender', newsletter='$newsletter' WHERE memberID='$memberID'";
		
		$result = mysqli_query($connect, $sql) or die(mysqli_error($con)); //Run the query
		
		$_SESSION['success'] = 'Account updated successfully'; //if registration is successful initialise a session called 'success' with a msg
		header("location:account.php");//redirect to login.php
	}
?>