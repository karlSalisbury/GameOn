<?php
    $pageTitle = "Reviews";
    $pageDescription = "This is the review area, you can use this to create and manage reviews";
    include "inc/adminheader.php";
?>

<section id="content">

    <p><a href="reviewnew.php"><input type="button" value="+ Add New"></a></p> 
    
<?php
        //User messages

        if(isset($_SESSION['error']))//if session error is set
        {
            echo '<div class="alert alert-danger">';
            echo '<p>' . $_SESSION['error'] . '</p>';//display error message
            echo '</div>';
            unset($_SESSION['error']);//Destroy session error
        }
        elseif(isset($_SESSION['success']))//If session error is set
        {
            echo '<div class="alert alert-success">';
            echo '<p>' . $_SESSION['success'] . '</p>';//echo success message
			echo '</div>';
            unset($_SESSION['success']);//destroy session success message
        }

?>
    
<?php
    //retrieve total number of members
    $sql = "SELECT * FROM review";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run the query

    $numrow = mysqli_num_rows($result); //retrieve the number of rows

    echo "<p>There are currently <strong>" . $numrow . "</strong> Reviews.</p>";//echo the total number of contacts

    //create pagination
    $rowsperpage = 10;//number of rows to show per page
    $totalpages = ceil($numrow / $rowsperpage);//find out total pages by dividing number of rows by the number of pages

    //get the current page or set a default
    if(isset($_GET['currentpage']) && is_numeric($_GET['currentpage']))
    {
        $currentpage = (int) $_GET['currentpage'];//cast var as int. Convert a string into an integer.
    }
    else
    {
        $currentpage = 1;//default page number
    }

    //if current page is greater than total pages...
    if($currentpage > $totalpages)
    {
        $currentpage = $totalpages;//set current page to first page
    }


    //if current page is less than first page
    if($currentpage < 1)
    {
        $currentpage = 1;//set current page to first page
    }

    //the offset of the list, based on current page
    $offset = ($currentpage - 1) * $rowsperpage;

    //retrieve data from database for display

    $sql = "SELECT admin.adminID, admin.firstName, review.*, category.*, COUNT(comment.reviewID) AS commentCount FROM review INNER JOIN admin ON review.adminID = admin.adminID INNER JOIN category ON review.categoryID = category.categoryID LEFT JOIN comment ON review.reviewID = comment.reviewID GROUP BY review.reviewID, comment.reviewID ORDER BY date DESC LIMIT $offset, $rowsperpage"; 
    
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//run the query

    echo "<table class='table table-striped'>";//display records in a table format

    echo "<td class='tableheading'>Title</td><td class='tableheading'>Author</td><td class='tableheading'>Category</td><td class='tableheading'>Rating</td><td class='tableheading'>Datetime</td><td class='tableheading'>Comments</td>";

    while($row = mysqli_fetch_array($result))
    {
         echo "<tr>"; 
         echo "<td>" . $row['title'] . "</td>"; 
         echo "<td>" . $row['firstName'] . "</td>"; 
         echo "<td>" . $row['category'] . "</td>"; 
         echo "<td>" . $row['rating'] . " Stars</td>"; 
         echo "<td>" . date("d/m/y H:i",strtotime($row['date'])) . "</td>"; 
         echo "<td>" . "<span class='badge'>" . $row['commentCount'] . "</span>" . "</td>"; 
         echo "<td><a href=\"reviewupdate.php?reviewID={$row['reviewID']}\">Update</a> | <a href=\"reviewdelete.php?reviewID={$row['reviewID']}\" onclick=\"return confirm('Are you sure you want to delete this review?')\">Delete</a></td>"; 
         echo "</tr>";  
    }
    echo "</table>";
?>
<?php
    //Add pagination links
    include 'inc/pagination.php';
?>
</section>
    
<?php
    include "inc/adminfooter.php";
?>