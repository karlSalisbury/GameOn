<?php 
    session_start(); 
    include "../inc/connect.php"; 
?> 
 
<?php 
     $memberID = $_POST['memberID']; //retrieve the memberID from the hidden form field 
     
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
     header("location:registration.php"); //redirect to registration.php 
     exit(); 
     } 
     elseif(($_FILES['image']['type'] == 'image/jpg') || ($_FILES['image']['type'] == 'image/jpeg') || ($_FILES['image']['type'] == 'image/gif') || ($_FILES['image']['type'] == 'image/png') && in_array($extension, $allowedExts)) 
     { 
        move_uploaded_file($_FILES['image']['tmp_name'], $target); //move the image to images folder 
     } 
     else 
     { 
         $_SESSION['error'] = 'Only JPG and PNG files allowed.'; //if file uses an invalid extension intialise a session called 'error' with a msg 
         header("location:registration.php"); //redirect to registration.php 
         exit(); 
     } 
} 
     
     $sql="UPDATE member SET image='$newImageName' WHERE memberID='$memberID'"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     $_SESSION['success'] = 'Member image updated successfully'; //if registration is successful intialise a session called 'success' with a msg 
     header("location:memberupdate.php?memberID=" . $memberID); //redirect to memberupdate.php 
?>      