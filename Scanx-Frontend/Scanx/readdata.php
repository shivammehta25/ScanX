<?php
include 'configdb.php';
if($conn->connect_errno)
{
    die("Connection Failed" . $conn->connect_error);
}

$sql = "SELECT * FROM machines as M,services as S where M.mid = S.mid" ;
$result  = $conn->query($sql);
?>
<html>
    <head>
        <title>
           	All Dump
        </title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <style type="text/css">
            body {
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
                    <li class="active"><a href="welcome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li><a href="search.php"><span class="glyphicon glyphicon-search"></span> Custom Search</a> </li>
                </ul>
                <ul class="nav navbar-right navbar-nav">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="jumbotron">
                <div class="row">
                    <h2>Database Dump:</h2>
                    <h4>The Dump of the Database can be accessed here:</h4>
                </div>
            </div>
        </div>
        
        
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ">
                        <a href="welcome.php"><span class="pull-right"><button class="btn btn-primary" title="Back to Previous Menu" value="Back To Previous Menu" name="Back">Back to Main Menu</button></span></a>
                    </div>
                    <div class="col-md-6">
                        <form action="exporttocsv.php" method="GET">
                            <input type="submit" class="btn btn-primary" name="wholedump" value="Export To CSV" />
                        </form>
                    </div>
                </div>

            </div>

        <div class="container">
            <div class="row">
                <table class="table">

                    <thead>
                        <tr class="success">
                            <th>Mid
                            <th>IP </th>
                            <th>OS </th>
                            <th>Created On </th>
                            <th>Service</th>
                            <th>State</th>
                            <th>Port</th>
                            <th>Banner</th>
                            <th>Updated On</th>
                        </tr>
                    </thead>                    
                <?php
                if($result->num_rows >0)
                {
                    while($row = $result->fetch_assoc())
                    {
                            $mid = $row['mid'];
                            $ip = $row['ip'];
                            $os = $row['os'];
                            $created_on = $row['created_on'];
                            $service = $row['service'];
                            $state = $row['state'];
                            $port= $row['port'];
                            $banner = $row['banner'];
                            $updated_on =$row['updated_on'];

                ?>

                    <tbody>
                        <tr class="info">
                            <td><?php echo $mid; ?></td>
                            <th> <?php echo $ip;?></th>
                            <td><?php echo $os; ?></td>
                            <td><?php echo $created_on; ?></td>
                            <td><?php echo $service; ?></td>
                            <td><?php echo $state; ?></td>
                            <td><?php echo $port; ?></td>
                            <td><?php echo $banner; ?></td>
                            <td><?php echo $updated_on; ?></td>
                        </tr>

                <?php
                    }
                }

                ?>
                    </tbody>
                </table> 
            </div>
        </div>

    </body>
</html>
