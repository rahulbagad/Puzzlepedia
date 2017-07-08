<?php
    require 'connect.inc.php';
    require 'core.inc.php';
    $uid=trim($_GET['uid']);$pid=trim($_GET['pid']);
    echo $uid;
    $queryx="update solved set status=3 where trim(uid)='$uid' and trim(pid)='$pid' ";
    mysqli_query($con,$queryx);
    $query="delete from answers where trim(uid)='$uid' and trim(pid)='$pid'";
    $query1= "SELECT * FROM `puzzle` where id = $pid ";


     $query3="select email from userinfo where trim(id)='$uid'";
     $result3 = mysqli_query($con,$query3);
     $row3=mysqli_fetch_assoc($result3);
      if( $query_run1 = mysqli_query($con,$query1) )
      {
        $result1 = $con->query($query1);  
        
        if ($result1->num_rows > 0) 
        {
            while($row1 = $result1->fetch_assoc())
            {
              
            
               
              if($query_run = mysqli_query($con,$query))
              {
                  ?>
                                <script type="text/javascript">
                                    alert("Deleted Successfully..");  
                                </script>
                   <?php
                                  $email=$row3['email'];
                                  $subject="Submission Result";
                                  $message = "Your answer for ".$row1['title']."was incorrect...You can try it again..";
                                  $headers="From: itspuzzlepedia@gmail.com";
                                  mail($email,$subject,$message,$headers);
                                  header("Refresh:0.3 url=evaluate.php");

              }	
            else
            {             
                              ?>
                                <script type="text/javascript">
                                    alert("Sorry, Something went wrong..");  
                                </script>
                            <?php
                             header("Refresh:0.3 url=evaluate.php");

            }
          }
      }
    }


          ?>