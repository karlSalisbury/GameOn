<?php 
    include "../inc/connect.php"; 
?> 
 
<?php 
    if(!isset($_SESSION['member'])) 
    { 
    header('location:index.php'); //if the 'member' session is not set redirect to index.php 
    } 
?> 