<?php
    include "../inc/connect.php"; 
 
 //display HTML title tag for each review entry 
    $sql = "SELECT * FROM review WHERE reviewID =" . $_GET['reviewID']; //select the post using the reviewID 
    $result = mysqli_query($connect, $sql) or die(mysqli_error($con)); //run the query 
 
    while ($row = mysqli_fetch_array($result)){ 
    $page = $row['title']; 
 } 
    $pageTitle=$row['title'];
 
    include '../inc/header.php'; //session_start(); included in header.php 
?> 
<div class='two-thirds column'>
 
<?php 
    $sql = "SELECT review.*, category.*, admin.adminID, admin.firstName FROM review, admin, category WHERE review.adminID = admin.adminID && review.categoryID = category.categoryID && review.reviewID = " . $_GET['reviewID']; //use $_GET to retrieve the reviewID for the full entry 
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
 
    while ($row = mysqli_fetch_array($result)) 
    { 
    if((is_null($row['image'])) || (empty($row['image']))) //if the photo field is NULL or empty 
    {
    echo "<article class='reviews'>";
    echo "<img class='scale-with-grid' src='../images/defaultimage.png' width=620 height=300 alt='game on logo' /></p>"; //display the default photo 
    } 
    else 
    { 
    echo "<article class='reviews'>";
    echo "<img class='scale-with-grid' src='../images/" . ($row['image']) . "'" . ' width=620 height=300 alt="GameOn"' . "/>"; //display the review photo 
    } 
    echo "<h1>" . $row['title'] . "</h1>"; 
    echo "<p><em>posted on " . date("F jS Y, g:ia",strtotime($row['date'])) . " by " . $row['firstName'] . " in " . $row['category'] . "</em></p>"; //display the date, author and category 
 
    /* star rating */ 
    $rating= $row['rating']; //retrieve rating from database 
 
    for($i=0;$i<$rating;$i++){ 
    echo "<img class='star' src='../images/star_filled.png' alt='filled star' />"; //echo filled stars 
    } 
    for($i=0;$i<5-$rating;$i++){ 
    echo "<img class='star' src='../images/star_unfilled.png' alt='unfilled star' />"; //echo unfilled stars 
    } 
 
    echo "<p>" . $row['content'] . "</p>";
    echo "</article>";
    } 
?>
<article class="reviews">
    
<h2 id="blogcomment">Comments</h2> 
 
<?php 
 //user messages 
    if(isset($_SESSION['error'])) //if session error is set 
    { 
    echo '<div class="error">'; 
    echo '<p>' . $_SESSION['error'] . '</p>'; //display error message 
    echo "</div>"; 
    unset($_SESSION['error']); //unset session error 
    } 
    elseif(isset($_SESSION['success'])) //if session success is set 
    { 
    echo '<div class="success">'; 
    echo '<p>' . $_SESSION['success'] . '</p>'; //display success message 
    echo "</div>"; 
    unset($_SESSION['success']); //unset session success 
    } 
?> 
 
<?php 
    $sql = "(SELECT comment.*, member.memberID, member.username FROM comment INNER JOIN member USING(memberID) WHERE comment.memberID = member.memberID && comment.reviewID ='" . $_GET['reviewID'] . "') UNION (SELECT comment.*, admin.adminID, admin.username FROM comment INNER JOIN admin USING(adminID) WHERE comment.adminID = admin.adminID && comment.reviewID ='" . $_GET['reviewID'] . "') ORDER BY commentDate ASC"; //retrieve the comment for the reviewID 
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
 
    $numrows = mysqli_num_rows($result); 
 
    if($numrows == 0) 
    {
    echo "<article class='reviews commentlist'>";    
    echo "<p>No comments on this post</p>"; 
    echo "</article>";    
    } 
    else 
    { 
    while ($row = mysqli_fetch_array($result)) 
    {
    echo "<article class='reviews commentlist'>";
    echo "<p><em>posted on " . date("F jS Y, g:ia", strtotime($row['commentDate'])) . " by <strong>" . $row['username'] . "</strong></em></p>"; 
    //display the date, author and category 
    echo "<div class='membercomment'>" . $row['commentContent'] . "</div>"; // 
    echo "</article>";
    } 
    } 
?> 
<h2>Join the Discussion</h2> 
 
 <!-- check if user is logged in and, if so, display comment form --> 
<?php 
    if(isset($_SESSION['member'])) 
    { 
?> 
 
    <form action="blogprocessing.php" method="post"> 
    <textarea rows="10" cols="60%" name="comment" ></textarea> 
    <!-- use a hidden field to send the reviewID to the next page --> 
    <input type="hidden" value="<?php echo $_GET['reviewID']; ?>" name="reviewID" /> 
    <p><input type="submit" name="postComment" value="Post Comment" /></p> 
    </form> 
<?php 
    } 
    else 
    { 
    echo "<p>You must <a href='login.php?reviewID=" . $_GET['reviewID'] . "'>login</a> to comment."; //use the GET array to send the reviewID to the next page if the user clicks the login option in the review 
    } 
    echo "</article>";
?>
</div> 
	
<?php 
    include '../inc/sidebar.php'; 
?>
 
</div> <!-- end content --> 

<?php 
    include '../inc/footer.php'; 
?> 
