<?php
include("session.php");
include("configdb.php");
if($conn->connect_errno)
{
    die("Connection Failed" . $conn->connect_error);
}

$sql = "select M.ip,  S.port,S.service,S.version,S.banner,S.protocol from services as
S,machines as M where updated_on = (select updated_on from services ORDER
BY updated_on DESC limit 1) and M.mid = S.mid;" ;
$result  = $conn->query($sql);
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
<title>Monthly Report</title>
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
            <h2>Monthly Reports are Listed Below</h2>
            <h4>This section shows the Monthly Reports that has been made in the system.</h4>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 ">
                <a href="welcome.php"><span class="pull-right"><button class="btn btn-primary" title="Back to Main Menu" value="Back To Previous Menu" name="Back">Back to Main Menu</button></span></a>
            </div>
            <div class="col-md-6">
                <form action="exporttocsv.php" method="GET">
                    <input type="submit" class="btn btn-primary" name="monthlyreport" value="Export To CSV" />
                </form>
            </div>
        </div>

    </div>
    <div class="container">
        <div class="row">
            <table class="table">
                <thead>
                    <tr class="success">
                        <th>IP</th>
                        <th>Service</th>
                        <th>Version</th>
                        <th>Banner</th>    
                        <th>Port</th>
                        <th>Protocol</th>
                    </tr>
                </thead>
                <?php
                while ($row=$result->fetch_assoc())
                {
                    $ip = $row['ip'];
                    $service= $row['service'];
                    $version = $row['version'];
                    $banner = $row['banner'];
                    $port = $row['port'];
                    $protocol = $row['protocol'];
                    
                
                ?>
                <tbody>
                    <tr class="info">
                        <th><?php echo $ip; ?></th>
                        <td><?php echo $service; ?></td>
                        <td><?php echo $version; ?></td>
                        <td><?php echo $banner; ?></td>
                        <td><?php echo $port; ?></td>
                        <td><?php echo $protocol; ?></td>
                        
                    </tr>
              
            <?php
                }?>
                      </tbody>
            </table>
        </div>
    </div>
    
    
    
</body>
</html>
        
        
        
        
        
        
