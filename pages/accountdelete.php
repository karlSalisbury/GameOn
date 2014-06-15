<?php
    session_start();
    include "../inc/connect.php";
?>

<?php
    
    $memberID = $_POST['memberID'];
    
    $sql = "DELETE member.* FROM member WHERE memberID = '$memberID'";//Delete ALL the member records from both the login table and the member table using the memberID
    
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run the query

    //User messages

    $_SESSION['success'] = 'Account deleted successfully.'; //register a session with a success message

    unset($_SESSION['member']); //destroy the member session that was registered during the login process when the account is deleted

    unset($_SESSION['user']);//destroy the user session that was registered during the login process when the account is deleted

    header('location:index.php');
?>