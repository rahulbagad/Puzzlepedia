<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PuzzlePedia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="css/f2.css" rel="stylesheet">

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
                    <span class="sr-only">Puzzlepedia</span>
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
                        <a href="practise.php">Practise</a>
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
                 
                   echo $row['score'];?></span></button></li>
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
			<div class="back"><br><br><br><br><br><br><br><br><br><br><br>
                        <div class="container">
                        <div class="container" > 
                        <div class="row"> 
                        <div class="col-sm-6 col-md-6 col-md-offset-3"> 
                        <div class="panel panel-primary">
                        <div class="panel panel-body">


<?php
	if(isset($_GET['eid'])&&isset($_GET['fpcode'])&&isset($_POST['pwd']))
	{
		        $eid=$_GET['eid'];$fpcode=$_GET['fpcode'];$pwd=$_POST['pwd'];
		        if(!empty($pwd)&&!empty($fpcode)&&!empty($eid))
                        {
		            $pwdhash = md5($pwd);
                           
			    $query="SELECT  `fpcode` FROM `userinfo` WHERE  `email` ='".$eid."'  ";
		
			if( $query_run = mysqli_query($con,$query) )	
			{
                                      
					$result = $con->query($query);	
					if ($result->num_rows > 0) 
					{ 
							while($row = $result->fetch_assoc())
							{ 
									$code=$row['fpcode']	;
									if($code===$fpcode)
									{ 
										$query1="UPDATE `userinfo` SET `password`='".$pwdhash."' WHERE `email` = '".$eid."' ";
										if(mysqli_query($con,$query1))
                                                                                {

											?>
					                                                  <script type="text/javascript">
					                                                    alert("Password changed successfully..");
						
					                                                 </script>
					                                               <?php
				                                                          header( "refresh:0.3; url=index.php" );
                                                                                 }
										else
											echo "error";
									}
							}
					}
			}
                        }


	}


?>

<form action="fpaction.php?eid=<?php echo $_GET['eid'];?>&fpcode=<?php echo $_GET['fpcode'];?>" method="post" >
  <div class="form-group">
      <label for="pwd">Type your new Password:</label>
      <input type="password" class="form-control" id="pwd" name="pwd"  >
 </div>
 <button type="submit" class="btn btn-primary">Submit</button>
</form>
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

<center><script type="text/javascript" src="http://widget.supercounters.com/hit.js"></script><script type="text/javascript">sc_hit(1353537,2,5);</script>
</center>

</div>
				