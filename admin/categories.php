
<?php 
     $pageDescription = "Use this page to rename and delete categories";
     $pageTitle = "Categories"; 
     include '../inc/connect.php'; 
     include 'inc/adminheader.php'; //session_start(); in this file 
     //include "../inc/logincheckadmin.php"; 
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
 
 
 <p><a href="categorynew.php"><input type="button" value="+ Add New"></a></p> 
 
 <?php 
     //retrieve total number of categories 
     $sql = "SELECT * FROM category"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     $numrow = mysqli_num_rows($result); //retrieve the number of rows 
     echo "<p>There are currently <span class='badge'>" . $numrow . "</span> Categories.</p>"; //echo the total number of contacts 
     
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
     $sql = "SELECT category.*, COUNT(review.categoryID) AS categoryCount FROM category LEFT JOIN review ON category.categoryID = review.categoryID GROUP BY category.categoryID ORDER BY category ASC LIMIT $offset, $rowsperpage"; //count the number of posts in each category 
     
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     echo "<table class='table table-striped'>"; // display records in a table format 
     echo "<td class='tableheading'>Category</td><td class='tableheading'>Description</td><td class='tableheading'>Reviews</td>"; 
     
     while ($row = mysqli_fetch_array($result)) 
     { 
     echo "<tr>"; 
     echo "<td>" . $row['category'] . "</td>"; 
     echo "<td>" . $row['categoryDesc'] . "</td>"; 
     echo "<td><span class='badge'>" . $row['categoryCount'] . "</span></td>"; 
     echo "<td><a href=\"categoryupdate.php?categoryID={$row['categoryID']}\">Update</a> | <a href=\"categorydelete.php?categoryID={$row['categoryID']}\" onclick=\"return confirm('Are you sure you want to delete this category?')\">Delete</a></td>"; 
     echo "</tr>"; 
     } 
     
     echo "</table>"; 
?>     
     
<?php
    //Add pagination links
    include 'inc/pagination.php';
?>
 
 
</section> <!-- end content --> 
 
<?php 
    include 'inc/adminfooter.php'; 
?> 

