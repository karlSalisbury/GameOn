<?php
	$pageTitle = "Home";
	include '../inc/connect.php';
	include '../inc/header.php';
?>

<div class='two-thirds column'>
	<?php
		$sql = "SELECT admin.adminID, admin.firstName, review.*, category.*, COUNT(comment.reviewID) AS commentcount FROM review INNER JOIN admin ON review.adminID = admin.adminID INNER JOIN category ON review.categoryID = category.categoryID LEFT JOIN comment ON review.reviewID = comment.reviewID GROUP BY review.reviewID, comment.reviewID ORDER BY date DESC LIMIT 0,3"; //display the last 3 review entries and count the number of comments for each review entry
		$result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query
		
        echo "<article class='reviews'>";            
        echo "<h1 class='reviewcategoryheading'>New reviews</h1>";
        echo "</article>";

		while ($row = mysqli_fetch_array($result))
		{
			if((is_null($row['image'])) || (empty($row['image']))) //if the image field is NULL or empty
		{
			echo "<article class='reviews'>";
			echo "<img class='scale-with-grid' src='../images/defaultimage.png' alt='image not found' /></p>";//display the default image
		}
		else
		{
			echo "<article class='reviews'>";		
			echo "<img class='scale-with-grid' src='../images/" . ($row['image']) . "'" . ' alt="review image"' . "/>";//else display the review image
		}
		echo "<h1 class='reviewheading'><a href='blogpost.php?reviewID=" . $row['reviewID'] . "'>" . $row['title'] . "</a></h1>";
		echo "<p><em>posted on " . date("F jS Y, g:ia", strtotime($row['date'])) . " by " . $row['firstName'] . " in " . $row['category'] . "</em></p>"; //Display the date, author and category

		/* Star Rating */
		$rating= $row['rating']; //retrieve the rating from database

		for($i=0;$i<$rating;$i++){
		echo "<img class='star' src='../images/star_filled.png' alt='filled star' />"; //echo filled stars
		}
		for($i=0;$i<5-$rating;$i++){ 
		echo "<img class='star' src='../images/star_unfilled.png' alt='unfilled star' />"; //echo unfilled stars	
		}
            
        echo "<p>" . (substr(($row['content']),0,300)) . "... " . "<a href='blogpost.php?reviewID=" . $row['reviewID'] . "'>" . "read more" . "</a><br />"; //limit the display to 300 characters and add a 'read more' link
        echo "<p><a class='lightbutton' href='blogpost.php?reviewID=" . $row['reviewID'] . "'>" . "Comments (" . $row['commentcount'] . ")</a>"; //add the number of comments on the post
		echo '</article>';
        }

?>
</div><!-- end content -->
	
		
		
<?php
        include '../inc/sidebar.php';
?>

		
		
		
		
</div>
<?php
        include '../inc/footer.php';
?>