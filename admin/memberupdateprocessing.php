<?php 
     session_start(); 
     include "../inc/connect.php"; 
?>

<?php 
     $memberID = $_POST['memberID']; //retrieve the memberID from the URL 
     
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
 
    if ($firstName == "" || $lastName == "" || $postcode == "" || $country == "" || $email == "" || $gender == "" || $newsletter == "") //check if all required fields have data
    { 
        $_SESSION['error'] = 'All * fields are required.'; //if an error occurs intialise a session called 'error' with a msg 
        header("location:memberupdate.php?memberID=" . $memberID); //redirect to memberupdate.php 
        exit(); 
    } 
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) //check if email is valid 
    { 
        $_SESSION['error'] = 'Please enter a valid email address.'; //if an error occurs intialise a session called 'error' with a msg 
        header("location:memberupdate.php?memberID=" . $memberID); //redirect to memberupdate.php 
        exit(); 
    } 
    else 
    { 
        $sql="UPDATE member SET firstName='$firstName', lastName='$lastName', street='$street', suburb='$suburb', state='$state', postcode='$postcode', country='$country', phone='$phone', mobile='$mobile', email='$email', gender='$gender', newsletter='$newsletter' WHERE memberID='$memberID'"; 
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
        $_SESSION['success'] = 'Member updated successfully.'; //if the member is updated successfully intialise a session called 'success' with a msg 
        header("location:memberupdate.php?memberID=" . $memberID); //redirect to memberupdate.php 
     } 
?> 