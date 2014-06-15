<?php 
     $pageDescription ="Use this page to reply to user comments";
     $pageTitle = "Reply to a Comment"; 
     include "../inc/connect.php"; 
     include 'inc/adminheader.php'; //session_start(); in this file 
?> 
 
<section id="content"> 
 
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
 
 <?php 
     $commentID=$_GET['commentID']; 
 ?> 
 
 
 <form action="commentreplyprocessing.php" method="post"> 
     <label>Comment *</label> 
     <textarea name="comment" ></textarea><br /> 
     <input type="hidden" name="commentID" value="<?php echo $commentID; ?>"> 
     <p><input type="submit" name="commentreply" value="Reply to a Comment" /></p> 
 </form> 
 
</section> <!-- end content --> 
 
<?php 
    include 'inc/adminfooter.php'; 
?>     