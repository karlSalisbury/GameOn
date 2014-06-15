<?php
	session_start();
	include "../inc/connect.php";
?>

<?php
	$memberID = $_POST['memberID'];
	
	if($_FILES['image']['name']) //if an image has been uploaded
    {
        $image = $_FILES['image']['name']; //if an image has been uploaded
		$randomDigit = rand(0000, 9999); //generate a random numerical digit <= 4 characters
		$newImageName = strtolower($randomDigit . "_" . $image);//attach the random digit to the front of uploaded images to prevent overiding files with the same name in the images folder and enhance security
		$target = "../images/avatars/" . $newImageName; //the target for uploaded images
		
		$allowedExts = array('jpg', 'jpeg', 'gif', 'png'); //create an array with the allowed file extensions
		
        
        
        
        
		$tmp = explode('.', $_FILES['image']['name']); //Split the file name from the file extension
		
		$extension = end($tmp); //retrieve the extension of the photo e.g., png
		
        
        
        
        
		if($_FILES['image']['size'] > 512000) //if image size is greater than 512 kb
		{
        //Put error message into session superglobal    
			$_SESSION['error'] = 'Your file size exceeds maximum of 500kb';
            //header("location:registration.php");//Redirect to registration page where error will be displayed
		}
        elseif (($_FILES['image']['type'] == 'image/jpg') || ($_FILES['image']['type'] == 'image/jpeg') || ($_FILES['image']['type']== 'image/gif') || ($_FILES['image']['type'] == 'image/png') && in_array($extension, $allowedExts))
//NOTE: The in_array() function searches an array for a specific value.
        {
//NOTE: move_uploaded_file() — Moves an uploaded file to a new location
            move_uploaded_file($_FILES['image']['tmp_name'], $target);//move the image to images folder. the parameters $target is the location the file is being moved to and $_FILES is the image and the temporary filename?
        }
        else
        {
            $_SESSION['error'] = 'Only JPG and PNG files allowed.'; //if file uses an invalid extension intialise a session called 'error' with a msg
            //header("location: registration.php");//redirect to registration.php
            exit();
        }		
    }
    $sql="UPDATE member SET image='$newImageName' WHERE memberID='$memberID'"; //SQL query as a variable to be put into the mysqli_query function

    $result= mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run the query
    
    $_SESSION['success'] = 'Image updated successfully'; //If registration is successful initialise a  session called success with a message.
                 
    header("location:account.php");//redirect to account.php

?>