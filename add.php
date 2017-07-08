<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Add Puzzle</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="style.css">
      <link rel="icon" href="puz.png">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style>
         .bg-4 { 
         background-color: #2f2f2f; /* Black Gray */
         color: #fff;
         }
         .b{ 
         background-color: #e6e6e6; /* light grey */
         color: #000000;
         }
      </style>
   </head>
   <body class="b">
      <?php
         require 'connect.inc.php';
         require 'core.inc.php';
         
         if(loggedin())
         {
         ?>
      <nav class="navbar navbar-inverse">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span> 
               </button>
               <a class="navbar-brand" href="index.php">PuzzlePedia</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
               <ul class="nav navbar-nav">
                  <li><a href="index.php">Home</a></li>
                  <li><a href="puzzlemine.php">Puzzle Mine</a></li>
                  <li><a href="practise.php">Practise</a></li>
                  <li><a href="leaderboard.php">Leaderboard</a></li>
               </ul>
               <ul class="nav navbar-nav navbar-right">
               <?php if(!loggedin())
           	{
		?>
                  <li><a data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                  <li><a data-toggle="modal" data-target="#register"><span class="glyphicon glyphicon-edit"></span> Register</a></li>
             	<?php
           	 }
    		else
           	 {
		?>
                  <li class="active"><a href="add.php">Add Puzzle</a></li>
                  <li><a href="profile.php?id=<?php echo $_SESSION['id'];?>"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
                  <li style="padding:5px"><button class="btn btn-primary" type="button">Score <span class="badge">
     		<?php
   	            $query="select * from userinfo where id = '".$_SESSION['id']."' ";
                    if( $query_run = mysqli_query($con,$query) )  
                   {  
        	          $result = $con->query($query);       
            	         if ($result->num_rows > 0) 
        		 { 
                        
           	               while($row = $result->fetch_assoc())
           	               {
                         
           	                echo $row['score'];?></span></button>
                  </li>
                  <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>Logout</a></li>
           		       <?php
           	          	 }
           	         }
                     }
                     
                     
                }
		?>
               </ul>
            </div>
         </div>
      </nav>
      <div class='container'>
         <h2>Enter Puzzle Title & Details:</h2>
         <br><br>
         <div id="small_form">
            <form action="add.php" method="post" role="form" enctype="multipart/form-data">
               <div class="form-group">
                  <label class="control-label col-sm-2" >Puzzle Title:</label>
                  <div class="col-sm-10">
                     <input class='form-control' type="text" name="title" required placeholder="Enter Puzzle Title"><br><br>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" >Description & Questions:</label>
                  <div class="col-sm-10">
                     <textarea name="dq" class='form-control' rows="8" placeholder="Enter Description and Question"></textarea>  <br><br>    
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" >Image(if necessary):</label>
                  <div class="col-sm-10">
                     <input class='form-control' type="file" name="img" ><br><br>
                  </div>
               </div>
               <br>
               <br>
               <div class="form-group">
                  <label class="control-label col-sm-2" >Answer:</label>
                  <div class="col-sm-10">
                     <textarea name="answer" class='form-control' rows="8" placeholder="Enter answer"></textarea>  <br><br>    
                  </div>
               </div>
               <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                     <input type="submit" value="Submit" class="btn btn-primary">
                  </div>
               </div>
            </form>
         </div>
      </div>
      <div class=" bg-4">
         <hr>
         <div class="text-center center-block">
            <h3>PuzzlePedia</h3>
            <h5>Think, Solve, Compete</h5>
            <h5>-Designed & Developed by <a href="https://in.linkedin.com/in/rahul-bagad-b7810bb0"><strong>Rahul Bagad</strong></a></h5>
            <a href="https://www.facebook.com/PuzzlePedia-933560270109874"><i id="social-fb" class="fa fa-facebook-square fa-3x social"></i></a>
            <a href=""><i id="social-tw" class="fa fa-github fa-3x social"></i></a>
            <a href="https://plus.google.com/u/0/114174056107999198883"><i id="social-gp" class="fa fa-google-plus-square fa-3x social"></i></a>
            <a href="mailto:itspuzzlepedia@gmail.com"><i id="social-em" class="fa fa-envelope-square fa-3x social"></i></a>
         </div>
         <center>
            <script type="text/javascript" src="http://widget.supercounters.com/hit.js"></script><script type="text/javascript">sc_hit(1353537,2,5);</script>
         </center>
      </div>
      <?php
         if(loggedin())
         {
         if(isset($_POST['title'])&&isset($_POST['dq'])&&isset($_POST['answer'])) 
         {
           $title=$_POST['title'];$dq=$_POST['dq'];$email=$_SESSION['eid'];$name=$_SESSION['name']; 
           $answer=$_POST['answer'];
         
           if(isset($_FILES['img']))
           { 
             echo "i2";
             $fname = $_FILES['img']['name'];
             $ext = @strtolower(  end ( explode( '.', $fname) ) );
             $ftmp = $_FILES['img']['tmp_name'];
             echo $fname;
           }
           
           if(!empty($title)&&!empty($dq)&&!empty($answer)&&!empty($email))
           {
                 if(!empty($fname))
                 {   
                   echo "i3";
                   $tim = time();
                   $iname = $tim.".".$ext;           
                   $query1 = "INSERT INTO `puzzle`(`title`, `dq`, `answer`, `author`, `email`, `img`,`score`,`level`) VALUES ( ' $title ',' $dq ',' $answer ',' $name','$email','$iname',0,'-')";
                   $path="img/pimg/".$iname;
                   if(move_uploaded_file($ftmp,$path));
                                                       
                 
                 }   
                 else    
                 {
                   echo "i4";
                   $tim = time();
                   $defimg="ni.jpg";
                   $query1 = $query1 = "INSERT INTO `puzzle`(`title`, `dq`, `answer`, `author`, `email`, `img`,`score`,`level`) VALUES ( ' $title ',' $dq ',' $answer ','$name','$email','$defimg',0,'-')";
                 }
               if( $query_run = mysqli_query($con,$query1) )
               { 
                 echo "i5";
                 if(!empty($ftname)&&!empty($isize)) move_uploaded_file($ftname,"/img/pimg/".$iname); else mysql_error();
                 
         ?>
      <script type="text/javascript">
         alert("Puzzle successfully added..");  
      </script>
      <?php
         $to=$email;
         $headers="From: itspuzzlepedia.com";
         $body="Thank you for contributing to puzzle community." ;
         $subject="Puzzle Added";
         mail($to,$subject,$body,$headers);
           
         header( "refresh:0.3; url=practise.php" );
         }
         else
         {echo "i6";
         ?>     
      <script type="text/javascript">
         alert("Sorry an error Ocurred . Try again later");
      </script>
      <?php     
         echo mysqli_error($con);
         header( "refresh:0.3; url=index.php" );
         
         }
         
         } 
         }
         }
         }
         else
         {
         ?>     
      <script type="text/javascript">
         alert("You need to login first");
      </script>
      <?php     
         echo mysqli_error($con);
         header( "refresh:0.3; url=index.php" );
         
         }
         ?>
   </body>
</html>
