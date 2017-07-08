<?php

	require 'connect.inc.php';
	require 'core.inc.php';
	if(loggedin())
	{
		session_destroy();
		?>
					<script type="text/javascript">
						alert("Successfully Logged Out..");	
					</script>
		<?php
		header( "refresh:0.3; url=index.php" );
	}
?>