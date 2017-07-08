<?php

	require 'connect.inc.php';
	require 'core.inc.php';

		if(!loggedin())
		{
		if(isset($_POST['email'])&&isset($_POST['pwd'])&&isset($_POST['name'])&&isset($_POST['contact'])) 
		{
			$eid = $_POST['email']; $pwd=$_POST['pwd']; $fname=$_POST['name']; $mob = $_POST['contact'];
		
			if( !empty($eid) && !empty($pwd) && !empty($fname) &&!empty($mob) )
			{
				$query1= "SELECT email FROM userinfo WHERE email like ' $eid ';";
				$res=mysqli_query($con,$query1);
				
				if(mysqli_num_rows($res)>0)
				{
	?>
						<script type="text/javascript">
							alert("Already registered.");
						</script>
	<?php
				}
				else
				{

				$query = "INSERT INTO `userinfo`( `email`, `password`, `name`, `contact`) VALUES ( ' ". $eid." ', '$pwd', ' ".$fname." ','".$mob."')	";
				
				if( $query_run = mysqli_query($con,$query) )
				{
						$subject="link for email verification";
						$message = "Successfully registered";
					    mail($eid,$subject,$message,$headers);
						?>
						<script type="text/javascript">
							alert("Check your email for verification code..");
							
						</script>
						<?php
					       
				}
				else
				{
	?>
				<script type="text/javascript">
					alert("Sorry an error Ocurred . Try again later");
				</script>
	<?php			
				
				}
				}
			}
			else
			{
	?>
				<script type="text/javascript">
					alert("Please fill in all fields");
				</script>
	<?php			
			}
		}

		}
	else
	{
	?>
				<script type="text/javascript">
					alert("You are already registered...!!!");
				</script>
				
	<?php	
       header('Location: pp.php');

	}
?>	


