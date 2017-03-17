<?php
include("session.php");
include("configdb.php");
if($conn->connect_errno)
{
    die("Connection Failed" . $conn->connect_error);
}

$sql = "select S.updated_on,M.ip, S.service,S.state,S.version,S.protocol from
services as S,machines as M where updated_on = (select updated_on from
services ORDER BY updated_on DESC limit 1) and M.mid = S.mid;" ;
$result  = $conn->query($sql);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
<title>Latest Changes</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<style type="text/css">
    body{
        min-height: 200ps;
        padding-top: 70px;
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
            <h2>Latest Changes are Listed Below</h2>
            <h4>This section shows the latest changes that has been made in the system.</h4>
        </div>
    </div>
      <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <a href="welcome.php"><span class="pull-right"><button class="btn btn-primary" title="Back to Main Menu" value="Back To Previous Menu" name="Back">Back to Main Menu</button></span></a>
            </div>
            <div class="col-md-6">
                <form action="exporttocsv.php" method="GET">
                    <input type="submit" class="btn btn-primary" name="latestchange" value="Export To CSV" />
                </form>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr class="success">
                        <th>Updated On</th>
                        <th>IP</th>
                        <th>Service</th>
                        <th>State</th>
                        <th>Version</th>    
                        <th>Protocol</th>
                    </tr>
                </thead>
                <?php
                while ($row=$result->fetch_assoc())
                {
                    $updated_on = $row['updated_on'];
                    $ip = $row['ip'];
                    $service= $row['service'];
                    $state=$row['state'];
                    $version = $row['version'];
                    $protocol = $row['protocol'];
                    
                
                ?>
                <tbody>
                    <tr class="info">
                        <td><?php echo $updated_on; ?></td>
                        <th ><?php echo $ip; ?></th>
                        <td><?php echo $service; ?></td>
                        <td><?php echo $state; ?></td>
                        <td><?php echo $version; ?></td>
                        <td><?php echo $protocol; ?></td>
                        
                    </tr>
                <?php
                } ?>
                </tbody>
            </table>
        </div>
    </div>   
    
</body>
</html>
        
        
        
        
        
        
