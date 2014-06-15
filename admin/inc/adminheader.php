<?php
    session_start();
    include "../inc/connect.php";//Connect to the database
    if(!isset($_SESSION['admin']))
    {   
        header('location:../pages/index.php'); //If the admin session is not set redirect to the front end index.php
    }
?>
<!doctype html>

<html lang="en">

<head>

<head> 
     <meta charset="utf-8"> 
     <title>Dashboard: <?php echo $pageTitle ?></title> 
     
     <!-- link to favicon --> 
     <link href="../images/favicon.ico" rel="shortcut icon" /> 
     
     <!-- link to external CSS --> 
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	
     
     <!-- enable HTML5 in IE 8 and below --> 
     <!--[if IE]> 
     <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
     
      <![endif]-->
	
	    
    <script type="text/javascript" src="../js/tinymce/tinymce.min.js"></script> 
    <script type="text/javascript"> 
        tinymce.init({ 
            selector: "textarea", 
            menubar: false, 
            plugins: "link" 
        });  
    </script> 	
	
	<style>
	@import url(http://fonts.googleapis.com/css?family=Maven+Pro:400,500,700,900);
	
	
	h1, h2, h3, h4, h5, h6, p, ul li{
	  font-family: 'Maven Pro', Helvetica, Arial, sans-serif;
	}
	.jumbotron{
	color: #FFF;
	background-color: #2e2e2e;	
	background-image: url('../images/controllertransparent.png');
	background-repeat: repeat;
	background-position: fixed;
	}
	.jumbotron h1{
	text-align: center;	
		}
	a:link, a:visited{
		color: #bd5815;
		}	
	.badge{
		background-color: #bd5815;
		}
	.tableheading{
		font-weight: 800;
		}
	.themerow{
		margin-bottom: 30px;
		background-color: #d2d2d2;
		border: solid 1px #9d9d9d;
		padding-top: 15px;
		padding-bottom: 15px;
		border-radius: 15px;
	}
	.themerow img{
		border-radius: 3px;
		border: solid 10px #FFF;
		box-shadow: 2px 2px 5px #838383;
	}
	</style>
	
    
	<!-- Favicons
	================================================== -->
    <link rel="shortcut icon" href="../images/favicon.ico">
	<link rel="shortcut icon" href="../images/favicon.png">
	<link rel="apple-touch-icon" href="../images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../images/apple-touch-icon-114x114.png">    
    
</head>
    <body>
		
		<div class='jumbotron'>
        <h1><img src='../images/gameonlogonobackground.png' /> Control Panel</h1>
		</div>
		
		<div class='container'>

			
			
        <nav>
            <ul class="nav nav-tabs nav-justified">
                <li <?php if($pageTitle == "Home"){echo "class='active'";}?> ><a class='glyphicon glyphicon-cog' href="index.php"> ControlPanel</a></li>
                
                <li <?php if($pageTitle == "Reviews"){echo "class='active'";}?> ><a class='glyphicon glyphicon-pencil' href="../admin/reviews.php"> Reviews</a></li>
                
                <li <?php if($pageTitle == "Categories"){echo "class='active'";}?> ><a class='glyphicon glyphicon-tag' href="../admin/categories.php"> Categories</a></li>

                <li <?php if($pageTitle == "Comments"){echo "class='active'";}?> ><a class='glyphicon glyphicon-comment' href="../admin/comments.php"> Comments</a></li>

                <li <?php if($pageTitle == "Members"){echo "class='active'";}?> ><a class='glyphicon glyphicon-user' href="../admin/members.php"> Members</a></li>
                
                <li <?php if($pageTitle == "Administrators"){echo "class='active'";}?> ><a class='glyphicon glyphicon-user' href="../admin/administrators.php"> Administrators</a></li>                
                
                <li <?php if($pageTitle == "My Account"){echo "class='active'";}?> ><a class='glyphicon glyphicon-info-sign' href="../admin/account.php"> MyAccount</a></li>
                
                <li <?php if($pageTitle == "Themes"){echo "class='active'";}?> ><a class='glyphicon glyphicon-picture' href="../admin/themes.php"> Themes</a></li>
               
                <li><a class='glyphicon glyphicon-eye-open' target="_blank" href="../pages/index.php"> ViewSite</a></li>                 
                
                <li><a class='glyphicon glyphicon-log-out' href="../pages/logout.php"> Logout</a></li>

            </ul>

        </nav>	
		</div>
		<section class='container'>
		<div class='page-header'>	
        <h2><?php echo $pageTitle; ?></h2>
        <p class="well"><span class='glyphicon glyphicon-info-sign'>&nbsp;</span>Tip: <?php echo $pageDescription; ?></p>        
        </div>
        