<?php
	session_start();
?>


<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title><?php echo $pageTitle; ?></title>
  <meta name="description" content="Game On">
  <meta name="author" content="Game On">


	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	
	
	<!-- CSS
  ================================================== -->
	<!--- Contains global styling, fonts etc --->
    <link rel="stylesheet" href="../skeleton/css/base.css">
    
	<!--- Contains skeleton breakpoints, overrides for different screen sizes --->    
    <link rel="stylesheet" href="../skeleton/css/skeleton.css">

    <!--- Contains layout styling --->
    <link rel="stylesheet" href="../skeleton/css/layout.css">
    
 

    
<?php 
    $sql = "SELECT stylesheet, current.themeID FROM theme INNER JOIN current USING(themeID)"; //select the stylesheet from the theme table and the themeID from the current table 
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query 
 
    $row = mysqli_fetch_array($result); //store the results in a variable named $row 
?> 
 
<link rel="stylesheet" href="../skeleton/css/<?php echo $row['stylesheet'] ?>">

	
	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
    <link rel="shortcut icon" href="../images/favicon.ico">
	<link rel="shortcut icon" href="../images/favicon.png">
	<link rel="apple-touch-icon" href="../images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../images/apple-touch-icon-114x114.png">

	<script type="text/javascript" src="../js/tinymce/tinymce.min.js"></script> 
    <script type="text/javascript"> 
        tinymce.init({ 
            selector: "textarea", 
            menubar: false, 
            plugins: "link" 
        });  
    </script> 

	
	<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
	<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

    <?php
    /* Random digit to set random background image */        
    $randbackground = rand(1,5);
    /* Random digit to set random header image */        
    $randheader = rand(1, 4);
    ?>

	<style>
        
/* Sets a random background image */        
	body{
		background-image: url('../images/headerstripbackground.png'), url('../images/randombackgrounds/<?php echo $randbackground; ?>.png');
		background-attachment: scroll, fixed;
		background-size: auto, cover;
		background-repeat: repeat-x, no-repeat;
		background-position: top, top;		
	}
	</style>

	
</head>
<body>
	
<div class="accountinfobar clearfix">	
<?php 
 if(isset($_SESSION['member'])) // check to see if a member or admin is logged in and, if so, display the logged in menu items 
 { 
?>
<?php

    $memberID = $_SESSION['user'];

    $sql = "SELECT image FROM member WHERE memberID = '$memberID'";
    $result = mysqli_query($connect, $sql) or die(mysqli_error($connect)); //run the query
    $row = mysqli_fetch_array($result);  
          
    if(is_null($row['image']) || empty($row['image']))
    {
		echo "<div class='useravatar'>";
        echo "<p class='loggedinas'><img class='smallavatar' src='../images/avatars/defaultavatar.png' height='30' width='30' />";//If no avatar exists then set a default avatar
		echo "</div>";
    }
    echo "<div class='useravatar'>";
    echo "<p class='loggedinas'><img class='smallavatar' src='../images/avatars/" . $row['image'] . "' height='30' width='30' />You are logged in as " . ucfirst($_SESSION['member']) . "</p>";
    echo "</div>"; 
?>
<!--- Account login/logout buttons --->    
<nav class="accountbuttons"> 
 <ul> 
 <li><a href="logout.php">Logout</a></li> 
 <li><a href="account.php">My Account</a></li> 
 </ul> 
</nav>
      
<?php 
}
elseif(isset($_SESSION['admin']))
{
 	echo "<div class='useravatar'>";
    echo "<p class='loggedinas'><img class='smallavatar' src='../images/avatars/defaultavatar.png' height='30' width='30' />You are logged in as " . ucfirst($_SESSION['admin']) . "</p>";
    echo "</div>";	
	echo '<nav class="accountbuttons"><ul><li><a href="logout.php">Logout</a></li><li><a href="../admin/index.php">Control Panel</a></li></ul></nav>';

	
} 
else //if a member or admin is not logged in display the not logged in menu items 
{
    echo "<div class='useravatar'>";
    echo "<p class='loggedinas'><img src='../images/notloggedin.png' />You are not logged in</p>";
    echo "</div>";
	
    echo "<nav class='accountbuttons'>";
    echo "<ul>"; 
    echo "<li><a href='login.php'>Login</a></li>"; 
    echo "<li><a href='registration.php'>Create Account</a></li>";
    echo "</ul>"; 
    echo "</nav>"; 
} 
    
?>
	

<?php 

?> 
</div>
	
<div class="container navcontainer">
	<img class='siteid' src='../images/gameonlogo.png' />
<!--- SEARCH BAR --->    
	<div class='searchbar'>
		<form action="search.php" method="get" id="search">
			<input type="text" name="search" size="40" placeholder=">Search" />
		</form>    
	</div>
	
<nav class="mainnav"> <!-- display the main navigation --> 
 <ul>
 <li><a <?php if($pageTitle=='Home'){echo "class='current'";} ?> href="index.php">Home</a></li>
 <li><a <?php if($pageTitle=='Community'){echo "class='current'";} ?> href="community.php">Community</a></li>      
 <li><a <?php if($pageTitle=='Contact'){echo "class='current'";} ?> href="contact.php">Contact</a></li> 
 <li><a <?php if($pageTitle=='About'){echo "class='current'";} ?> href="about.php">About</a></li> 
 </ul> 
</nav> <!-- end main -->

<img class='mobilenavbutton' src='../images/hotdog.png' />

<script>
$( ".mobilenavbutton" ).click(function()
	{
	//confirm('you clicked the nav button');
	$( ".mobilenav" ).slideToggle("slow");
	$( ".black" ).fadeToggle("slow");
		
});

$(document).ready(function(){
	//confirm('jquery Loaded!')

});
	
</script>
    
	<!--- Sets a random header image --->        
	<img class='scale-with-grid imageheader' src='../images/randomheaders/<?php echo $randheader; ?>.png' />	
	
	
	
	
	
</div>
	
	
<!-- MOBILE NAVIGATION -->
	<nav class='mobilenav'>
	<ul>
		<li><a href='#' />Home</a></li>
		<li><a href='#' />Community</a></li>
		<li><a href='#' />Contact</a></li>
		<li><a href='#' />About</a></li>
	</ul>	
	</nav>
<div class='black'>
</div>
	
<div class='container contentcontainer'>
