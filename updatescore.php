<?php  
   require 'connect.inc.php';
   require 'core.inc.php';
   
	   if(1)
	   {    
   	
    
   	            $score=$_GET['score'];$uid=trim($_GET['uid']);$pid=$_GET['pid'];
                    $score=$score/2;
       
   	            $query="update userinfo set score=score + '$score'  where trim(id)=$uid ";
   	            
   	            if( $query_run = mysqli_query($con,$query))
   	            {
   	                $result = $con->query($query);
                       
   	                ?>
			   <script type="text/javascript">
				   alert("Score Updated..");             
			   </script>
		        <?php
			   $query1= "SELECT * FROM solved WHERE uid=trim($uid) AND pid=trim($pid);";
			   $res=mysqli_query($con,$query1);
			   
			   if(mysqli_num_rows($res)>0)
			   {
			    $queryy="update solved set status=1 where uid=trim($uid) and pid=trim($pid)";
			    if(mysqli_query($con,$queryy))
			    {
				  $query2="select email from userinfo where id=trim($uid)";
				  $result2 = mysqli_query($con,$query2);
				  $row2=mysqli_fetch_assoc($result2);
			   
				  $query3="select title from puzzle where id=trim($pid)";
				  $result3 = mysqli_query($con,$query3);
				  $row3=mysqli_fetch_assoc($result3);
			   
			   
				  $eid=$row2['email'];
				  $subject="Submission Result";
				  $message ="Congratulations, Your answer for ".$row3['title']."is correct.You got full points for this submission....";
				  $headers="From: itspuzzlepedia@gmail.com";
				  mail($eid,$subject,$message,$headers);
			   ?>
			<script type="text/javascript">
			   alert("checked..");             
			</script>
			<?php
			   }
				 header( "refresh:0.3; url=evaluate.php" );
			   }
			   else
			   {
			   $queryx="insert into solved values('$uid','$pid',1,'$score')";
			   if(mysqli_query($con,$queryx))
			   {
				$query2="select email from userinfo where id=trim($uid)";
				$result2 = mysqli_query($con,$query2);
				$row2=mysqli_fetch_assoc($result2);
			   
				$query3="select title from puzzle where id=trim($pid)";
				$result3 = mysqli_query($con,$query3);
				$row3=mysqli_fetch_assoc($result3);
			   
			   
				$eid=$row2['email'];
				$subject="Submission Result";
				$message ="Congratulations, Your answer for ".$row3['title']."is correct...";
				$headers="From: itspuzzlepedia@gmail.com";
				mail($eid,$subject,$message,$headers);
		
			   ?>
			<script type="text/javascript">
			   alert("checked..");             
			</script>
			<?php
			   } 
				   header( "refresh:0.3; url=evaluate.php" );
				       }
			   }
			   
			   
	}
	 else
	{
?>
		<script type="text/javascript">
		   alert("Var bagh, magar udtay..");             
		</script>
		<?php
		   header( "refresh:0.3; url=index.php" );
		   
	}
		   
?>
