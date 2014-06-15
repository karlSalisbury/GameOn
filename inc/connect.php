<?php
	$connect = mysqli_connect("localhost", "root", "", "wdb2_salisbury");
	
	//Check connection and, if broken, display an error message
	if (mysqli_connect_errno($connect))
	{
		echo "Unable to connect to the server: " . mysqli_connect_error();
		exit();
	}
?>