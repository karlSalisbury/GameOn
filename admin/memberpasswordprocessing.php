<?php 
    session_start(); 
    include '../inc/connect.php'; 
?> 
 
<?php 
     $memberID=$_POST['memberID']; //retrieve the memberID from the hidden form field 
     $password = mysqli_real_escape_string($connect, $_POST['password']); //prevent SQL injection 
 
    if (strlen($password) < 8) //check if the password is a minimum of 8 characters long 
    { 
        $_SESSION['error'] = 'Password must be 8 characters or more.'; //if password is less than 8 characters intialise a session called 'regoerror1' to have a value of the error msg 
        header("location:account.php"); //redirect to registration.php 
        exit(); 
    } 
    else 
    { 
        $salt = md5(uniqid(rand(), true)); //create a random salt value
        $password = hash('sha256', $password.$salt); //generate the hashed password with the salt value 
     
        $sql = "UPDATE member SET password='$password', salt='$salt' WHERE memberID='$memberID'"; 
     
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query      
    }
    if($result) 
    { 
        $_SESSION['success'] = 'Member password updated successfully'; //register a session with a success message 
        header("location:memberupdate.php?memberID=" . $memberID); //redirect to memberupdate.php 
    } 
    else 
    { 
        $_SESSION['error'] = 'An error has occurred. Member password not updated.'; 
        //register a session with an error message 
        header("location:memberupdate.php?memberID=" . $memberID); //redirect to memberupdate.php 
    }
?>