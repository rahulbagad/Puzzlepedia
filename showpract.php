<!DOCTYPE html>
<html lang="en">
   <head>
      <title>PuzzlePedia</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Lobster|Righteous|Yellowtail" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Pontano+Sans|Righteous|Yellowtail" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Pontano+Sans|Quattrocento|Righteous|Yellowtail" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <style type="text/css">
         .bg-4 { 
         background-color: #2f2f2f; /* Black Gray */
         color: #fff;
         }
         .b{ 
         background-color: #e6e6e6; /* light grey */
         color: #000000;
         }
         body {
            background-color: #c2d6d6;
            font-family: 'Quattrocento', serif;
        }
         h2{
            font-family: 'Lobster', cursive;
         }
      </style>
   </head>
   <body>
      <?php
         require 'connect.inc.php';
         require 'core.inc.php';
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
                     {?>
                  <li><a data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                  <li><a data-toggle="modal" data-target="#register"><span class="glyphicon glyphicon-edit"></span> Register</a></li>
                  <?php
                     }
                     else
                     {?>
                  <li><a href="add.php">Add Puzzle</a></li>
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
                     
                     
                     }?>
               </ul>
            </div>
         </div>
      </nav>
      <?php
         if(loggedin())
         {
             $val=$_GET['id'];
             if(isset($_GET['id']))
             {
               
               $val=$_GET['id'];$_SESSION['pid']=$_GET['id'];
               $query= "SELECT * FROM `puzzle` where id = $val ";
               if( $query_run = mysqli_query($con,$query) )
               {
                 $result = $con->query($query);  
                 
                 if ($result->num_rows > 0) 
                 {
                     while($row = $result->fetch_assoc())
                     {
                       
                       ?>
      <div class="container">
         <div class="jumbotron">
            <h3><?php echo $row['title'];?></h3>
            <p>Author:<?php echo $row['author'];?></p>
         </div>
         <?php $x=$row['img'];
            if($x!='ni.jpg')
            {?>
         <div class="container">
            <img class="img-responsive" src="img/pimg/<?php echo $row['img']?>" alt="image">
         </div>
         <br><br><br>           <?php
            }
             ?>
         <div class="panel panel-danger">
            <div class="panel-heading">Description And Question</div>
            <div class="panel-body" style="text-align: justify;"><?php echo nl2br($row['dq']);?></div>
         </div>
         <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#answer">Unlock Answer</button>
      </div>
      <?php
         }
         }
         
         
         }
         
         else
         echo "error";
         }
         }
         else
         {
         ?>
      <script type="text/javascript">
         alert("You need to login first...");  
      </script>
      <?php
         header( "refresh:0.3; url=index.php" );
         }
         
         ?>
      <?php
         if(isset($_POST['answer']))
         {
             $val=$_SESSION['pid'];
             $email=$_SESSION['eid'];$answer=$_POST['answer'];
             echo "i1";
             if(isset($_FILES['image']))
             { 
               echo "i2";
               $fname = $_FILES['image']['name'];
               $ext = @strtolower(  end ( explode( '.', $fname) ) );
               $ftmp = $_FILES['image']['tmp_name'];
               echo $fname;
             }
             if(!empty($answer))
             {
                 if(!empty($fname))
                 {   
                   echo "i3";
                   $tim = time();
                   $iname = $tim.".".$ext; 
         
                   $query = "INSERT INTO `answers`( `pid`, `email`, `answer`, `img`) VALUES ( ' ". $val." ', '$email', ' ".$answer." ','".$iname."') ";
                   $path="img/pimg/".$iname;
                   if(move_uploaded_file($ftmp,$path));
                 }
                 else    
                 {
                   echo "i4";
                   $tim = time();
                   $defimg="ni.jpg";
         
                   $query = "INSERT INTO `answers`( `pid`, `email`, `answer`, `img`) VALUES ( ' ". $val." ', '$email', ' ".$answer." ','".$defimg."') ";
                 }
             
         
             if($query_run = mysqli_query($con,$query))
             {
                         if(!empty($ftname)&&!empty($isize)) 
                             move_uploaded_file($ftname,"/img/pimg/".$iname); 
                         else 
                             mysql_error();
                         ?>
      <script type="text/javascript">
         alert("Answer Submitted successfully..");  
      </script>
      <?php
         $to=$email;
         $headers="From: eduolx96@gmail.com";
         $body="TYour answer submitted succcessfully. It will be evaluated at the end of the day and your score will be updated..." ;
         $subject="Answer Submitted";
         mail($to,$subject,$body,$headers);
         header( "refresh:0.3; url=index.php" );
         }
         else
         {
         echo "i6";
         ?>     
      <script type="text/javascript">
         alert("Sorry an error Ocurred . Try again later");
      </script>
      <?php     
         echo mysqli_error($con);
         
         }
         }
         }
         ?>
      <?php
         if(loggedin())
         {
             $val=$_GET['id'];
             if(isset($_GET['id']))
             {
               
               $val=$_GET['id'];$_SESSION['pid']=$_GET['id'];
               $query= "SELECT * FROM `puzzle` where id = $val ";
               if( $query_run = mysqli_query($con,$query) )
               {
                 $result = $con->query($query);  
                 
                 if ($result->num_rows > 0) 
                 {
                     while($row = $result->fetch_assoc())
                     {
                       
                       ?>
      <!-- Modal -->
      <div class="modal fade" id="answer" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Answer</h4>
               </div>
               <div class="modal-body">
                  <?php if($row[img]!='ni.jpg')
                     {
                     ?>
                  <div class="container">
                     <img class="img-responsive" src="img/pimg/<?php echo $row['img']?>" alt="image">
                  </div>
                  <?php
                     }
                     ?>
                  <div class="panel-body"><?php echo $row['answer'];?>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <?php
         }
         }
         }
         }
         }
         ?>
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
   </body>
</html>
