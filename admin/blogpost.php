<?php 
    include "../inc/connect.php"; 
 
    //display HTML title tag for each review entry 
    $sql = "SELECT * FROM review WHERE reviewID =" . $_GET['reviewID']; //select the post using the reviewID 
    $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query 
 
    while ($row = mysqli_fetch_array($result)){ 
    $page = $row['title']; 
 } 
 
    include 'inc/adminheader.php'; //session_start(); included in header.php 
?> 
 
<section id="content"> 
 
 <?php 
    $sql = "SELECT review.*, category.*, admin.adminID, admin.firstName FROM review, admin, category WHERE review.adminID = admin.adminID && review.categoryID = category.categoryID && review.reviewID = " . $_GET['reviewID']; //use $_GET to retrieve the reviewID for the full entry

    $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query 
 
    while ($row = mysqli_fetch_array($result)) 
     { 
        if((is_null($row['image'])) || (empty($row['image']))) //if the photo field is NULL or empty 
     { 
        echo "<img src='../images/default.png' width=620 height=300 alt='cookie love logo' /></p>"; //display the default photo 
     } 
        else 
     { 
     echo "<img src='../images/" . ($row['image']) . "'" . ' width=620 
    height=300 alt="cookie"' . "/>"; //display the blog photo 
     } 
         echo "<h1>" . $row['title'] . "</h1>"; 
         echo "<p><em>posted on " . date("F jS Y, g:ia",strtotime($row['date'])) . " by " . $row['firstName'] . " in " . $row['category'] . "</em></p>"; //display the date, author and category 
     
     /* star rating */ 
     $rating= $row['rating']; //retrieve rating from database 
     
     for($i=0;$i<$rating;$i++){ 
     echo "<img src='../images/star.png' alt='filled star' />"; //echo filled stars 
     } 
    for($i=0;$i<5-$rating;$i++){ 
    echo "<img src='../images/unfilledstar.png' alt='unfilled star' />"; //echo unfilled stars
 } 
 
    echo $row['content']; 
    } 
 ?> 
 
 <h2>Comments</h2> 
 
<?php 
    //user messages 
     if(isset($_SESSION['error'])) //if session error is set 
     { 
         echo '<div class="error">'; 
         echo '<p>' . $_SESSION['error'] . '</p>'; //display error message 
         echo "</div>"; 
         unset($_SESSION['error']); //unset session error 
     } 
         elseif(isset($_SESSION['success'])) //if session success is set 
     { 
         echo '<div class="success">'; 
         echo '<p>' . $_SESSION['success'] . '</p>'; //display success message 
         echo "</div>"; 
         unset($_SESSION['success']); //unset session success 
     } 
?> 
 
 
<?php         
       $sql = "(SELECT comment.*, member.memberID, member.username FROM comment INNER JOIN member USING(memberID) WHERE comment.memberID = member.memberID && comment.reviewID ='" . $_GET['reviewID'] . "') UNION (SELECT comment.*, admin.adminID, admin.username FROM comment INNER JOIN admin USING(adminID) WHERE comment.adminID = admin.adminID && comment.reviewID ='" . $_GET['reviewID'] . "') ORDER BY date ASC"; 
        //retrieve the comment for the reviewID 
        $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query 
 
        $numrows = mysqli_num_rows($result); 
 
         if($numrows == 0) 
             { 
             echo "<p>No comments on this post</p>"; 
             } 
         else 
         { 
         while ($row = mysqli_fetch_array($result)) 
             { 
             echo "<p><em>posted on " . date("F jS Y, g:ia", strtotime($row['date'])) . " by <strong>" . $row['username'] . "</strong></em></p>"; 
                //display the date, author and category 
             echo $row['comment']; 
             } 
         } 
?> 
 
 <h2>Join the Discussion</h2> 
 
 <!-- check if user is logged in and, if so, display comment form --> 
<?php

    if(isset($_SESSION['member'])) 
 { 
?> 
 
<form action="blogprocessing.php" method="post"> 
     <textarea name="comment" ></textarea> 
     <!-- use a hidden field to send the reviewID to the next page --> 
     <input type="hidden" value="<?php echo $_GET['reviewID']; ?>" name="reviewID" /> 
     <p><input type="submit" name="postComment" value="Post Comment" /></p> 
</form> 
<?php 
    } 
    else 
    { 
    echo "<p>You must <a href='login.php?reviewID=" . $_GET['reviewID'] . "'>login</a> to comment."; //use the GET array to send the reviewID to the next page if the user clicks the login option in the review 
    } 
?> 
 
</section> <!-- end #content --> 
 
<?php 
 include '../inc/footer.php'; 
?>