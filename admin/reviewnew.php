<?php
    $pageTitle = "Review";
    $pageDescription ="Use this page to add a new review";
    include "../admin/inc/adminheader.php";
?>

<section id="content">

    <h1>Add new review</h1>
    
    <?php
        //user message

        if(isset($_SESSION['error']))//if session error is set
        {
            echo '<div class="error">';
            echo '<p>' . $_SESSION['error'] . '</p>';//display error message
            echo '</div>';
            unset($_SESSION['error']);//Destroy session error
        }
        elseif(isset($_SESSION['success']))//if session success is set
        {
            echo '<div class="success">';
            echo '<p>' . $_SESSION['success'] . '</p>';//display success message
            echo '</div>';
            unset($_SESSION['success']);//Destroy session success
        }
    ?>
    
    <form action="reviewnewprocessing.php" method="post" enctype="multipart/form-data">
        <label>Title <span class="required">*</span></label>
        <input class="form-control" type="text" name="title" required /><br />
        
        <label>Content <span class="required">*</span></label>
        <textarea rows="10" cols="60%" name="content" ></textarea><br />
        
        <label>Author <span class="required">*</span></label>
        <!--- create a drop-down list populated by the admin details stored in the database -->
        
        <select class="form-control" name='adminID'>
        <option value="">Please select</option>
        
<?php

    $sql="SELECT * FROM admin";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run the query
    
    while ($row = mysqli_fetch_array($result))
    {
        echo "<option value=" . $row['adminID'] . ">" . $row['firstName'] . " " . $row['lastName'] . "</option>";
				}
?>
        </select><br />
		
		<label>Category <span class="required">*</span></label>
		
		<!-- create a drop-down list populated by the categories stored in the database -->
		
		<select class="form-control" name='categoryID'>
			<option value="">Please select</option>
<?php
	$sql="SELECT * FROM category";
	$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));// Run the query
	
	while ($row = mysqli_fetch_array($result))
	{
		echo "<option value=" . $row['categoryID'] . ">" . $row['category'] . "</option>";
	}
?>
			
</select><br /> 
 
		<label>Rating*</label> 
 
 <!-- create a drop-down list populated by the rating stored in the database -->
		
	<select class="form-control" name='rating'> 
	<option value="">Please select</option> 
 
 <!-- use a for loop to create the rating options up to a maximum of 5 --> 
	 <?php for ($i = 1; $i <= 5; $i++) : ?> 
		<option value="<?php echo $i; ?>"><?php echo $i; ?></option> 
	 <?php endfor; ?> 
 
 </select><br /> 
 
 <label>Image</label> <input type="file" name="image" /><br /> 
 <p class='alert alert-warning'>Accepted files are JPG, GIF or PNG. Maximum size is 500kb.</p> 
 
 <input type="hidden" name="reviewID" value="<?php echo $reviewID; ?>"> 
 <p><input type="submit" class='button' name="reviewnew" value="Add New Review" /></p> 
 
 </form> 
 
</section> <!-- end content --> 
<?php 
	include '../inc/footer.php'; 
?>