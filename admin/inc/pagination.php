<?php
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