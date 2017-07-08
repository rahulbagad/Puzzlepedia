<?php

	$host = "mysql.hostinger.in";
	$user = "u219107807_pp";
	$pass ="unicorn123";
	$db = "u219107807_puzz";
	
	$con = mysqli_connect($host,$user,$pass,$db);
	
	if( mysqli_connect_errno())
	{
		echo " Fatal error ocurred please report it to us at rlbagad2@gmail.com . Thank you ";
		die();
	}
?>