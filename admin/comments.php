<?php 
     $pageDescription = "Use this page to moderate comments";
     $pageTitle = "Comments"; 
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
 
 <h1>Comments</h1> 
 
 <?php 
     //retrieve total number of comments 
     $sql = "SELECT * FROM comment"; 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     $numrow = mysqli_num_rows($result); //retrieve the number of rows 
     echo "<p>There are currently <span class='badge'>" . $numrow . "</span> 
    Comments.</p>"; //echo the total number of contacts 
     
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
     $sql = "SELECT comment.*, member.firstName AS memberFirstName, admin.firstName AS adminFirstName, review.title FROM comment LEFT JOIN member ON comment.memberID = member.memberID LEFT JOIN admin ON comment.adminID = admin.adminID INNER JOIN review USING(reviewID) ORDER BY date DESC LIMIT $offset, $rowsperpage"; 
    //count the number of posts in each category 
     $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
     
     echo "<table class='table table-striped'>"; // display records in a table format 
     echo "<td class='tableheading'>Comment</td><td class='tableheading'>Author</td><td class='tableheading'>Review Title</td><td class='tableheading'>Date</td>"; 
     
     while ($row = mysqli_fetch_array($result))
     
     { 
         echo "<tr>"; 
         echo "<td>" . (substr(($row['commentContent']),0,40)) . "...</td>"; 
         echo "<td>" . $row['memberFirstName'] . $row['adminFirstName'] . "</td>"; 
         echo "<td>" . $row['title'] . "</td>"; 
         echo "<td>" . date("d/m/y H:i",strtotime($row['commentDate'])) . "</td>"; 
         if($row['memberID'] > 0) 
     { 
        echo "<td><a href=\"commentreply.php?commentID={$row['commentID']}\">Reply</a> | <a href=\"commentupdate.php?type=1&&commentID={$row['commentID']}\">Update</a> | <a href=\"commentdelete.php?commentID={$row['commentID']}\" onclick=\"return confirm('Are you sure you want to delete this comment?')\">Delete</a></td>"; 
     } 
     else 
     { 
        echo "<td><a href=\"commentreply.php?commentID={$row['commentID']}\">Reply</a> | <a href=\"commentupdate.php?type=0&&commentID={$row['commentID']}\">Update</a> | <a href=\"commentdelete.php?commentID={$row['commentID']}\" onclick=\"return confirm('Are you sure you want to delete this comment?')\">Delete</a></td>"; 
     } 
        echo "</tr>"; 
     } 
     
     echo "</table>"; 
    
     // build pagination links 
     $range = 4; // number of links to show 
    
     echo "<ul class='pagination'>"; 
     
     // if not on page 1, don't show back links 
     if ($currentpage > 1) 
     { 
     echo "<li><a href='{$_SERVER['PHP_SELF']}?currentpage=1'> << </a></li>"; // echo link to go back to first page 
     $prevpage = $currentpage - 1; // get previous page number 
     echo "<li><a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'> < Prev </a></li>"; // echo link to go back to previous page 
     } 
     
     // loop to show links to range of pages around current page 
     for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) 
     { 
         // if it's a valid page number... 
         if (($x > 0) && ($x <= $totalpages)) 
         { 
         // if we're on current page... 
         if ($x == $currentpage) 
         { 
         echo "<li class='active'><a href='#'>$x</a></li>"; // don't make a link 
         } else // if not current page... 
         { 
         echo "<li><a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a></li>"; // make it a link 
         } 
         }
         
     } 
     
     // if not on last page, show forward and last page links 
     if ($currentpage != $totalpages) 
     { 
         $nextpage = $currentpage + 1; // get next page 
         echo "<li><a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'> Next > </a></li>"; // echo forward link for next page
         echo "<li><a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'> >> </a></li>"; // echo forward link for last page 
     }
    echo "</ul>";



?>     
    
</section> <!-- end content --> 
 
<?php 
    include 'inc/adminfooter.php'; 
?> 