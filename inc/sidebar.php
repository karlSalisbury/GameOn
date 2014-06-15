<?php
    include "../inc/connect.php";
?>
<aside class='one-third column'>
<?php
    //display the categories
    $sql = "SELECT category.*, COUNT(review.categoryID) AS catnum FROM category INNER JOIN review ON category.categoryID = review.categoryID GROUP BY review.categoryID ORDER BY category ASC"; //count the number of posts in each category
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //Run the query
	echo "<nav>";
	echo "<ul>";
	echo "<li><h2>Categories</h2></li>";
    while ($row = mysqli_fetch_array($result))
    {
        echo "<li><a href = 'blogcategories.php?categoryID=" . $row['categoryID'] . "'>" . $row['category'] . "<span class='totalposts'>" . $row['catnum'] . "</span></a></li>";
    }
	echo "</ul>";
?>

<?php
    //display the archive
    $sql = "SELECT month(date), monthname(date), year(date), COUNT(*) AS monthnum FROM review GROUP BY monthname(date) ORDER BY month (date)"; //SELECT month and year from datetime field plus groups by month
    
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run the query
    
	echo "<ul>";
	echo "<li><h2>Archives</h2></li>";
    while ($row = mysqli_fetch_array($result))
    { 
        echo "<li><a href = 'blogarchives.php?month=" . $row['month(date)'] . "'>" . $row['monthname(date)'] . " " . $row['year(date)'] . "<span class='totalposts'>" . $row['monthnum'] . "</span></a></li>"; 
    }
	echo "<li>&nbsp;</li>";
	echo "</ul>";
	echo "</nav>";
?>
</aside>