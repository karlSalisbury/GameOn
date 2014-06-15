<?php 
    $pageDescription = "Use this page to update comments";
    $pageTitle = "Update Comment"; 
    include "../inc/connect.php"; 
    include 'inc/adminheader.php'; //session_start(); in this file 
?> 
 
<?php 
    $commentID = $_GET['commentID']; //retrieve reviewID from URL 
     
    $sql = "SELECT comment.*, member.firstName AS memberFirstName, member.lastName AS memberLastName, admin.firstName AS adminFirstName, review.title FROM comment LEFT JOIN member ON comment.memberID = member.memberID LEFT JOIN admin ON comment.adminID = admin.adminID INNER JOIN review USING(reviewID) WHERE commentID = '$commentID'"; 

    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
    $row = mysqli_fetch_array($result); 
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
     
     
     <form action="commentupdateprocessing.php" method="post"> 
     <label>Comment*</label> 
     <textarea name="comment" required > <?php echo $row['commentContent']; ?></textarea><br />
<?php 
     $type=$_GET['type']; //retrieve the type of user 
     
     if($type == 1) //if the user is a member display the author drop-down list and the review drop-down list 
     { 
?> 
 
<label>Author*</label> 
 
<!-- create a drop-down list populated by the member details stored in the database --> 
<select class='form-control' name='memberID'> 
 <option value="<?php echo $row['memberID'] ?>"><?php echo $row['memberFirstName'] . " " . $row['memberLastName'] ?></option> 
 
<?php 
     $sqlmember="SELECT * FROM member"; 
     $resultmember = mysqli_query($connect, $sqlmember) or die(mysqli_error($connect)); //run the query 
 
 while ($rowmember = mysqli_fetch_array($resultmember)) 
 { 
    echo "<option value=" . $rowmember['memberID'] . ">" . $rowmember['firstName'] . " " . $rowmember['lastName'] . "</option>"; 
 } 
?> 
 
 </select><br /> 
 
 <label>Review*</label>
<!-- create a drop-down list populated by the review details stored in the database --> 
     <select class='form-control' name='reviewID'> 
     <option value="<?php echo $row['reviewID'] ?>"><?php echo $row['title'] 
?></option> 
 
<?php 
     $sqlreview="SELECT * FROM review"; 
     $resultreview = mysqli_query($connect, $sqlreview) or die(mysqli_error($connect)); //run the query 
     
     while ($rowreview = mysqli_fetch_array($resultreview)) 
     { 
     echo "<option value=" . $rowreview['reviewID'] . ">" . $rowreview['title'] . "</option>"; 
     } 
?> 
 
</select><br /> 
 
     <input type="hidden" name="commentID" value="<?php echo $commentID; ?>"> 
     <input type="hidden" name="type" value="1"> 
     <p><input type="submit" name="commentupdate" value="Update Comment" /></p> 
 
<?php 
     } 
        Else //else if the user is an admin do not display the drop-down lists 
     { 
?>
    <input type="hidden" name="commentID" value="<?php echo $commentID; ?>"> 
    <input type="hidden" name="type" value="0"> 
    <p><input type="submit" name="commentupdate" value="Update Comment" /></p> 
 
<?php 
     } 
?> 
 
</form> 
 
</section> <!-- end content --> 
 
<?php 
    include 'inc/adminfooter.php'; 
?> 
         
         
         