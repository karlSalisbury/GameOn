<?php
	$pageTitle ="Update review";//Page title, will display in the page title and as a heading
	$pageDescription = "Use this page to update existing reviews"; //Will display in the header as the  page description
	include "inc/adminheader.php";
?>

<?php
	$reviewID = $_GET['reviewID'];//retrieve reviewID from URL
	
	$sql = "SELECT review.*, category.*, admin.firstName, admin.lastName FROM review JOIN admin USING (adminID) JOIN category USING (categoryID) WHERE reviewID = '$reviewID'";//SQL query

	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //Run the query using the mysqli_query function, put it into a variable called result

	$row = mysqli_fetch_array($result);// Put the results into an associative array
	
?>

<section id="content">

	
<?php
	//user messages
	if(isset($_SESSION['error']))//If session error is set
	{
		//Display the error message
		echo '<div class="alert alert-danger">';
		echo '<p>' . $_SESSION['error'] . '</p>';
		echo '</div>';
		unset($_SESSION['error']);//Destroy the error message
	}
	elseif(isset($_SESSION['success']))//If session success is set
	{
		//Display the success message
		echo '<div class="alert alert-success">';
		echo '<p>' . $_SESSION['success'] . '</p>';
		echo '</div>';
		unset($_SESSION['success']);//Destroy the success message
	}
?>	
	
	<form action="reviewupdateprocessing.php" method="post">
		<label>Title <span class="required">*</span></label>
		<input type="text" class='form-control' name="title" required value="<?php echo $row['title'] ?>" /><br />
		
		<!--- Content echoed into textarea so it can be edited then sent back to the server via the form -->
		<label>Content <span class="required">*</span></label>
		<textarea rows="10" cols="60%" name="content" required >
		<?php echo $row['content'] ?>
		</textarea><br />
		
		<label>Author <span class="required">*</span></label>
	
		<!--- create a drop-down list populated by the admin details stored int he database -->
		
		<select class='form-control' name='adminID'>
		<option value="<?php echo $row['adminID'] ?>"><?php echo $row['firstName'] . " " . $row['lastName'] ?>
		</option>
		
<?php
		$sql="SELECT * FROM admin";//SQL query
		$result=mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run that query
		
		while ($row = mysqli_fetch_array($result))
		{
			echo "<option value=" . $row['adminID'] . ">" . $row['firstName'] . " " . $row['lastName'] . "</option>";
		}
?>
		</select><br />		
		
<?php
		$sql = "SELECT category.* FROM review JOIN category USING (categoryID) WHERE reviewID = '$reviewID'";//retrieve the selected value
		$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run the query

		$row = mysqli_fetch_array($result);
?>
	<label>Category <span class="required">*</span></label>
		
	<!-- create a drop-down list populated by the categories stored in the database -->
	
	<select class='form-control' name='categoryID'>
	<option value="<?php echo $row['categoryID'] ?>"><?php echo $row['category'] ?>
	</option>
	
<?php

	$sql = "SELECT * FROM category";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//run the query

	while($row = mysqli_fetch_array($result))
	{
		echo "<option value=" . $row['categoryID'] . ">" . $row['category'] . "</option>";
	}

?>
		
	</select><br />
		
	<label>Rating <span class="required">*</span></label>
	<!-- create a drop-down list populated by the rating stored in the database -->
	
	<select class='form-control' name='rating'>
	<option value="<?php echo $row['rating'] ?>"><?php echo $row['rating'] ?></option>		
	<!-- use a for loop to create the rating options up to a maximum of 5 -->
		
	<?php for ($i = 1; $i <= 5; $i++) : ?>
		<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
	<?php endfor; ?>
	
	</select><br />		
		
	<input type="hidden" name="reviewID" value="<?php echo $reviewID; ?>">
	<p><input type="submit" name="reviewupdate" value="Update Review" /></p>
	</form>
	
	<h2>Update Image</h2>

	<?php

	if((is_null($row['image'])) || (empty($row['image']))) //if the photo field is NULL or empty
	{
		echo "<p><img src='../images/defaultimage.png' alt='Default photo' /></p>";//display the default photo	
	}
	else
	{
		echo "<p><img src='../images/" . ($row['image']) . "' alt='review photo' />";
		//display the review photo
	}
?>
	<form action="reviewupdateimageprocessing.php" method="post" enctype="multipart/form-data"> 
		<input type="hidden" name="reviewID" value="<?php echo $reviewID; ?>"> 
		<label>New Image</label>
		<input type="file" name="image" /><br /> 
		<p>Accepted files are JPG, GIF or PNG. Maximum size is 500kb.</p> 
		<p><input type="submit" name="imageupdate" value="Update Image" /></p> 
	</form>
	
	
</section>

<?php
	include "inc/adminfooter.php";
?>