<?php
     $pageDescription = "Use this page to update member details";
     $pageTitle = "Update Member"; 
     include "../inc/connect.php"; 
     include 'inc/adminheader.php'; //session_start(); in this file 
?> 
 
<section id="content"> 
 
<?php 
     $memberID = $_GET['memberID']; //retrieve memberID from URL 
     
     $sql = "SELECT * FROM member WHERE memberID = '$memberID'"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     $row = mysqli_fetch_array($result); 
?> 
 
<?php 
     //user messages 
     if(isset($_SESSION['error'])) //if session error is set
     
{ 
     echo '<div class="alert alert-danger">'; 
     echo '<p>' . $_SESSION['error'] . '</p>'; //display error message 
     echo '</div>'; 
     unset($_SESSION['error']); //unset session error 
 } 
 elseif(isset($_SESSION['success'])) //if session success is set 
 { 
     echo '<div class="alert alert-success">'; 
     echo '<p>' . $_SESSION['success'] . '</p>'; //display success message 
     echo '</div>'; 
     unset($_SESSION['success']); //unset session success 
 } 
?> 

<div class='row'>
<div class='col-md-12'><h1 class='page-header'>Update Member details</h1></div>         
<div class="col-md-6">    
 <form action="memberupdateprocessing.php" method="post"> 
<div class='alert alert-warning'> 
<label>Username*</label> <input class='form-control' type="text" name="username" required value="<?php echo $row['username'] ?>" readonly /><br /> 
<p>Username cannot be updated.</p></div>
 <label>First Name*</label> <input class='form-control' type="text" name="firstName" required value="<?php echo $row['firstName'] ?>" /><br /> 
 <label>Last Name*</label> <input class='form-control' type="text" name="lastName" required value="<?php echo $row['lastName'] ?>" /><br /> 
 <label>Street</label> <input class='form-control' type="text" name="street" value="<?php echo $row['street'] ?>"/><br /> 
 <label>Suburb</label> <input class='form-control' type="text" name="suburb" value="<?php echo $row['suburb'] ?>" /><br /> 
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
     $row = mysqli_fetch_array($result); //store the results in a variable named $row 
     $type = preg_replace('/(^enum\()/i', '', $row['Type']); //regular expression to replace the enum syntax with blank space 
     $enumValues = substr($type, 0, -1); //return the enum string 
     $enumExplode = explode(',', $enumValues); //split the enum string into individual values 
     return $enumExplode; //return all the enum individual values 
     } 
     
     $enumValues = getEnumState('member', 'state'); 
     echo '<select class="form-control" name="state">'; 
     
     if((is_null($row['state'])) || (empty($row['state']))) //if the state field is NULL or empty 
     { 
     echo "<option value=''>Please select</option>"; //display the 'Please select' message 
     }
     else 
     { 
     echo "<option value=" . $row['state'] . ">" . $row['state'] . "</option>"; //display the selected enum value 
     }
     foreach($enumValues as $value) 
     { 
     echo '<option value="' . $removeQuotes = str_replace("'", "", $value) . '">' . $removeQuotes = str_replace("'", "", $value) . '</option>'; //remove the quotes from the enum values 
     } 
     echo '</select><br />'; 
?>

    </div>
    <div class='col-md-6'>
     
     <label>Postcode *</label> <input class='form-control' type="text" name="postcode" required value="<?php echo $row['postcode'] ?>"/><br /> 
     <label>Country *</label> <input class='form-control' type="text" name="country" value="<?php echo $row['country'] ?>"/><br /> 
     <label>Phone</label> <input class='form-control' type="text" name="phone" value="<?php echo $row['phone'] ?>"/><br /> 
     <label>Mobile</label> <input class='form-control' type="text" name="mobile" value="<?php echo $row['mobile'] ?>" /><br /> 
     <label>Email *</label> <input class='form-control' type="email" name="email" required value="<?php echo $row['email'] ?>" /><br /> 
     <label>Gender *</label> 
<?php 
     //generate drop-down list for gender using enum data type and values from database 
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
     echo '<select class="form-control" name="gender">'; 
     
     echo "<option value=" . $row['gender'] . ">" . $row['gender'] . "</option>"; //display the selected enum value 
 
 foreach($enumValues as $value) 
 { 
    echo '<option value="' . $removeQuotes = str_replace("'", "", $value) . '">' . $removeQuotes = str_replace("'", "", $value) . '</option>'; 
 } 
    echo '</select>'; 
?> 
 <br />
     

          
     
     
<div class="well">     
     <label>Subscribe to weekly email newsletter?</label>
     <div class='row'>

     <div class='col-md-1 col-xs-2'><label>Yes</label><input class="radio" type="radio" name="newsletter" value="Y" <?php if($row['newsletter'] == "Y"){echo "checked";} ?>></div> 
     <div class='col-md-1 col-xs-2'><label>No</label><input class="radio" type="radio" name="newsletter" value="N" <?php if($row['newsletter'] == "N"){echo "checked";} ?>></div>
         
     </div>     
</div>
     
     
     <input type="hidden" name="memberID" value="<?php echo $memberID; ?>"> 
     <p><input type="submit" name="accountupdate" value="Update Account" /></p> 
 </form>
</div>     
</div>
    
    
    
<div class='row'>
    <div class='col-md-12'><h1 class='page-header'>Update Image</h1></div>         
    <div class="col-md-2">     
    <?php 
         if((is_null($row['image'])) || (empty($row['image']))) //if the photo field is NULL or empty
         { 
         echo "<p><img src='../images/avatars/defaultavatars/defaultavatar_4.png' width=150 height=150 alt='default photo' /></p>"; //display the default photo 
         } 
         else 
         { 
         echo "<p><img src='../images/avatars/" . ($row['image']) . "'" . 'width=150 height=150 alt="contact photo"' . "/></p>"; //display the contact photo 
         } 
    ?>
    </div>
    <div class="col-md-10">
        <div class='alert alert-warning'>
        <form action="memberimageprocessing.php" method="post" enctype="multipart/form-data">    
            <input type="hidden" name="memberID" value="<?php echo $memberID; ?>">
            <label>New Image</label> <input type="file" name="image" /><br />
            <p>Accepted files are JPG, GIF or PNG. Maximum size is 500kb.</p>
            </div>
            <p><input type='submit' name='imageupdate' value="Update Image" /></p>
        </form>
    </div>
</div>

    
<div class='row'>
    <div class='col-md-12'><h1 class='page-header'>Update Password</h1></div>         
        <div class="well col-md-12">     
        <p>Passwords must have a minimum of 8 characters.</p>
        
        <form action="memberpasswordprocessing.php" method="post">
            <label>New Password *</label> <input class='form-control' type="password" name="password" pattern=".{8,}" title="Password must be 8 characters or more" required /><br />
            <input type="hidden" name="memberID" value="<?php echo $memberID; ?>">
            <p><input type="submit" name="passwordupdate" value="Update Password" /></p>
        </form>
        </div>
</div>        


<div class='row'>
    <div class='col-md-12'><h1 class='page-header'>Delete Member</h1></div>         
        <div class="well col-md-12">     
        <p class='alert alert-danger'>By clicking the button below you will permanently delete the member.</p>
    <form action="memberdelete.php" method="post">
        <p><input type="submit" value="Delete Member" onclick="return confirm('Are you sure you wish to permanently delete this member?');" ></p>
        <input type="hidden" name="memberID" value="<?php echo $memberID; ?>">
    </form>
        </div>
</div>
    
</section>

<?php
    include 'inc/adminfooter.php';
?>