<?php
    $pageTitle = "Account";//Page title
    include "../inc/connect.php";
    include "../inc/header.php"; //session_start(); included in header.php
    include "../inc/logincheckmember.php";
?>

<?php
    $memberID = $_SESSION['user'];

    $sql = "SELECT * FROM member WHERE memberID = '$memberID'";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query

    $row = mysqli_fetch_array($result);
?>

<aside class='one-third column accountsummary'>
    <h1>Account Summary</h1>
    <?php
        echo "<img src='../images/avatars/" . $row['image'] . "' class='accountsummaryimage scale-with-grid' />";
        echo "<h2>Username</h2>";
        echo "<p>" . $row['username'] . "</p>";
        echo "<h2>Full name</h2>";
        echo "<p>" . $row['firstName'] . "&nbsp" . $row['lastName'] . "</h3>";
        echo "<h2>Address</h2>";
        echo "<p>" . $row['street'] . "<br />" . $row['suburb'] . "&nbsp" . $row['state'] . "&nbsp" . $row['postcode'] . "<br />" . $row['country'] . "</p>";
        echo "<h2>Contact</h2>";
        echo "<p>Mobile: " . $row['phone'] . "<br/>Landline: " . $row['mobile'] . "<br />Email: " . $row['email'] . "</p>";
        echo "<h2>Gender</h2>";
        echo "<p>" . $row['gender'] . "</p>";
        echo "<h2>Subscribed to newsletter</h2>";
        if ($row['newsletter'] == "Y")
        {
            echo "<p>Yes</p>";
        }
        else{
            echo "<p>No</p>";        
        }
    ?>
</aside>

<section id="content" class='two-thirds column accountform'>
    <article>
    <?php
        //user messages
        if(isset($_SESSION['error'])) //If session error is set
        {
            echo '<div class="error">';
            echo '<p>' . $_SESSION['error'] . '</p>'; //Display error messages
            echo '</div>';
            unset($_SESSION['error']); //unset session error            
        }
        elseif(isset($_SESSION['success']))//if Session success exists
        {
                echo '<div class="success">';
                echo '<p>' . $_SESSION['success'] . '</p>';//Display success message
                echo '</div>';
                unset($_SESSION['success']); //imset session success
        }
?>
    
    <h1>Update your Account</h1>
    <p>Update your account details.</p>
    <!---

        Notes on POST: (POST IS HIDDEN)
        
        Appends form-data inside the body of the HTTP request (data is not shown is in URL)
        Has no size limitations
        Form submissions with POST cannot be bookmarked
        
        Notes on GET: (GET IS IN THE URL)
        
        Appends form-data into the URL in name/value pairs
        The length of a URL is limited (about 3000 characters)
        Never use GET to send sensitive data! (will be visible in the URL)
        Useful for form submissions where a user want to bookmark the result
        GET is better for non-secure data, like query strings in Google
