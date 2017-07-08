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
      <style type="text/css">
         .container1 {
         width: auto;
         max-width: 680px;
         padding: 0 15px;
         }
         .container1 .credit {
         margin: 20px 0;
         }
         #footer {
         height: 60px;
         background-color: #f5f5f5;
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
                  <li class="active"><a href="index.php">Home</a></li>
                  <li><a href="#">Puzzle Mine</a></li>
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
                  <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
                  <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
                  <?php
                     }?>
               </ul>
            </div>
         </div>
      </nav>
      <div class='container'>
         <h2>Enter Puzzle Title & Details:</h2>
         <br><br>
         <div id="small_form">
            <form action="ppap.php" method="post" role="form" enctype="multipart/form-data">
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
                  <div class="form-group">
                     <select class="form-control" id="level" name="level">
                        <label class="control-label col-sm-2" >Select Level:</label>
                        <option>Select Category</option>
                        <option value="Easy">Level 1</option>
                        <option value="Moderate">Level 2</option>
                        <option value="Expert">Level 3</option>
                     </select>
                  </div>
               </div>
               <div class="form-group">
                  <label class="control-label col-sm-2" >Score:</label>
                  <div class="col-sm-10">
                     <input class='form-control' type="text" name="score" required placeholder="Enter score"><br><br>
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
      <?php
         if(isAdmin())
         {
         if(isset($_POST['title'])&&isset($_POST['dq'])&&isset($_POST['score'])&&isset($_POST['level'])) 
         {
           $title=$_POST['title'];$dq=$_POST['dq'];$email='rlbagad2@gmail.com';$name=$_SESSION[ ' name ' ]; 
           $level=$_POST['level'];$score=$_POST['score'];
         
           if(isset($_FILES['img']))
           { 
             echo "i2";
             $fname = $_FILES['img']['name'];
             $ext = @strtolower(  end ( explode( '.', $fname) ) );
             $ftmp = $_FILES['img']['tmp_name'];
             echo $fname;
           }
           
           if(!empty($title)&&!empty($dq)&&!empty($email))
           {
                 if(!empty($fname))
                 {   
                   echo "i3";
                   $tim = time();
                   $iname = $tim.".".$ext;           
                   $query1 = "INSERT INTO `puzzle`(`title`, `dq`, `author`, `email`, `img`,`score`,`level`) VALUES ( ' $title ',' $dq ','asrb','agserb.777@gmail.com','$iname','$score','$level')";
                   $path="img/pimg/".$iname;
                   if(move_uploaded_file($ftmp,$path));
                                                       
                 
                 }   
                 else    
                 {
                   echo "i4";
                   $tim = time();
                   $defimg="ni.jpg";
                   $query1 = $query1 = "INSERT INTO `puzzle`(`title`, `dq`, `author`, `email`, `img`,`score`,`level`) VALUES ( ' $title ',' ".$dq." ',' asrb ','agserb.777@gmail.com','$defimg','$score','$level')";
                 }
               if( $query_run = mysqli_query($con,$query1) )
               { 
                 echo "i5";
                 if(!empty($ftname)&&!empty($isize)) 
                   move_uploaded_file($ftname,"/img/pimg/".$iname); 
                 else 
                   mysql_error();
                 
         ?>
      <script type="text/javascript">
         alert("Puzzle successfully added..");  
      </script>
      <?php
         $query="select * from userinfo";
         $query_run=mysqli_query($con,$query);
         $result = $con->query($query); 
         if($level==='Easy')
           $route='level1.php';
         else if($level==='Moderate')
           $route='level2.php';
         else
           $route='level3.php';
         if ($result->num_rows > 0) 
         {       
            while($row = $result->fetch_assoc())
           {  
               $to=$row['email'];
               $headers="From: itspuzzlepedia@gmail.com";
               $body="New puzzzle has been added\nTitle: ".$title."\nCategory: ".$level."\nPoints: ".$score. "\nvisit: http://puzzlepedia.esy.es/".$route."#bottom\nSee you on Leaderboard :-)" ;
               $subject="New Puzzle Added";
               mail($to,$subject,$body,$headers);
           }
         }
           
         header( "refresh:0;" );
         }
         else
         {echo "i6";
         ?>     
      <script type="text/javascript">
         alert("Sorry an error Ocurred . Try again later");
      </script>
      <?php     
         echo mysqli_error($con);
         
         }
         
         } 
         }
         }
         ?>
   </body>
</html>
