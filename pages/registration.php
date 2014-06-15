<?php
    $pageTitle = "Login";
    include '../inc/connect.php';
    include '../inc/header.php';//Include the header and nav
?>


<div class='registrationcolumn two-thirds column'>
        <h1>Join GameOn</h1>
        <p>Complete the details below to sign up for a new account.</p>
        <p>Passwords must have a minimum of 8 characters.</p>
<div class='one-third column'>
<?php
    //user messages

    if(isset($_SESSION['error'])) //if session error is set
    {
        echo '<div class="error">';
        echo '<p>' . $_SESSION['error'] . '</p>'; //display error messages
        echo '</div>';
        unset($_SESSION['error']);//unset session error
    }
?>
    
    <form action="registrationprocessing.php" method="post" enctype="multipart/form-data">
        
        <label>Username <span class="required">*</span></label>
        <input type="text" name="username" required /><br />
        
        <label>Password <span class="required">*</span></label>
        <input type="password" name="password" required pattern=".{8,}" title="Password must be 8 characters or more" /><br />
        <label>First Name <span class="required">*</span></label>
        <input type="text" name="firstName" required /><br />
        
        <label>Last Name  <span class="required">*</span></label>
        <input type="text" name="lastName" required /><br />

        <label>Street</label>
        <input type="text" name="street" /><br />

        <label>Suburb</label>
        <input type="text" name="suburb" /><br />

        <label>State</label>
<?php        
        //Generate drop-down list for state using enum data type and values from database
        
        $tableName='member';
        $colState='state';
        
        function getEnumState($tableName, $colState)
        
        {
            global $connect; //Enable database connection in the function
        
            $sql = "SHOW COLUMNS FROM $tableName WHERE field='$colState'"; //retrieve enum column

            $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //Run SQL
        
            $row = mysqli_fetch_array($result);//Store the results in a variable named $row
        
            $type = preg_replace('/(^enum\()/i', '', $row['Type']);//RegEx  to replace the enum syntax with blank spaces
            $enumValues = substr($type, 0, -1); //Return enum string
        
            $enumExplode = explode(',', $enumValues); //Split the enum string into individual values
        
            return $enumExplode; //Return all the enum individual values
        }
        
        $enumValues = getEnumState('member', 'state');
        echo '<select name="state">';
        
        echo "<option value=''>Please select</option>";
        
        foreach($enumValues as $value)
        
        {
            echo '<option value="' . $removeQuotes = str_replace("'", "", $value) . '">' . $removeQuotes = str_replace("'", "", $value) . '</option>'; //remove the quotes from the enum values
        }
        
        echo '</select><br />';
?>

        <label>Gender <span class="required">*</span></label>

<?php
        
        //Generate drop-down list for gender using enum data type and values from database
        
        $tableName='member';
        $colGender='gender';

        function getEnumGender($tableName, $colGender)
            { 
            global $connect; //enable database connection in the function 
            $sql = "SHOW COLUMNS FROM $tableName WHERE field='$colGender'"; 
            //retrieve enum column 
            $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); 
            //run the query 
            $row = mysqli_fetch_array($result); //store the results in a variable named $row 
            $type = preg_replace('/(^enum\()/i', '', $row['Type']); //regular expression to replace the enum syntax with blank space 
            $enumValues = substr($type, 0, -1); //return the enum string 
            $enumExplode = explode(',', $enumValues); //split the enum string into individual values 
            
            return $enumExplode; //return all the enum individual values 
            } 
            $enumValues = getEnumGender('member', 'gender'); 
        echo '<select name="gender" required>'; 
 
        echo "<option value=''>Please select</option>"; 
 
        foreach($enumValues as $value) 
        { 
        echo '<option value="' . $removeQuotes = str_replace("'", "", $value) . '">' . $removeQuotes = str_replace("'", "", $value) . '</option>'; 
        } 
        echo '</select>'; 
 ?> 
        
        
        
        
</div>
        
<div class='one-third column'>        
        
        <label>Postcode <span class="required">*</span></label>
        <input type="text" name="postcode" required /><br />

        <label>Country <span class="required">*</span></label>
        <input type="text" name="country" required /><br />

        <label>Phone</label>
        <input type="text" name="phone" /><br />
        
        <label>Mobile</label>
        <input type="text" name="mobile" /><br />
        
        <label>Email <span class="required">*</span></label>
        <input type="email" name="email" required /><br />

        <p>Subscribe to weekly email newsletter?</p> 
        <label>Yes</label><input type="radio" name="newsletter" value="Y" checked><br /> 
        <label>No</label><input type="radio" name="newsletter" value="N"><br /> 
        <label>Image</label> <input type="file" name="image" /> 
        <p>Accepted files are JPG, GIF or PNG. Maximum size is 500kb.</p> 
        <p><input type="submit" name="registration" value="Create New Account" /></p> 
</form>
</div>
</div>    
    

</div>

<?php
    include '../inc/footer.php';
?>

