<?php
include("session.php");
include("configdb.php");

$conn = new mysqli("localhost","root","toor","IPADDR") or Die("Error connecting to DB");

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $ip_post = $_POST['ip'];
    $sql= "insert into IP (ip) values('$ip_post');";
    if($conn->query($sql)){
        $noerror = 1;
    }
    else{
        $noerror = 2;
    }
    
    
    
}




?>

    

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
<title>Add IP To Database</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<style type="text/css">
    body{
        min-height: 200ps;
        padding-top: 70px;
  }
  .jumbotron{
      padding-top: 5px;
      padding-bottom: 5px;
      margin-bottom: 20px;
  } 
</style>
</head>
<body>
    <nav class="navbar navbar-inverse navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    Scanx                    
                </a>
                
            </div>
            <ul class="nav navbar-nav">
                <li><a href="welcome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Custom Search</a> </li>
            </ul>
            <ul class="nav navbar-right navbar-nav">
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="jumbotron">
            <h2>Add IP to the Scan Pool!</h2>
                <form class="form-inline" role="search" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" >
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-plus-sign"></span></span>
                        <label class="sr-only" for="search">Search</label>
                        <input type="text" class="form-control" id="search" name="ip" placeholder="IP Address" >
                    </div>
                    <input type='submit' class="btn btn-primary" name="add" value="Add">
                </div>
            </form>
            <?php
            if ($noerror ==1)
            { ?>
                
            <h3 class=" success"> <strong> IP Address </strong> Added Successfully </h3>
            
            <?php
                
            }
            else if ($noerror ==2 )
            {
               ?>
            <h3 class=" danger"> Some <strong>Error </strong>Occurred  <?php echo $conn->error; ?></h3>
            <?php 
            }
            ?>
            
            
            </div>
        <div class="row col-md-4">
            <table class="table">
                <thead>
                <th class="info">IP Address</th>
                </thead>
                
                <tbody>
                    
            <?php 
                $sql = "select ip from IP";
                $result = $conn->query($sql);

                if($result->num_rows>0)
                {
                        while($row = $result->fetch_assoc())
                        {
                            $ip = $row['ip'];
                            ?>
                    <tr class="success">    
                            <td><?php echo $ip;?></td>
                        </tr>
            <?php
                            
                            
                        }

                }   

            
                ?>      
                </tbody>
                
                </table>
        
        </div>
    </div>
    
    
    
