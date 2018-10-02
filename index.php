<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="puzzlepedia is a website for puzzle lovers wherein they can solve variety of puzzles, practise it and compete with others. Designed and developed by rahul bagad">
      <meta name="author" content="">
      <link rel="icon" href="puz.png">
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Righteous|Yellowtail" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Pontano+Sans|Righteous|Yellowtail" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Pontano+Sans|Quattrocento|Righteous|Yellowtail" rel="stylesheet">
      <title>PuzzlePedia</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link rel="stylesheet" href="style.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="css/main.css" rel="stylesheet">

      <style>
         .item {
         max-width: 100%;
         -moz-transition: all 0.3s;
         -webkit-transition: all 0.3s;
         transition: all 0.3s;
         }
         .item:hover {
         -moz-transform: scale(1.1);
         -webkit-transform: scale(1.1);
         transform: scale(1.1);
         }
         h2{
            font-family: 'Lobster', cursive;
         }
         body
         {
            font-family: 'Quattrocento', serif;
         }
      </style>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script>
         $(document).ready(function(){
           $("a").on('click', function(event) {
         
             if (this.hash !== "") {
               event.preventDefault();
         
               var hash = this.hash;
               $('html, body').animate({
                 scrollTop: $(hash).offset().top
               }, 800, function(){
            
                 window.location.hash = hash;
               });
             } 
           });
         });
      </script>
   </head>
   <body>
      <?php
         require 'connect.inc.php';
         require 'core.inc.php';
         ?>
      <!-- Navigation -->
      <div id="top">
         <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" >
            <div class="container">
               <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                  <span class="sr-only" style="font-family: 'Yellowtail', cursive;">Puzzlepedia</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="index.php">PuzzlePedia</a>
               </div>
               <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav">
                     <li>
                        <a href="#about">About</a>
                     </li>
                     <li>
                        <a href="#team">Our Team</a>
                     </li>
                     <li>
                        <a href="#toppers">Toppers</a>
                     </li>
                     <li>
                        <a href="#contact">Contact</a>
                     </li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                     <li>
                        <a href="puzzlemine.php">Puzzle Mine</a>
                     </li>
                     <li>
                        <a href="practise.php">Practice</a>
                     </li>
                     <li>
                        <a href="leaderboard.php">Leaderboard</a>
                     </li>
                     <?php if(!loggedin())
                        {?>
                     <li><a data-toggle="modal" data-target="#login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                     <li><a data-toggle="modal" data-target="#register"><span class="glyphicon glyphicon-edit"></span> Register</a></li>
                     <?php
                        }
                        else
                        {?>
                     <li><a href="add.php"><span class=""></span> Add Puzzle</a></li>
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
      </div>
      <header class="header-image">
         <div class="headline">
            <div class="container">
               <h1 style="font-family: 'Righteous', cursive;">PuzzlePedia</h1>
               <h2>Think, Solve, Compete</h2>
               <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#goc">Game of Shares</button>
            </div>
         </div>
      </header>
      <div class="rlp container-fluid text-center bg-4" id="about">
         <div class="container">
            <h2 class="page-header">What is PuzzlePedia?</h2>
         </div>
         <div>
         <h4 font-family: 'Playfair Display';">From simple riddles and puzzles, the site 'PuzzlePedia' has lots of logic, math, and science puzzles to keep your brain on overdrive. You can solve as many puzzles as you want. Solve variety of puzzles every day, score and dominate the leaderboard.</h4>
      </div>
      </div>
      <div class="bg-2 text-center">
         <section id="tsc" >
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <h2 class="page-header">Think, Solve, Compete</h2>
                  </div>
               </div>
               <br><br>
               <div class="row text-center">
                  <?php if(!loggedin())
                     { ?>
                  <div class="col-md-4">
                     <a data-toggle="modal" data-target="#register"><img src="reg.png" class="item" style="width: 17rem; height: 17rem;"></a>
                     <h4 class="heading1">Register</h4>
                  </div>
                  <?php
                     }
                     else
                     { ?>
                  <div class="col-md-4">
                     <a href="practise.php"><img src="pract.png" class="item" style="width: 22rem; height: 17rem;"></a>
                     <h4 class="heading1">Practice</h4>
                  </div>
                  <?php 
                     }
                     ?>
                  <div class="col-md-4">
                     <a href="puzzlemine.php"><img src="puzzle.png" class="item" style="width: 17rem; height: 17rem;"></a>
                     <h4 class="service-heading">Puzzle Mine</h4>
                  </div>
                  <div class="col-md-4">
                     <a href="leaderboard.php"><img src="http://www.freeiconspng.com/uploads/leaderboard-icon-21.png" class="item" style="width: 17rem; height: 17rem;"></a>
                     <h4 class="heading1">Leaderboard</h4>
                  </div>
               </div>
            </div>
         </section>
         <br><br><br>
      </div>
      <div class="bg-4 text-center" id="toppers">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <h2 class="page-header">Top Rankers</h2>
               </div>
            </div>
            <br><br>
            <div class="row text-center">
               <?php
                  $query="select * from userinfo order by score desc limit 3";
                  if( $query_run = mysqli_query($con,$query) )  
                  {  
                     $result = $con->query($query);       
                     if ($result->num_rows > 0) 
                     {
                  
                     while($row = $result->fetch_assoc())
                     {
                  
                      ?>
               <div class="col-md-4">
                  <a href="profile.php?id=<?php echo $row['id'];?>"><img class="img-circle item" class="item" src="img/profile/<?php echo $row['img'];?>" style="width: 17rem; height: 17rem;"></a>
                  <h4 class="heading1"><?php echo $row['name'];?></h4>
                  <div style="padding:10px"><button class="btn btn-primary" type="button">Score <span class="badge"><?php echo $row['score'];?></button></div>
               </div>
               <?php
                  }
                  }
                  }
                  ?>
            </div>
         </div>
         <br><br><br>
      </div>
      <div class="bg-2 text-center">
         <div id="team">
            <div class="container">
               <div class="row">
                  <div class="col-lg-12">
                     <h2 class="page-header">Our Team</h2>
                  </div>
               </div>
               <br><br>
               <div class="row text-center">
                  <div class="col-md-6">
                     <img class="img-circle" class="item" src="puzzlepediaprofile.jpg" style="width: 17rem; height: 17rem;">
                     <h3>Rahul Bagad</h3>
                     <h4>Developer</h4>
                     <h4><a>
                        <span class="glyphicon glyphicon-earphone">7350617969</span>
                        </a>
                     </h4>
                     <a href="http://rahulbagad.me" target="_blank"><i class="fa fa-globe fa-2x social"></i></a>
                     <a href="https://github.com/rahulbagad" target="_blank"><i id="social-tw" class="fa fa-github fa-2x social"></i></a>
                     <a href="https://in.linkedin.com/in/rahulbagad" target="_blank"><i id="social-em" class="fa fa-linkedin-square fa-2x social"></i></a>
                     <a href="https://www.facebook.com/rahul.bagad.908" target="_blank"><i id="social-fb" class="fa fa-facebook-square fa-2x social"></i></a>
                  </div>
                  <div class="col-md-6">
                     <img class="img-circle" src="saurabh.jpg" style="width: 17rem; height: 17rem;">
                     <h3>Saurabh Jamdade</h3>
                     <h4>Content writer</h4>
                     <h4>
                        <a>
                        <span class="glyphicon glyphicon-earphone">7709175197</span>
                        </a>
                     </h4>
                     <a href=""><i id="social-em" class="fa fa-linkedin-square fa-2x social"></i></a>
                     <a href="https://www.facebook.com/profile.php?id=100004613059340"><i id="social-fb" class="fa fa-facebook-square fa-2x social"></i></a>
                     <a href=""><i id="social-tw" class="fa fa-github fa-2x social"></i></a>
                     <a href="mailto:agserb.777@gmail.com"><i id="social-em" class="fa fa-envelope-square fa-2x social"></i></a>
                  </div>
               </div>
            </div>
         </div>
         <br><br><br>
      </div>
      <div class="container">
         <div class="bg-3 rlp text-center" id="contact">
            <div class="row">
               <div class="col-lg-12">
                  <h2 class="page-header">Please,Give us Feedback</h2>
               </div>
               <div class="col-md-6 col-md-offset-3">
                  <div class="well well-sm">
                     <form class="form-horizontal" action="index.php" method="post">
                        <fieldset>
                           <div class="form-group">
                              <label class="col-md-3 control-label" for="name">Name</label>
                              <div class="col-md-9">
                                 <input id="name" name="feedname" type="text" placeholder="Your name" class="form-control" required>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-3 control-label" for="email">Your E-mail</label>
                              <div class="col-md-9">
                                 <input id="email" name="feedemail" type="text" placeholder="Your email" class="form-control" required>
                              </div>
                           </div>
                           <div class="form-group">
                              <label class="col-md-3 control-label" for="message">Your message</label>
                              <div class="col-md-9">
                                 <textarea class="form-control" id="message" name="feedmessage" placeholder="Please enter your message here..." rows="5"></textarea>
                              </div>
                           </div>
                           <div class="form-group">
                              <div class="col-md-12 center">
                                 <button type="submit" class="btn btn-primary btn-md">Submit</button>
                              </div>
                           </div>
                        </fieldset>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <br><br><br>
      </div>
      <div class=" bg-4">
         <hr>
         <div class="text-center center-block">
            <h3>PuzzlePedia</h3>
            <h5>Think, Solve, Compete</h5>
            <h5>-Designed & Developed by <a href="http://rahulbagad.me" target="_blank"><strong>Rahul Bagad</strong></a></h5>
            <a href="https://www.facebook.com/PuzzlePedia-933560270109874"><i id="social-fb" class="fa fa-facebook-square fa-2x social"></i></a>
            <a href=""><i id="social-tw" class="fa fa-github fa-2x social"></i></a>
            <a href="https://plus.google.com/u/0/114174056107999198883"><i id="social-gp" class="fa fa-google-plus-square fa-2x social"></i></a>
            <a href="mailto:itspuzzlepedia@gmail.com"><i id="social-em" class="fa fa-envelope-square fa-2x social"></i></a>
         </div>
         <center>
            <script type="text/javascript" src="http://widget.supercounters.com/hit.js"></script><script type="text/javascript">sc_hit(1353537,2,5);</script>
         </center>
      </div>
      <!-- /.container -->
      <div class="modal fade" id="login" role="dialog">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <center>
                     <h4 class="modal-title">Login</h4>
                  </center>
               </div>
               <div class="modal-body">
                  <form class="form" method="post" action="index.php">
                     <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="lemail" required>
                     </div>
                     <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="lpwd" required>
                     </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <a href="fp.php"><button  class="btn btn-danger">Forgot Passsword</button></a>
                  <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="register" role="dialog">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <center>
                     <h4 class="modal-title">Register</h4>
                  </center>
               </div>
               <div class="modal-body">
                  <form class="form" method="post" action="index.php" enctype="multipart/form-data">
                     <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" required>
                     </div>
                     <div class="form-group">
                        <label for="contact">Contact No (Optional):</label>
                        <input type="text" class="form-control" name="contact">
                     </div>
                     <div class="form-group">
                        <label for="email">Institute/Work Place:</label>
                        <input type="text" class="form-control" name="institute" required>
                     </div>
                     <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="email" required>
                     </div>
                     <div class="form-group">
                        <label for="pwd">Password:</label>
                        <input type="password" class="form-control" name="pwd" required>
                     </div>
                     <div class="form-group">
                        <label for="pic" >Profile pic(optional):</label><br>
                        <input class='form-control' type="file" name="img" ><br><br>
                     </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="goc" role="dialog">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title text-center">Game of Shares</h4>
               </div>
               <div class="modal-body">
                  <center>
                     <p>Want to learn how the share market works?</p>
                     <p>Here's the place wherein you can learn it in easy and playful way.</p>
                     <p>It's <strong>stock market game</strong> where you'll own virtual money.</p>
                     <p>Compete with others and conquer the leaderboard</p>
                  </center>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>
<?php
   if(isset($_POST['feedemail'])&&isset($_POST['feedname'])&&isset($_POST['feedmessage']))
   {
      $feedemail=$_POST['feedemail'];$feedname=$_POST['feedname'];$feedmessage=$_POST['feedmessage'];
      $subject="Feedback/suggestion";
      $message = "Hi, I am ".$feedname."      Message:".$feedmessage." ...";
      $headers="";
      $eid="itspuzzlepedia@gmail.com";
      mail($eid,$subject,$message,$headers);
                       
       ?>
<script type="text/javascript">
   alert("Thank you..");    
</script>
<?php
   header("Refresh:0");
   
   
   }
   ?>
<?php
   if(!loggedin())
   {
   if(isset($_POST['lemail'])&&isset($_POST['lpwd'])) 
   {
   
       
       $eid = trim($_POST['lemail']); $pwd=trim($_POST['lpwd']); 
       
       if(!empty($eid) && !empty($pwd))
       {
       $pwdhash=md5($pwd);
     
       $query = "SELECT * FROM `userinfo` WHERE trim(`email`) = '$eid' AND trim(`password`) = '$pwdhash' ";
       if( $query_run = mysqli_query($con,$query) )  
       {
     
        $result = $con->query($query); 
         
         if ($result->num_rows > 0) 
               {
                while($row = $result->fetch_assoc())
         {
                  
                     $_SESSION['id']=$row['id'];
                     $_SESSION['eid']=$row['email'];
                     $_SESSION['name']=$row['name'];
                     $_SESSION['contact']=$row['contact'];
                     $_SESSION['score']=$row['score'];
                          
   
                     echo mysqli_error($con);
                     ?>
<script type="text/javascript">
   alert("Successfully Logged In..");  
</script>
<?php
   header('Location: puzzlemine.php');
   
   }
   }
   else
   {
   
   ?>
<script type="text/javascript">
   alert("invalid Login Id or Password");
</script>
<?php               
   }           
   
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
   
   ?>
<?php
   if(!loggedin())
   {
   if(isset($_POST['email'])&&isset($_POST['pwd'])&&isset($_POST['name'])&&isset($_POST['institute'])) 
   {
       $eid = $_POST['email']; $pwd=$_POST['pwd']; $name=$_POST['name'];$institute=$_POST['institute'];
       $pwdhash=md5($pwd);
   
       if(isset($_FILES['img']))
       { 
         echo "i2";
         $fname = $_FILES['img']['name'];
         $ext = @strtolower(  end ( explode( '.', $fname) ) );
         $ftmp = $_FILES['img']['tmp_name'];
         echo $fname;
       }
   
   
       if( !empty($eid) && !empty($pwd) && !empty($name)&&!empty($institute))
       {
           $query1= "SELECT email FROM userinfo WHERE trim(email)='".$eid."';";
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
   
     if(!empty($fname))
     {   
       $tim = time();
       $iname = $tim.".".$ext;
   
       if(!empty($_POST['contact']))  
       {
           $mob=$_POST['contact'];
           $query="INSERT INTO `userinfo`( `email`, `password`, `name`, `contact`,`img`,`institute`) VALUES ( ' ". $eid." ', '$pwdhash', ' ".$name." ','".$mob."','".$iname."','".$institute."')    ";
       }
       else
           $query = "INSERT INTO `userinfo`( `email`, `password`, `name`,`img`,`institute`) VALUES ( ' ". $eid." ', '$pwdhash', ' ".$name." ','".$iname."','".$institute."')    ";
       $path="img/profile/".$iname;
       if(move_uploaded_file($ftmp,$path));
                                           
     
     }   
   
     else    
     {
       echo "i4";
       $tim = time();
       if(!empty($_POST['contact']))  
       {
          $mob=$_POST['contact'];
          $query = "INSERT INTO `userinfo`( `email`, `password`, `name`, `contact`,`img`,`institute`) VALUES ( ' ". $eid." ', '$pwdhash', ' ".$name." ','".$mob."','ni.jpg','".$institute."')    ";
       }
       else   
          $query = "INSERT INTO `userinfo`( `email`, `password`, `name`,`img`,`institute`) VALUES ( ' ". $eid." ', '$pwdhash', ' ".$name." ','ni.jpg','".$institute."')    ";
   
       
     }
   
   if( $query_run = mysqli_query($con,$query) )
   {
           $subject="Registration Confirmed";
           $message = "Successfully registered";
           $headers="From: itspuzzlepedia@gmail.com";
           mail($eid,$subject,$message,$headers);
           
           ?>
<script type="text/javascript">
   alert("Registered Successfully..");    
</script>
<?php
   header("Refresh:0");
      
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
   
   ?>
