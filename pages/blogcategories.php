
<?php
    include "../inc/connect.php";

    //display HTML title tag for each category
    $sql = "SELECT * FROM category WHERE category.categoryID=" . $_GET['categoryID'];

    //retrive the category
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query

    while ($row = mysqli_fetch_array($result)){
        $page = $row['category'];
    }
    $pageTitle = $row['category'];
    include '../inc/header.php'; //session_start(); included in header.php

?>
<div class='two-thirds column'>
<?php
        $sql = "SELECT * FROM category WHERE category.categoryID=" . $_GET['categoryID']; //retrieve the category
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query
    
        $row = mysqli_fetch_array($result);
        echo "<article class='reviews'>";            
        echo "<h1 class='reviewcategoryheading'>Categories > " . $row['category'] . "</h1>";
        echo "</article>";
//display the category
        
        $sql = "SELECT review.*, category.*, admin.adminID, admin.firstName, COUNT(comment.reviewID) AS commentcount FROM review INNER JOIN admin ON review.adminID = admin.adminID INNER JOIN category ON review.categoryID = category.categoryID LEFT JOIN comment ON review.reviewID = comment.reviewID WHERE category.categoryID='" . $_GET['categoryID'] . "'GROUP BY review.reviewID, comment.reviewID ORDER BY review.date DESC"; //Retrieve records that match the category and count the number of comments
        
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //Run the query

        while ($row = mysqli_fetch_array($result))
        {
            if((is_null($row['image'])) || (empty($row['image']))) //If the photo field is null or empty
            {
                echo "<article class='reviews'>";                
                echo "<img class='scale-with-grid' src='../images/defaultimage.png' width=600 height=300 alt='game on logo' /></p>"; //Display the default photo
            } 
        else 
        {
            echo "<article class='reviews'>";            
            echo "<img class='scale-with-grid' src='../images/" . ($row['image']) . "'" . '  alt="cookie"' . "/>"; //display the review photo 
        } 
            echo "<h1><a href='blogpost.php?reviewID=" .$row['reviewID'] . "'>" . $row['title'] . "</a></h1>";
            echo "<p><em>posted on " . date("F jS Y, g:ia",strtotime($row['date'])) . " by " . $row['firstName'] . " in " . $row['category'] . "</em></p>"; //display the date, author and category 
 
/* star rating */ 
        $rating= $row['rating']; //retrieve rating from database 
 
        for($i=0;$i<$rating;$i++){ 
            echo "<img class='star' src='../images/star_filled.png' alt='filled star' />"; //echo filled stars 
        } 
        for($i=0;$i<5-$rating;$i++){ 
        echo "<img class='star' src='../images/star_unfilled.png' alt='unfilled star' />"; 
        //echo unfilled stars 
        }
        echo "<p>" . (substr(($row['content']),0,300)) . "... " . "<a href='blogpost.php?reviewID=" . $row['reviewID'] . "'>" . "read more" . "</a><br />"; //add a 'read more' link 
        echo "<p><a href='blogpost.php?reviewID=" . $row['reviewID'] . "'>" . "Comments (" . $row['commentcount'] . ")</a>"; //add the number of comment on the post
        echo "</article>";
        } 
 
?>


	</div>
<?php 
   include '../inc/sidebar.php'; 
?> 
</div> 
 <!-- end content --> 
<?php 
        include '../inc/footer.php'; 
?>