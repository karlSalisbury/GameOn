<?php 
     $pageDescription = "Use this page to change the website theme";
     $pageTitle = "Themes"; 
     include '../inc/connect.php'; 
     include 'inc/adminheader.php'; //session_start(); in this file 
?> 
 
<section id="content"> 
 
<?php 
    include 'inc/errormessage.php';
?> 
  
 <h1 class='page-header'>Select a theme for your website.</h1> 
 
<?php 
 
     $sql = "SELECT * FROM theme"; //select the data from the theme table 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     while ($row = mysqli_fetch_array($result)) 
     { 
         echo "<div class='row themerow'>";
		 echo "<div class='col-md-8'>";
		 echo "<img class='img-responsive' src='../images/themeimages/" . ($row['Image']) . "'" . ' width=700 height=352 alt="GameOn"' . "/>"; //display the theme photo 
		 echo "</div>";
         echo "<div class='col-md-2'>";
		 echo "<h2>" . $row['name'] . "</h2>"; //display the theme name 
         echo "<p>" . $row['Description'] . "</p>"; //display the theme description 
         echo "<form action='themeprocessing.php' method='post'>"; 
         echo "<input type='hidden' name='themeID' value=" . $row['themeID'] . ">"; 
        //a hidden form field holds the themeID 
         echo "<p><input type='submit' value='Activate'>"; 
         echo "</form>";
		 echo "</div>";
		 echo "</div>";
     }
?> 
 
</section> <!-- end content --> 
 
<?php
    include 'inc/adminfooter.php'; 
?> 