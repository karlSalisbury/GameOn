	<footer>
		<div class="copyright container">
		
		<div class='sixteen columns'>
		<h1>Site Map</h1>
		</div>
		
		<div class='four columns'>
		<ul>
		<li><h2>Main Navigation</h2></li>
		<li><a href='index.php'>Home</a></li>
		<li><a href='about.php'>About</a></li>
		<li><a href='community.php'>Community</a></li>
		<li><a href='contact.php'>Contact</a></li>		
		</ul>
		</div>

		
		
		<div class='four columns'>
			<?php
				//display the categories
				$sql = "SELECT category.*, COUNT(review.categoryID) AS catnum FROM category INNER JOIN review ON category.categoryID = review.categoryID GROUP BY review.categoryID ORDER BY category ASC"; //count the number of posts in each category
				$result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //Run the query
				echo "<ul>";
				echo "<li><h2>Categories</h2></li>";
				while ($row = mysqli_fetch_array($result))
				{
					echo "<li><a href = 'blogcategories.php?categoryID=" . $row['categoryID'] . "'>" . $row['category'] . "</a></li>";
				}
				echo "</ul>";
			?>
		</div>
		
		
		
		
		<div class='four columns'>
			<?php
				//display the archive
				$sql = "SELECT month(date), monthname(date), year(date), COUNT(*) AS monthnum FROM review GROUP BY monthname(date) ORDER BY month (date)"; //SELECT month and year from datetime field plus groups by month
				
				$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run the query
				
				echo "<ul>";
				echo "<li><h2>Archives</h2></li>";
				while ($row = mysqli_fetch_array($result))
				{ 
					echo "<li><a href = 'blogarchives.php?month=" . $row['month(date)'] . "'>" . $row['monthname(date)'] . " " . $row['year(date)'] . "</a></li>"; 
				}
				echo "</ul>";
			?>
		</div>

		<div class='four columns'>
		<h2>Social Media</h2>
		<a href='http://www.twitter.com'><img src='../images/socialmedia/socialmedia_twitter.png' /></a>
		<a href='http://www.facebook.com'><img src='../images/socialmedia/socialmedia_facebook.png' /></a>
		<a href='http://www.google.com'><img src='../images/socialmedia/socialmedia_google.png' /></a>
		<a href='http://www.pinterest.com'><img src='../images/socialmedia/socialmedia_pinterest.png' /></a>
		</div>		

		

		<div class='sixteen columns'>
				<h6>&copy; Karl Salisbury 2014</h6>
		</div>
		</div>
	</footer>

         <!-- Bootstrap core JavaScript files --> 
         <!-- Placed at the end of the document so the pages load faster --> 
         <!-- jQuery is required for Bootstrap JavaScript plugins --> 
         <script src="http://code.jquery.com/jquery.js"></script> 
         <script src="../bootstrap/js/bootstrap.min.js"></script> 

</body>
</html>