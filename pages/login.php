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
	<link rel="stylesheet" href="../skeleton/css/base.css">
	<link rel="stylesheet" href="../skeleton/css/skeleton.css">
	<link rel="stylesheet" href="../skeleton/css/layout.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.png">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

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
	
	<style>
		body{
			background-image: url('../images/formbackground.png');
			background-size: cover;
			background-color: #000;
			background-attachment: fixed;
		}
		.form{
			/*box-shadow:0px 0px 500px 50px #505050;*/	
			position: relative;
			margin-top: 50%;
		}
		.formlogo{
			position: absolute;
			top: 30px;
			left: -14px;
		}
		
	
	</style>
	
	
</head>
<body>	


<div class='container formcontainer'>	
<div class='form clearfix'>

	<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>"><img class='closebutton' src='../images/closebutton.png' /></a>

	<img class='formlogo' src='../images/gameonlogo.png' />
	<div class='formheading'>
	<h1>Login</h1>
    </div>
    <?php
    //User messages
    if(isset($_SESSION['error'])) //If session error is set
        {
            echo '<div>';
            echo '<p class="error">' . $_SESSION['error'] . '</p>';//Display error message
            echo "</div>";
            unset($_SESSION['error']);//unset session error
        }
	if(isset($_SESSION['success'])) //If session error is set
        {
            echo '<div>';
            echo '<p class="success">' . $_SESSION['success'] . '</p>';//Display success message
            echo "</div>";
            unset($_SESSION['success']);//unset session error
        }
    ?>
    
    <form action="loginprocessing.php" method="post">
        <input type="text" name="username" id="username" placeholder="> Enter your username" autocomplete="off" required />
        <input type="password" id="password" name="password" placeholder="> Enter your password" autocomplete="off" required />
        <input type="hidden" value="<php echo $_GET['reviewID'];?>" name="reviewID" />
        <p><input type="submit" name="login" value="login" /></p>
    </form>
	
	<div class='formbottom'>
    <p>Don't have an account yet? Please <a href="registration.php">Sign up</a></p>
	</div>
</div>	
</div>	
	
	
	
	

</body>
</html>