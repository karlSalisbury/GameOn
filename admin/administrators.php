<?php
     $pageDescription = "Use this page to manage administrator accounts";
     $pageTitle = "Administrators"; 
     include '../inc/connect.php'; 
     include 'inc/adminheader.php'; //session_start(); in this file 
?> 
 
<section id="content"> 

    
<?php
    //code to display error messages
    include 'inc/errormessage.php';
?>
  
 <p><a href="administratornew.php"><input type="button" value="+ Add New"></a></p> 
 
 <?php 
     //retrieve total number of members 
     $sql = "SELECT * FROM admin"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     $numrow = mysqli_num_rows($result); //retrieve the number of rows 
     echo "<p>There are currently <span class='badge'>" . $numrow . "</span> Administrators.</p>"; //echo the total number of contacts 
     
     //create pagination 
     $rowsperpage = 10; // number of rows to show per page 
     $totalpages = ceil($numrow / $rowsperpage); // find out total pages
     // get the current page or set a default 
 if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) 
     { 
     $currentpage = (int) $_GET['currentpage']; // cast var as int 
     } 
     else 
     { 
     $currentpage = 1; // default page number 
     } 
     
     // if current page is greater than total pages... 
     if ($currentpage > $totalpages) 
     { 
     $currentpage = $totalpages; // set current page to last page 
     } 
     
     // if current page is less than first page... 
     if ($currentpage < 1) 
     { 
     $currentpage = 1; // set current page to first page 
     } 
     
     // the offset of the list, based on current page 
     $offset = ($currentpage - 1) * $rowsperpage; 
     
     // retrieve data from database for display 
     $sql = "SELECT admin.*, COUNT(review.adminID) AS reviewCount FROM admin LEFT JOIN review USING(adminID) GROUP BY admin.adminID ORDER BY username ASC LIMIT $offset, $rowsperpage";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     echo "<table class='table table-striped'>"; // display records in a table format 
     echo "<td class='tableheading'>Username</td><td class='tableheading'>Name</td><td class='tableheading'>Email</td><td class='tableheading'>Datetime</td><td class='tableheading'>Reviews</td>"; 
     
     while ($row = mysqli_fetch_array($result)) 
     { 
     echo "<tr>"; 
     echo "<td>" . $row['username'] . "</td>"; 
     echo "<td>" . $row['firstName'] . " " . $row['lastName'] . "</td>"; 
     echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>"; 
     echo "<td>" . date("d/m/y H:i",strtotime($row['joinDate'])) . "</td>"; 
     echo "<td><span class='badge'>" . $row['reviewCount'] . "</span></td>"; 
     echo "</tr>"; 
     } 
     
     echo "</table>"; 
     
     // build pagination links 
     $range = 4; // number of links to show 
?>

<?php
    //Add pagination links
    include 'inc/pagination.php';
?>
 
</section> <!-- end content --> 
 
<?php 
 include 'inc/adminfooter.php'; 
?>  
 