<?php 
     $pageDescription ="Use this page to add new members";
     $pageTitle = "Add New Member"; 
     include '../inc/connect.php'; 
     include 'inc/adminheader.php'; //session_start(); in this file 
?> 
 
<section id="content"> 
 
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
<div class='col-md-6'>  
<form action="membernewprocessing.php" method="post" enctype="multipart/form-data"> 
<!-- the multipart/form-data is essential for file upload functionality --> 
     <label>Username*</label> <input class='form-control' type="text" name="username" required /><br /> 
     <label>Password*</label> <input class='form-control' type="password" name="password" required pattern=".{8,}" title= "Password must be 8 characters or more" /><br /> 
     <label>First Name*</label> <input class='form-control' type="text" name="firstName" required /><br /> 
     <label>Last Name*</label> <input class='form-control' type="text" name="lastName" required /><br /> 
     <label>Street</label> <input class='form-control' type="text" name="street" /><br /> 
     <label>Suburb</label> <input class='form-control' type="text" name="suburb" /><br /> 
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
     
     echo "<option value=''>Please select</option>"; 
     
     foreach($enumValues as $value) 
     { 
     echo '<option value="' . $removeQuotes = str_replace("'", "", $value) . '">' . $removeQuotes = str_replace("'", "", $value) . '</option>'; //remove the quotes from the enum values 
     } 
     echo '</select><br />'; 
?> 
 
    
     <label>Postcode*</label> <input class='form-control' type="text" name="postcode" required /><br /> 

</div>
<div class='col-md-6'>          

     <label>Country*</label> <input class='form-control' type="text" name="country" required /><br />
     <label>Phone</label> <input class='form-control' type="text" name="phone" /><br />     
     <label>Mobile</label> <input class='form-control' type="text" name="mobile" /><br /> 
     <label>Email*</label> <input class='form-control' type="email" name="email" required /><br /> 
     <label>Gender*</label>
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
     
     echo "<option value=''>Please select</option>";
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
     <div class='col-md-1 col-xs-2'><label>Yes</label><input class="radio" type="radio" name="newsletter" value="Y" checked><br /></div> 
     <div class='col-md-1 col-xs-2'><label>No</label><input class="radio" type="radio" name="newsletter" value="N"><br /></div>
     </div>
    </div>
    <div class='alert alert-warning'>
     <label>Image</label><input type="file" name="image" />
    
     <p>Accepted files are JPG, GIF or PNG. Maximum size is 500kb.</p></div> 
     <p><input type="submit" name="newmember" value="+ Add New Member" /></p> 
</div>
</form> 
 
</section> <!-- end content --> 
 
<?php 
 include 'inc/adminfooter.php'; 
?>