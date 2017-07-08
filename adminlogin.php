<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="puzzlepedia is a website for puzzle lovers wherein they can solve variety of puzzles, practise it and compete with others. Designed and developed by rahul bagad">
    <meta name="author" content="">
    <link rel="icon" href="puz.png">

    <title>PuzzlePedia</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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

</head>
<body>

        <div class="modal-body">
            <form class="form" method="post" action="adminlogin.php">
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
<?php
    require 'connect.inc.php';
    require 'core.inc.php';

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
                      header("Refresh:0; url=evaluate.php");
                  
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



?>
</body>