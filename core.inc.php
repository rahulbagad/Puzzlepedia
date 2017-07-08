<?php

	session_start();
	
	function loggedin()
	{
		if( isset($_SESSION['eid'] ) )
		return true;
	
		return false;
	}

	function isAdmin()
	{
		if( $_SESSION['eid'] =='rlbagad2@gmail.com' || $_SESSION['eid'] =='agserb.777@gmail.com' )
			return true;
	
		return false;
	}
	
?>
