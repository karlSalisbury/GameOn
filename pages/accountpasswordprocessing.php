<?php
    session_start();
    include '../inc/connect.php';
?>

<?php
    $memberID=$_POST['memberID'];//Assign the ['memberID'] stored in the $_POST superglobal to $memberID
    $password = mysqli_real_escape_string($connect, $_POST['password']);//Use the mysqli_real_escape_string function to prevent SQL injection

    if(strlen($password < 8)//Check if the password is a minimum of 8 characters long by using the strlen() function to check the length of the string stored in $password then use the greater than comparison operator to check whether the number is < 8
       {
           $_SESSION['error'] = 'Password must be 8 characters or more.';//Set ['error'] in the $_SESSION superglobal to 'Password must be 8 characters or more'.
           //header("location:account.php");//Redirect to account.php to where error message will be displayed
            exit();
       }
       else
       {
           //NOTE: md5() — Calculate the md5 hash of a string, Calculates the MD5 hash of str using the » RSA Data Security, Inc. MD5 Message-Digest Algorithm, and returns that hash.

//WHAT IS A HASH?: A hash function is any algorithm that maps data of arbitrary length to data of a fixed length. The values returned by a hash function are called hash values, hash codes, hash sums, checksums or simply hashes.

//uniqid — Generate a unique ID, not random though? Extra level of entropy?
//rand(), exta entropy?

            $salt = md5(uniqid(rand(), true));//create a random salt value
           
            $password = hash('sha256', $password.$salt);//Generate hashed password with the salt value. Use the hash function using sha256 and concatenate $password to $salt
           
           $sql = "UPDATE member SET password='$password', salt='$salt' WHERE memberID='$memberID'";
           
           $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //Run the query
           
       }
       
       if($result)
       {
            $_SESSION['success'] = 'Password updated successfully';//register a session with a success message
           //header("location:account.php");//redirect to account.php
       }
       else
       {
            $_SESSION['error'] = 'An error has occurred. Password not updated.';//register a session with an error message
           //header("location:account.php");//redirect to account.php
       }
?>