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
         if(isAdmin())
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
                  <li class="active"><a href="index.php">Home</a></li>
                  <li><a href="index">Puzzle Mine</a></li>
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
                  <li><a href="myprofile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
                  <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Logout</a></li>
                  <?php
                     }?>
               </ul>
            </div>
         </div>
      </nav>
      <?php 
         $query="select * from answers";
         if( $query_run = mysqli_query($con,$query) )  
         {
         
         $result = $con->query($query);  
         
           
         if ($result->num_rows > 0) 
         {
         while($row = $result->fetch_assoc())
         {
         
             $query2="select * from puzzle where id='".$row[pid]."'";
             $result2 = mysqli_query($con,$query2);
             $row2=mysqli_fetch_assoc($result2);
         
             $query3="select * from userinfo where trim(id)='".$row['uid']."'";
             $result3 = mysqli_query($con,$query3);
             $row3=mysqli_fetch_assoc($result3);
         
             $query4="select * from solved where trim(uid)='".$row['uid']."' and trim(pid)='".$row['pid']."'";
             $result4 = mysqli_query($con,$query4);
             $row4=mysqli_fetch_assoc($result4);
           
             if($row4['status']!=1)
             {
             ?>
      <div class="col-sm-12">
         <div class="panel panel-success" id="submission">
            <div class="panel-heading">
               <h4>
               <?php echo $row2['title'];?>
               <h4>
               <br>
               <h5>
               Solution by <?php echo $row3['name'];?> 
            </div>
            <br>
            <div class="panel-heading">
               <h4>Qusetion</h4>
            </div>
            <?php if($row[img]!='ni.jpg')
               {
               ?>
            <div class="container">
               <img class="img-responsive" src="img/pimg/<?php echo $row2['img'];?>" alt="image">
            </div>
            <?php
               }
               ?>
            <div class="panel-body"><?php echo $row2['dq'];?></div>
            <div class="panel-heading panel-success">
               <h4>Contestant Answer</h4>
               <?php if($row[img]!='ni.jpg')
                  {
                  ?>
               <div class="container">
                  <img class="img-responsive" src="img/panswers/<?php echo $row['img']?>" alt="image">
               </div>
               <?php
                  }
                  ?>
            </div>
            <div class="panel-body"><?php echo $row['answer'];?>
            </div>
            <a href="updatescore.php?uid= <?php echo $row['uid'];?>&score=<?php echo $row2['score'];?>&pid=<?php echo $row['pid'];?>" ><button type="submit" class="btn btn-primary btn-md" 
               name="score">+<?php echo $row2['score'];?></button></a>
            <a href="del.php?uid= <?php echo $row['uid'];?>&pid=<?php echo $row['pid'];?>" ><button type="submit" class="btn btn-primary btn-md" 
               name="score">Reject</button></a>
         </div>
      </div>
      </div>
      <?php
         }
         ?>
      <?php 
         } 
         }
         } 
         
         }
         
         ?>
      </div>
      </div>
   </body>
</html>
