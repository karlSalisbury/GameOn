<?php
     $pageDescription = "Use this page to update or delete member details";
     $pageTitle = "Members"; 
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
 
  
 <p><a href="membernew.php"><input type="button" value="+ Add New"></a></p> 
 
 <?php 
     //retrieve total number of members 
     $sql = "SELECT * FROM member"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     $numrow = mysqli_num_rows($result); //retrieve the number of rows 
     echo "<p>There are currently <span class='badge'>" . $numrow . "</span> Members.</p>"; //echo the total number of contacts 
     
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
     
     $sql = "SELECT member.*, COUNT(comment.memberID) AS commentCount FROM member LEFT JOIN comment USING(memberID) GROUP BY member.memberID ORDER BY username ASC LIMIT $offset, $rowsperpage"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     echo "<table class='table table-striped'>"; // display records in a table format 
     echo "<td class='tableheading'>Username</td><td class='tableheading'>Name</td><td class='tableheading'>Email</td><td class='tableheading'>Joined</td><td class='tableheading'>Comments</td>"; 
     
     while ($row = mysqli_fetch_array($result)) 
     {
     echo "<tr>";
     echo "<td><img src='../images/avatars/" . $row['image'] . "' width='50' height='50' ></td>";          
     echo "<td>" . $row['username'] . "</td>"; 
     echo "<td>" . $row['firstName'] . " " . $row['lastName'] . "</td>"; 
     echo "<td><a href='mailto:" . $row['email'] . "'>" . $row['email'] . "</a></td>"; 
     echo "<td>" . date("d/m/y H:i",strtotime($row['joinDate'])) . "</td>"; 
     echo "<td><span class='badge'>" . $row['commentCount'] . "</span></td>"; 
     echo "<td><a href=\"memberupdate.php?memberID={$row['memberID']}\">Update</a> | <a href=\"memberdelete.php?memberID={$row['memberID']}\" onclick=\"return confirm('Are you sure you want to delete this member?')\">Delete</a></td>"; 
     echo "</tr>"; 
     } 
     
     echo "</table>"; 
?>     


<?php
    include 'inc/pagination.php';
?>


    
    
</section> <!-- end content --> 
 
<?php 
    include 'inc/adminfooter.php'; 
?> 