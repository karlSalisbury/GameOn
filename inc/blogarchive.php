<?php 
 include "../inc/connect.php"; 
 
 //display HTML title tag for each month 
    $sql = "SELECT monthname(date), date FROM review WHERE month(date)=" . 
    $_GET['month']; //retrieve the month 
    $result = mysqli_query($connect, $sql) or die(mysqli_error($con)); //run the query 
 
 while ($row = mysqli_fetch_array($result)){ 
    $page = $row['monthname(date)'] . " " . date('Y'); 
 } 
 
 include '../inc/header.php'; //session_start(); included in header.php 

?> 
 
<section id="content"> 
 
 <?php 
    $sql = "SELECT monthname(date), date FROM review WHERE month(date)=" . $_GET['month']; //retrieve the month 
    $result = mysqli_query($connect, $sql) or die(mysqli_error($con)); //run the query 
 
    $row = mysqli_fetch_array($result); 
    echo "<h1>" . $row['monthname(date)'] . " " . date('Y') . "</h1>"; 
//display the month

    $sql = "SELECT review.*, category.*, admin.adminID, admin.firstName, COUNT(comment.reviewID) AS commentcount FROM review INNER JOIN admin ON review.adminID = admin.adminID INNER JOIN category ON review.categoryID = category.categoryID LEFT JOIN comment ON review.reviewID = comment.reviewID WHERE month(review.date) ='" . $_GET['month'] . "'GROUP BY review.reviewID, comment.reviewID ORDER BY review.date DESC"; //retrieve records that match the month and count the number of comment 
    $result = mysqli_query($con, $sql) or die(mysqli_error($con)); //run the query 
 
    while ($row = mysqli_fetch_array($result)) 
    { 
        if((is_null($row['image'])) || (empty($row['image']))) //if the photo field is NULL or empty 
    { 
    echo "<img src='../images/default.png' width=620 height=300 alt='Game On logo' /></p>"; //display the default photo 
    } 
    else 
    { 
    echo "<img src='../images/" . ($row['image']) . "'" . ' width=620 height=300 alt="GameOn"' . "/>"; //display the review photo 
    } 
    echo "<h1><a href='blogpost.php?reviewID=" .$row['reviewID'] . "'>" . $row['title'] . "</a> </h1>"; 
    echo "<p><em>posted on " . date("F jS Y, g:ia",strtotime($row['date'])) . " by " . $row['firstName'] . " in " . $row['category'] . "</em></p>"; //display the date, author and category 
 
 /* star rating */ 
    $rating= $row['rating']; //retrieve rating from database 
 
    for($i=0;$i<$rating;$i++){ 
    echo "<img src='../images/star.png' alt='filled star' />"; //echo filled stars 
    } 
    for($i=0;$i<5-$rating;$i++){ 
    echo "<img src='../images/unfilledstar.png' alt='unfilled star' />"; 
//echo unfilled stars 
    }
 
    echo "<p>" . (substr(($row['content']),0,300)) . "... " . "<a href='blogpost.php?reviewID=" . $row['reviewID'] . "'>" . "read more" . "</a><br />"; 
//add a 'read more' link 
    echo "<p><a href='blogpost.php?reviewID=" . $row['reviewID'] . "'>" . "Comments (" . $row['commentcount'] . ")</a>"; //add the number of comment on the post 
    } 
?> 
  
<?php 
    include '../inc/sidebar.php'; 
?> 
 
 
</section> <!-- end content --> 
 
<?php 
    include '../inc/footer.php'; 
?> 