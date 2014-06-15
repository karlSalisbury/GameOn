<?php 
     //user messages 
     if(isset($_SESSION['error'])) //if session error is set 
     { 
         echo '<div class="alert alert-danger">'; 
         echo '<p>' . $_SESSION['error'] . '</p>'; //display error message
         echo '</div>'; 
         unset($_SESSION['error']); //unset session error 
     } 
     elseif(isset($_SESSION['success'])) //if session success is set 
     { 
         echo '<div class="alert alert-success">'; 
         echo '<p>' . $_SESSION['success'] . '</p>'; //display success message 
         echo '</div>'; 
         unset($_SESSION['success']); //unset session success 
     } 
?> 