<?php 
     session_start(); 
     include "../inc/connect.php"; 
?> 
 
<?php 
     $username = mysqli_real_escape_string($connect, $_POST['username']); //prevent SQL injection 
     $password = mysqli_real_escape_string($connect, $_POST['password']); 
     $firstName = mysqli_real_escape_string($connect, $_POST['firstName']); 
     $lastName = mysqli_real_escape_string($connect, $_POST['lastName']); 
     $street = mysqli_real_escape_string($connect, $_POST['street']); 
     $suburb = mysqli_real_escape_string($connect, $_POST['suburb']); 
     $state = mysqli_real_escape_string($connect, $_POST['state']); 
     $postcode = mysqli_real_escape_string($connect, $_POST['postcode']); 
     $country = mysqli_real_escape_string($connect, $_POST['country']); 
     $phone = mysqli_real_escape_string($connect, $_POST['phone']); 
     $mobile = mysqli_real_escape_string($connect, $_POST['mobile']); 
     $email = mysqli_real_escape_string($connect, $_POST['email']); 
     $gender = mysqli_real_escape_string($connect, $_POST['gender']); 
     $newsletter = mysqli_real_escape_string($connect, $_POST['newsletter']); 
    if($_FILES['image']['name']) //if an image has been uploaded 
 { 
     $image = $_FILES['image']['name']; //the PHP file upload variable for a file 
     $randomDigit = rand(0000,9999); //generate a random numerical digit <= 4 characters 
     $newImageName = strtolower($randomDigit . "_" . $image); //attach the random digit to the front of uploaded images to prevent overriding files with the same name in the images folder and enhance security 
     $target = "../images/avatars/" . $newImageName; //the target for uploaded images 
     
     $allowedExts = array('jpg', 'jpeg', 'gif', 'png'); //create an array with the allowed file extensions 
     $tmp = explode('.', $_FILES['image']['name']); //split the file name from the file extension 
     $extension = end($tmp); //retrieve the extension of the photo e.g., png 
     
     if($_FILES['image']['size'] > 512000) //image maximum size is 500kb 
     { 
         $_SESSION['error'] = 'Your file size exceeds maximum of 500kb.'; //if file exceeds max size intialise a session called 'error' with a msg 
         header("location:membernew.php"); //redirect to membernew.php 
         exit(); 
     } 
     elseif(($_FILES['image']['type'] == 'image/jpg') || ($_FILES['image']['type'] == 'image/jpeg') || ($_FILES['image']['type'] == 'image/gif') || ($_FILES['image']['type'] == 'image/png') && in_array($extension, $allowedExts)) 
     { 
         move_uploaded_file($_FILES['image']['tmp_name'], $target); //move the image to images folder 
     } 
     else 
     {
        $_SESSION['error'] = 'Only JPG, GIF and PNG files allowed.'; //if file uses an invalid extension intialise a session called 'error' with a msg 
        header("location:membernew.php"); //redirect to membernew.php 
        exit(); 
     } 
 } 
 
 if (strlen($password) < 8) //check if the password is a minimum of 8 characters long 
 { 
     $_SESSION['error'] = 'Password must be 8 characters or more.'; //if password is less than 8 characters intialise a session called 'error' with a msg 
     header("location:membernew.php"); //redirect to membernew.php 
     exit(); 
 } 
 
 $salt = md5(uniqid(rand(), true)); //create a random salt value 
 $password = hash('sha256', $password.$salt); //generate the hashed password with the salt value 
 
 $sql = "SELECT * FROM member WHERE username='$username'"; //check if the username is taken 
 $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
 $numrow = mysqli_num_rows($result); //count how many rows are returned 
 
 if($numrow > 0) //if count greater than 0 
 { 
     $_SESSION['error'] = 'Username taken. Please retry.'; //if an username is taken intialise a session called 'error' with a msg 
     header("location:membernew.php"); //redirect to membernew.php 
     exit();
 } 
 elseif ($username == "" || $password == "" || $firstName == "" || $lastName == "" || $postcode == "" || $country =="" || $email == "" || $gender == "" || $newsletter == "") //check if all required fields have data 
 { 
     $_SESSION['error'] = 'All * fields are required.'; //if an error occurs intialise a session called 'error' with a msg 
     header("location:membernew.php"); //redirect to membernew.php 
     exit(); 
 } 
 elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) //check if email is valid 
 { 
     $_SESSION['error'] = 'Please enter a valid email address.'; //if an error occurs intialise a session called 'error' with a msg 
     header("location:membernew.php"); //redirect to membernew.php 
     exit(); 
 } 
 else 
 { 
     $sql="INSERT INTO member (username, password, salt, firstName, lastName, street, suburb, state, postcode, country, phone, mobile, email, gender, joinDate, newsletter, image, type) VALUES ('$username', '$password', '$salt', '$firstName', '$lastName', '$street', '$suburb', '$state', '$postcode', '$country', '$phone', '$mobile', '$email', '$gender', NOW(), '$newsletter', '$newImageName', '1')"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     $_SESSION['success'] = 'You added a new member.'; //if new member added successfully intialise a session called 'success' with a msg 
     header("location:members.php"); //redirect to login.php 
 } 
 
?>      