<?php
    $pageTitle ='Community';
    include '../inc/connect.php'; //include the database connection
    include '../inc/header.php';//include the header tag
?>

<div class='sixteen columns'>
<h1>Welcome to the GameOn Community</h1>
    
    <?php
	
        $sql = "SELECT * FROM member";
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run the query

        $numrow = mysqli_num_rows($result);
        
        echo "<p class='currentmembers'>There are currently " . $numrow . " members</p></div>";//Echo total number of rows returned from query to show how many members there are

        //create pagination
        
        $rowsperpage = 6; //number of rows to show per page
        
        $totalpage = ceil($numrow / $rowsperpage);//Find out total pages by dividing the total number of rows by how many rows will be displayed per page, round up numbers using ceil().
        
        
        //Get the current page or set a default

        if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage']))
            //If currentpage exists in $_GET and is also a number
        {
            $currentpage = (int) $_GET['currentpage']; //"cast var as int", aka: convert numeric string to integer
        }
        else
        {
            $currentpage = 1; //Assign 1 to the currentpage variable to make 1 the default page number
        }
        
        //if current page is greater than total pages
        if($currentpage > $totalpage) //set current page to last page
        {
            $currentpage = 1; //set current page to first page
        }
           
        // the offset of the list, based on current page
        $offset = ($currentpage - 1) * $rowsperpage;
        

        //Retrieve the data from database for display
        
        $randomnumber = rand(0, 5);
        $sql = "SELECT * FROM member ORDER BY joinDate DESC LIMIT $offset, $rowsperpage";
        $result = mysqli_query($connect, $sql) or die(mysqli_error($connect));//Run the query
        
        while ($row = mysqli_fetch_array($result))
        {
            if ((is_null($row['image'])) || (empty($row['image']))) //If the photo field is null or empty
            {
                echo "<div class='one-third column member'><img src='../images/avatars/defaultavatars/defaultavatar_" . $randomnumber . ".png' alt='No photo supplied' />";
                $randomnumber = $randomnumber + 1;
                    if($randomnumber > 5){
                       $randomnumber = 1;
                    }
            }
            else
            {
                echo "<div class='one-third column member'><img src='../images/avatars/" . ($row['image']) . "'" . 'alt="member photo" height="150" width="150" ' . "/>";//Display the member photo
            }
        echo "<h2>" . ucfirst($row['username']) . "</h2>";
        echo "<h3>" . ucfirst($row['country']) . "</h3>";
        echo "<h4>Joined " . date("d F, Y ", strtotime($row['joinDate']));
        echo "</h4></div>";
                   }




        $range = 4;//Number of links to show
    
        echo "<div class='sixteen columns' id='pagination'>";
    
        // if not on page 1, don't show back links
    
        if ($currentpage > 1)
        {
            echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a>&nbsp; "; //echo link to go back to first page
            $prevpage = $currentpage - 1; //Set the previous page variable to be the current page decremented by 1
            echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'>< Prev</a>&nbsp; "; //Echo link to go back to previous page
        }









// loop to show links to range of pages around current page 
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) 
        { 
            // if it's a valid page number... 
            if (($x > 0) && ($x <= $totalpage)) 
            { 
                // if we're on current page... 
                if ($x == $currentpage)
                { 
                    echo "<span class='activePagination'>$x</span>&nbsp;"; // don't make a link 
                }
                else // if not current page... 
                {
                    echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a>&nbsp; "; // make it a link 
                } 
            } 
        }

//if not on the last page, show forward and last page links
    if ($currentpage != $totalpage)
    {
        $nextpage = $currentpage + 1; //Set the next page variable to the current page incremented by 1
        echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>Next ></a>&nbsp; "; //echo forward link for next page
        echo " <a href={$_SERVER['PHP_SELF']}?currentpage=$totalpage'>>></a>"; // Echo forward link for last page
    }

    echo "</div>"; // End pagination
?>
    
<!--- End the content -->
</div>






<?php
    include '../inc/footer.php';
?>