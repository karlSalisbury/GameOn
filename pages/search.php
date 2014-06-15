<?php 
    $pageTitle = "Search Results"; 
    include "../inc/connect.php"; 
    include '../inc/header.php'; 
?> 
  
	<div class='two-thirds column'>
	 <h1>Search Results</h1> 
	
		
 <?php 
    $term = mysqli_real_escape_string($connect, $_GET['search']); //prevent SQL injection 
 
    $sql = "SELECT review.*, admin.adminID, admin.firstName, category.* FROM review INNER JOIN admin USING(adminID) INNER JOIN category USING(categoryID) WHERE title LIKE '%$term%' OR content LIKE '%$term%' OR category LIKE '%$term%' OR firstName LIKE '%$term%' ORDER BY date DESC"; // use LIKE to find values that match the term entered and order by date from the most recent review 
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
 
    $numrow = mysqli_num_rows($result); //count the number of rows returned 
 
    if(empty($_GET['search'])) //display if no search term entered 
    { 
    echo "<p class='error'><em>You did not enter a search term</em></p>"; 
    }

    else if($numrow == 0) //display if no matches to search 
    { 
    echo "<p class='error'><em>Sorry, no results match your search for <strong>" . $term . "</strong></em></p>"; 
    } 
    else 
    { 
    echo "<p class='success'><em>Your search for <strong>" . $term . "</strong> has retrieved " . $numrow . " results</em></p>"; //display the search results 
    while ($row = mysqli_fetch_array($result)) //loop through results for each match 
        { 
        echo "<h2><a href='blogpost.php?reviewID=" .$row['reviewID'] . "'>" . $row['title'] . "</a></h2>"; 
        echo "<p><em>posted on " . date("F jS Y, g:ia",strtotime($row['date'])) . " by " . $row['firstName'] . " in " . $row['category'] . "</em></p>"; //display the date, author and category 
        echo "<p>" . (substr(($row['content']),0,100)) . "..." . "</p><br />"; 
        //limit displayed characters to 100 
        } 
    } 
 ?> 
 </div>

<?php 
    //include '../inc/sidebar.php'; 
?> 
 
 
</div> <!-- end content --> 
 
<?php 
    include '../inc/footer.php'; 
?> 