<?php 
     session_start(); 
     include "../inc/connect.php"; 
?> 
 
<?php 
     $username = mysqli_real_escape_string($connect, $_POST['username']); //prevent SQL injection 
     $password = mysqli_real_escape_string($connect, $_POST['password']); 
     $firstName = mysqli_real_escape_string($connect, $_POST['firstName']); 
     $lastName = mysqli_real_escape_string($connect, $_POST['lastName']); 
     $email = mysqli_real_escape_string($connect, $_POST['email']); 
 
     if (strlen($password) < 8) //check if the password is a minimum of 8 characters long 
     { 
         $_SESSION['error'] = 'Password must be 8 characters or more.'; //if password is less than 8 characters intialise a session called 'error' with a msg 
         header("location:administratornew.php"); //redirect to registration.php 
         exit(); 
     } 
     
     $salt = md5(uniqid(rand(), true)); //create a random salt value
     $password = hash('sha256', $password.$salt); //generate the hashed password with the salt value 
     
     $sql = "SELECT * FROM admin WHERE username='$username'"; //check if the username is taken 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     $numrow = mysqli_num_rows($result); //count how many rows are returned 
     
     if($numrow > 0) //if count greater than 0 
     { 
         $_SESSION['error'] = 'Username taken. Please retry.'; //if an username is taken intialise a session called 'error' with a msg 
         header("location:administratornew.php"); //redirect to registration.php 
         exit(); 
     } 
     elseif ($username == "" || $password == "" || $firstName == "" || $lastName == "" || $email == "") //check if all required fields have data 
     { 
         $_SESSION['error'] = 'All * fields are required.'; //if an error occurs intialise a session called 'error' with a msg 
         header("location:administratornew.php"); //redirect to registration.php 
         exit(); 
     } 
     elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) //check if email is valid 
     { 
         $_SESSION['error'] = 'Please enter a valid email address.'; //if an error occurs intialise a session called 'error' with a msg 
         header("location:administratornew.php"); //redirect to registration.php 
         exit(); 
     } 
     else
     { 
         $sql="INSERT INTO admin (username, password, salt, firstName, lastName, email, joinDate, type) VALUES ('$username', '$password', '$salt', '$firstName', '$lastName', '$email', NOW(), '0')"; 
         $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
         
         $_SESSION['success'] = 'You created a new administrator account.'; //if new administrator account is successful intialise a session called 'success' with a msg 
         header("location:administrators.php"); //redirect to administrators.php 
     } 
?>      