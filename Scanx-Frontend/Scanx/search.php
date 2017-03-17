<?php
include 'session.php';
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
            Custom Search
        </title>
        <script src="js/jquery-1.12.4.min.js" type="text/javascript"></script>
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
                    <li><a href="welcome.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li class="active"><a href="search.php"><span class="glyphicon glyphicon-search"></span> Custom Search</a> </li>
                </ul>
                <ul class="nav navbar-right navbar-nav">
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="jumbotron">
                <div class="row">
                    <h2>Search the Database:</h2>
                    <form class="form-inline" role="search" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="GET" >
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
                                <label class="sr-only" for="search">Search</label>
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search" >
                            </div>
                            <div class="form-group" >
                                <label for="options" class="sr-only" >Option</label>
                                <select class="form-control btn-primary" id="options" name="options">
                                    <option value="ip">IP </option>
                                    <option value="mid">MID </option>
                                    <option value="os">OS</option>
                                    <option value="created_on">Creation Date</option>
                                    <option value="service">Service</option>
                                    <option value="state">State</option>
                                    <option value="port">Port</option>
                                    <option value="version">Version</option>
                                    <option value="Banner">Banner</option>
                                    <option value="updated_on">Update Date</option>
                                    
                                </select> 
                            </div>
                            <input type="submit" class="btn btn-success" value="Search">
                    </form>
                </div>
            </div>
        
<?php        
    if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['search']))
    {
        $search_string = $_GET['search'];
        $search_option = $_GET['options'];
        switch ($search_option) {
            case 'ip':
                $optsr="IP Address";
                break; 
            case "mid":
                $optsr="Machine ID";
                break;
            case "os":
                $optsr="Operating System";
                break;
            case "created_on":
                $optsr="Creation Date";
                break;
            case "service":
                $optsr="Service";
                break;
            case "state":
                $optsr="State";
                break;
            case "port":
                $optsr="Port";
                break;
            case "version":
                $optsr="Version";
                break;
            case "banner":
                $optsr="Banner";
                break;
            case "updated_on":
                $optsr= "Update Date";
                break;

            default:
                $optsr="IP Adress";
                break;
        }
        echo "<p> Search for :$search_string in  $optsr <br>" ;
        
        $sql="SELECT * FROM machines as M,services as S where M.mid = S.mid and $search_option LIKE '%$search_string%' ";
        $result = $conn->query($sql);
        $_SESSION['sql']=$sql;
        echo $_SESSION['sql'];
    }
    ?>
        </div>

        
            <div class="container">
                <div class="row">
                    <div class="col-md-6 ">
                        <a href="welcome.php"><span class="pull-right"><button class="btn btn-primary" title="Back to Previous Menu" value="Back To Previous Menu" name="Back">Back to Main Menu</button></span></a>
                    </div>
                    <div class="col-md-6">
                        <form action="exporttocsv.php" method="GET">
                            <input type="submit" class="btn btn-primary" name="customsearch" value="Export To CSV" />
                        </form>
                    </div>
                </div>

            </div>

        <div class="container">
            <div class="row">
                <table class="table">

                    <thead>
                        <tr class="success">
                            <th>Mid</th>
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
                else{
                    echo "<h3>No Results Found </h3>";
                }

                ?>
                    </tbody>
                </table> 
            </div>
        </div>

    </body>
</html>
