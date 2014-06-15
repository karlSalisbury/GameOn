<?php
    $pageTitle = "Home";
    $pageDescription = "This is the admin dashboard. You can use this to create and manage reviews, categories, comments, member accounts, your own account and themes.";
    include "inc/adminheader.php";
?>

<section id="content">


        <?php
            $sql = "SELECT (SELECT COUNT(*) FROM review) AS 'totalReviews', (SELECT 
COUNT(*) FROM category) AS 'totalCategories', (SELECT COUNT(*) FROM comment) AS 
'totalComments', (SELECT COUNT(*) FROM member) AS 'totalMembers'";

            $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run the query
            while ($row = mysqli_fetch_array($result))
            {
				/*
                echo "<table class='table table-responsive table-striped'>";
                echo "<th>At a glance</th>";
                 echo "</th>"; 
                 echo "<tr>"; 
                 echo "<td>" . $row['totalReviews'] . "</td><td> Reviews</td>"; 
                 echo "</tr>"; 
                 echo "<tr>"; 
                 echo "<td>" . $row['totalCategories'] . "</td><td> Categories</td>"; 
                 echo "</tr>"; 
                 echo "<tr>"; 
                 echo "<td>" . $row['totalComments'] . "</td><td> Comments</td>"; 
                 echo "</tr>"; 
                 echo "<tr >"; 
                 echo "<td>" . $row['totalMembers'] . "</td><td> Members</td>"; 
                 echo "</tr>"; 
                 echo "</table>";
				*/
				echo "<h3>At a Glance</h3>";
				echo "<ul class='list-group'>";
				echo "<li class='list-group-item'><span class='badge'>" . $row['totalReviews'] . "</span> <span class='glyphicon glyphicon-pencil'> Reviews</span</li>";
				echo "<li class='list-group-item'><span class='badge'>" . $row['totalCategories'] . "</span> <span class='glyphicon glyphicon-tag'> Categories</span></li>";
				echo "<li class='list-group-item'><span class='badge'>" . $row['totalComments'] . "</span> <span class='glyphicon glyphicon-comment'> Comments</span></li>";
				echo "<li class='list-group-item'><span class='badge'>" . $row['totalMembers'] . "</span> <span class='glyphicon glyphicon-user' > Members</span></li>";
				echo "</ul>";

				
				
            }








?>
</section><!--end content-->
        



<?php
    include "inc/adminfooter.php";
?>