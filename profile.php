<!DOCTYPE html>
<html lang="en">
   <head>
      <title>PuzzlePedia</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <link href="https://fonts.googleapis.com/css?family=Bubbler+One" rel="stylesheet">
      <link rel="stylesheet" href="style.css">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Righteous|Yellowtail" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Pontano+Sans|Righteous|Yellowtail" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Lobster|Pontano+Sans|Quattrocento|Righteous|Yellowtail" rel="stylesheet">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <title>amCharts Responsive Example</title>
      <script src="http://www.amcharts.com/lib/3/amcharts.js"></script>
      <script src="http://www.amcharts.com/lib/3/pie.js"></script>
      <script src="../responsive.min.js"></script>
      <style>
         #chartdiv {
         width		: 50%;
         height		: 250px;
         font-size	: 11px;
         padding-bottom	: 30px;
         }	
         .glyphicon {  margin-bottom: 10px;margin-right: 10px;}
         small {
         display: block;
         line-height: 1.428571429;
         color: #999;
         }
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
   <body class="b">
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
                     {
                       ?>
                  <li><a href="add.php"><span class=""></span> Add Puzzle</a></li>
                  <li class="active"><a href="profile.php?id=<?php echo $_SESSION['id'];?>"><span class="glyphicon glyphicon-user" ></span> My Profile</a></li>
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
         $val=$_GET['id'];
         if(isset($_GET['id']))
         {
           
           $val=$_GET['id'];
           $query= "SELECT * FROM `userinfo` where id = $val ";
           if( $query_run = mysqli_query($con,$query) )
           {
             $result = $con->query($query);  
             
             if ($result->num_rows > 0) 
             {
                 while($row = $result->fetch_assoc())
                 {
                   
                   ?>
      <div class="container">
         <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6">
               <div class="well well-sm">
                  <div class="row">
                     <div class="col-sm-6 col-md-4">
                        <img src="img/profile/<?php echo $row[img];?>" alt="" width=150px height= 150px class="img-rounded " />
                     </div>
                     <div class="col-sm-6 col-md-8">
                        <h4><?php echo $row['name'];?></h4>
                        <p>
                           <i class="glyphicon glyphicon-envelope"></i><?php echo $row['email'];?>
                           <br/>
                           <i class="glyphicon glyphicon-phone"></i><?php echo $row['contact'];?>
                           <br/>
                           <i class="fa fa-university"></i><?php echo " ".$row['institute'];?><br/>
                           <i class="glyphicon glyphicon-dashboard"></i><?php echo $row['score'];?>
                           <?php if($val===$_SESSION['id'])
                              {
                                ?><br><a data-toggle="modal" data-target="#edit"><button>EDIT</button></a> 
                           <?php
                              }
                              ?>
                           <br/>
                     </div>
                  </div>
               </div>
            </div>
            <?php
               }
               }
               }
               } 
               $query="select count(status) as cnt from solved where uid='$val' and status=1";
               $result = mysqli_query($con,$query);
               $row=mysqli_fetch_assoc($result);
               $corr=$row['cnt'];
               
               $query="select count(status) as cnt from solved where uid='$val' and status=3";
               $result = mysqli_query($con,$query);
               $row=mysqli_fetch_assoc($result);
               $wrong=$row['cnt'];
               
               
               ?>
            <script>
               var chart = AmCharts.makeChart( "chartdiv", {
                 "type": "pie",
                 "theme": "light",
                 "dataProvider": [ {
               
                   "title": "Correct Submissions",
                   "value": <?php echo $corr; ?>,
	           "color": "#84b761"
                 }, {
                   "title": "Wrong Submissions",
		   "value": <?php echo $wrong; ?>,
		   "color": "#cc4748"
                 } ],
                 "titleField": "title",
                 "valueField": "value",
                 "labelRadius": 5,
               
                 "radius": "42%",
		 "colorField": "color",
                 "innerRadius": "60%",
                 "labelText": "[[title]]",
                 "export": {
                   "enabled": true
                 }
               } );
            </script>
            <div class=" col-xs-12 col-sm-6 col-md-6 " id="chartdiv"></div>
         </div>
         <div>
            <table class="table"><center><h3 style="font-family: 'Bubbler One', sans-serif;">Submissions:</h3></center>
               <thead>
                  <tr>
                     <th>Id</th>
                     <th>Title</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $query= "SELECT * FROM `solved` where uid = $val ";
                     if( $query_run = mysqli_query($con,$query) )
                     {
                       $result = $con->query($query);  
                       $i=1;
                       if ($result->num_rows > 0) 
                       {
                           while($row = $result->fetch_assoc())
                           {
                           $pid=$row['pid'];$status=$row['status'];
                           $pquery="select title from puzzle where id=$pid";
                           $presult = mysqli_query($con,$pquery);
                           $prow=mysqli_fetch_assoc($presult);
                           $ptitle=$prow['title'];
                             
                             ?>
                  <tr>
                     <td><?php echo "#".$i;?></td>
                     <td><a href="showpuzzle.php?id=<?php echo $pid; ?>&status=<?php echo $status; ?>"><?php echo $ptitle;?></a></td>
                     <td><?php if($status==1) { ?> <a href="#" class="btn btn-success btn-lg">
                        <span class="glyphicon glyphicon-ok"></span></a> <?php } else  { ?><a href="#" class="btn btn-danger btn-lg">
                        <span class="glyphicon glyphicon-remove"></span>
                        </a> <?php 
                           } 
                           ?>
                     </td>
                  </tr>
                  <?php
                     $i=$i+1;
                     }
                     
                     
                     }
                     }
                     ?>
               </tbody>
            </table>
         </div>
      </div>
      <?php
         if(isset($_GET['id']))
         {
           
           $val=$_GET['id'];
           $query= "SELECT * FROM `userinfo` where id = $val ";
           if( $query_run = mysqli_query($con,$query) )
           {
             $result = $con->query($query);  
             
             if ($result->num_rows > 0) 
             {
                 while($row = $result->fetch_assoc())
                 {
                   
                   ?>
      <div class="modal fade" id="edit" role="dialog">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <center>
                     <h4 class="modal-title">Edit Profile</h4>
                  </center>
               </div>
               <div class="modal-body">
                  <form class="form" method="post" action="profile.php" enctype="multipart/form-data">
                     <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>">
                     </div>
                     <div class="form-group">
                        <label for="contact">Contact No:</label>
                        <input type="text" class="form-control" name="contact" value="<?php echo $row['contact'];?>">
                     </div>
                     <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="text" class="form-control" name="institute" value="<?php echo $row['institute'];?>">
                     </div>
                     <div class="form-group">
                        <label for="email">Email address:</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $row['email'];?>">
                     </div>
                     <div class="form-group">
                        <label class="control-label col-sm-2" >Profile Pic(Optional)</label>
                        <div class="col-sm-10">
                           <input class='form-control' type="file" name="img" ><br><br>
                        </div>
                     </div>
                     <button type="submit" class="btn btn-success">Submit</button>
                  </form>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <?php
         }
         }
         }
         }
         
         
         if(isset($_POST['email'])&&isset($_POST['name'])&&isset($_POST['institute'])) 
         {
             $eid = $_POST['email'];  $name=$_POST['name']; $institute=$_POST['institute'];
         
         
             if(isset($_FILES['img']))
             { 
               $fname = $_FILES['img']['name'];
               $ext = @strtolower(  end ( explode( '.', $fname) ) );
               $ftmp = $_FILES['img']['tmp_name'];
               echo $fname;
             }
         
         if( !empty($eid)&& !empty($name) )
         {
               if(!empty($fname))
               {   
                 $tim = time();
                 $iname = $tim.".".$ext;
                 $query1= "SELECT email FROM userinfo WHERE email like ' $eid ';";
                 $res=mysqli_query($con,$query1); 
                 if(!empty($_POST['contact']))  
                 {
                      $mob=$_POST['contact'];
                      $query = "update `userinfo` set name='$name',email='$eid',contact='$mob',img='$iname',institute='$institute' where email = '".$_SESSION['eid']."'";
                  }
                  else
                      $query = "update `userinfo` set name='$name',email='$eid',img='$iname',institute='$institute' where email = '".$_SESSION['eid']."'";
                 $path="img/profile/".$iname;
                 if(move_uploaded_file($ftmp,$path));
                                                     
               
               }   
               else    
               {
               
                 $tim = time();
                 if(!empty($_POST['contact']))  
                 {
                      $mob=$_POST['contact'];
                      $query = "update `userinfo` set name='$name',email='$eid',contact='$mob',institute='$institute' where email = '".$_SESSION['eid']."'";
                  }
                  else
                      $query = "update `userinfo` set name='$name',email='$eid',institute='$institute' where email = '".$_SESSION['eid']."'";
         
                 
               }
            if( $query_run = mysqli_query($con,$query) )
             {
                                   if(!empty($ftname)&&!empty($isize)) 
                                       move_uploaded_file($ftname,"/img/profile/".$iname);
                                    else 
                                       mysql_error();
                                   $subject="Profile Update";
                                   $message = "Profile Updated successfully";
                                   mail($eid,$subject,$message,$headers);
                                   ?>
      <script type="text/javascript">
         alert("Profile Updated..");
         
      </script>
      <?php
         $s=$_SESSION['id'];
         header("refresh:0.3; url=profile.php?id=$s");
            
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
         
         
         
         ?>  
      <br><br><br><br><br><br><br><br>
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
