<?php

	$host = "";
	$user = "";
	$pass ="";
	$db = "";
	
	$con = mysqli_connect($host,$user,$pass,$db);
	
	if( mysqli_connect_errno())
	{
		echo " Fatal error ocurred please report it to us at rlbagad2@gmail.com . Thank you ";
		die();
	}
?>