--->
		<!--- OPEN THE FORM TAG -->
        <form action="accountprocessing.php" method="post">
            
            <input type="hidden" name="username" required value="<?php echo $row['username'] ?>" readonly /><br />

            <label>First Name<span class="required"> *</span></label>
            <input type="text" name="firstName" required value="<?php echo $row['firstName'] ?>" /><br />

            <label>Last Name<span class="required"> *</span></label>
            <input type="text" name="lastName" required value="<?php echo $row['lastName'] ?>" /><br />
    
            <label>Street</label>
            <input type="text" name="street" value="<?php echo $row['street'] ?>"/><br /> 

            <label>Suburb</label>
            <input type="text" name="suburb" value="<?php echo $row['suburb'] ?>" /><br /> 

			<label>State</label>
			
			<?php
			//generate drop-down list for state using enum data type and values from database
			
			$tableName='member';
			
			$colState='state';
			
			function getEnumState($tableName, $colState)
			{
				global $connect; //enable database connection in the function
				
				$sql = "SHOW COLUMNS FROM $tableName WHERE field='$colState'";
				//retrieve enum column
				
				$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
				//run the query
				
				$row  = mysqli_fetch_array($result);//Store the results from the query in the $row variable
				
				$type = preg_replace('/(^enum\()/i', '', $row['Type']); //Regular expression to replace the enum syntax with blank space
				
				$enumValues = substr($type, 0, -1);//Return the enum string, trims the last character off the string
				
				$enumExplode = explode(',', $enumValues);//Return all the enum into individual values. Enum creates an array from the data based on what you explode?
			
			}
			
			$enumValues = getEnumState('member', 'state');
			echo '<select name="state">';
			
			if((is_null($row['state'])) || (empty($row['state'])))
			{
			//if the state field is NULL or empty
				echo "<option value=''>Please select</option>"; //Display the 'Please select' message
			}
			else
			{
			//if the state field is NOT NULL or empty
				echo "<option value=" . $row['state'] . ">" . $row['state'] . "</option>"; //Display the selected Enum value
			}
			
			foreach($enumValues as $value)
			{
				echo '<option value="' . $removeQuotes = str_replace("'", "", $value) . '">' . $removeQuotes = str_replace("'", "", $value) . '</option>'; //remove the quotes from the enum values
			}
			
			echo '</select><br />';
			?>
			
			<p>&nbsp;</p>
			
			<label>Postcode <span class="required">*</span></label>
			<input type="text" name="postcode" required value="<?php echo $row['postcode'] ?>"/><br />
			
			<label>Country <span class="required">*</span></label>
			<input type="text" name="country" required value="<?php echo $row['country'] ?>"/><br />
			
			<label>Phone</label>
			<input type="text" name="phone" value="<?php echo $row['phone'] ?>" /><br />

			<label>Mobile</label>
			<input type="text" name="mobile" value="<?php echo $row['mobile'] ?>" /><br />
			
			<label>Email <span class="required">*</span></label>
			<input type="text" name="email" required value="<?php echo $row['email'] ?>" /><br />
			
			<label>Gender <span class="required">*</span></label>
			
			<?php
				//generate drop-down list for gender using enum data type and values from database
				
				$tableName='member';
				
				$colGender='gender';
				
				function getEnumGender($tableName, $colGender)
				{
					global $connect;//Enable database connection in the function.
					
					$sql = "SHOW COLUMNS FROM $tableName WHERE field='$colGender'";
					//retrieve enum column
					
					$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));
					//run the query
					
					$row = mysqli_fetch_array($result);//store the results in a variable named $row
					
					$type = preg_replace('/(^enum\()/i', '', $row['Type']); //regular ex to replace the enum syntax with blank spaces
					
					$enumValues = substr($type, 0, -1); //Return the enum string
					
					$enumExplode = explode(',', $enumValues); //SPlit the enum string into an array with individual values?
					
					return $enumExplode;//return all the enum individual values
				
				
				}
				
				$enumValues = getEnumGender('member', 'gender');
				
				echo '<select name="gender">';//Open the select tag
				
				echo "<option value=" . $row['gender'] . ">" . $row['gender'] . "</option>"; //Display the selected enum value
				
				foreach($enumValues as $value)
				{
				//Echo the enum values in the $enumValues array until nothing is left in the array using a foreach statement
					echo '<option value="' . $removeQuotes = str_replace("'", "", $value) . '">' . $removeQuotes = str_replace("'", "", $value) . '</option>';
				}
				echo '</select>';//Close the select tag
				
				
				?>
				
				<br />
				
				<p>Subscribe to weekly email newsletter?</p>
				
				<label>Yes</label>
				<input type="radio" name="newsletter" value="Y" <?php if($row['newsletter'] == "Y"){echo "checked";} ?>><br />
				
				<label>No</label>
				<input type="radio" name="newsletter" value="N" <?php if($row['newsletter'] == "N"){echo "checked";} ?>><br />
				
				<input type="hidden" name="memberID" value="<?php echo $memberID; ?>">
			
				<!--- SUBMIT BUTTON FOR UPDATING ACCOUNT DETAILS -->
				<p><input type="submit" name="accountupdate" value="Update Account" /></p>
		</form>
		<!--- CLOSE THE FORM TAG -->
		</article>
    
        <article>
		<h1>Update Image</h1>
		
		<?php
		
            if ((is_null($row['image'])) || (empty($row['image']))) //If the photo field is null or empty
            {
                echo "<img src='../images/avatars/defaultavatars/defaultavatar_4.png' alt='No photo supplied' />";
            }
            else
            {
                echo "<img src='../images/avatars/" . ($row['image']) . "'" . 'alt="member photo"' . "/>";//Display the member photo
            }
		?>
		
		<form action="accountimageprocessing.php" method="post" enctype="multipart/form-data">
			<input type="hidden" name="memberID" value="<?php echo $memberID; ?>">
			
			<label>New Image</label>
			<input type="file" name="image" /><br />
			<p>Accepted files are JPG, GIF or PNG. Maximum size is 500kb.</p>
			<p><input type="submit" name="imageupdate" value="Update Image" /></p>
		</form>
</article>

<article>
		<h1>Update Password</h1>
		<p>Passwords must have a minimum of 8 characters.</p>
		<form action="accountpasswordprocesing.php" method="post">
			<label>New Password <span class="required">*</span></label>
			<input type="password" name="password" pattern=".{8,}" title="Password must be 8 characters or more" required /><br />
			
			<input type="hidden" name="memberID" value="<?php echo $memberID; ?>">
			
			<p><input type="submit" name="passwordupdate" value="Update Password" /></p>
		</form>
</article>
<article>    
		<h1>Delete My Account</h1>
		
		<p>We're sorry to hear you'd delete your account. By clicking the below button you will permanently delete your account.</p>
		
		<form action="accountdelete.php" method="post">
			<p><input type="submit" value="Delete My Account" onclick="return confirm('Are you sure you wish to permanently delete your account?');" /></p>
			
			<input type="hidden" name="memberID" value="<?php echo $memberID; ?>" />
		</form>
</article>                                                
</section>

</div>
<?php
        include '../inc/footer.php';
?>