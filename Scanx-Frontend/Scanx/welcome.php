<?php
include("session.php");
include("configdb.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
<title>Welcome <?php echo $_SESSION['login_user']; ?></title>
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
      margin-bottom: 0px;
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
    
    
    <!-- Nav BAR END -->
    <div class="container">
        <div class="row">
            <div class="jumbotron">
                <h2> <strong> Welcome <font color="red"> <?php echo $_SESSION['login_user']; ?></font> </strong> </h2>
                <h3>Administrator Stats</h3>
                <table class="table">
                    <thead>
                        <tr class="success col-md-4" onclick="window.location.href='./search.php'" style=" cursor: pointer;">
                            <td class="col-md-6">
                                <h4>Total Machines:&nbsp;  </h4>
                            </td>
                            <td>
                                <h4 class="text-right">
                                    <?php
                                    $sql="SELECT count(*) as cnt FROM machines;";
                                    $result= $conn->query($sql);
                                    if($result->num_rows >0)
                                    {
                                        $value = $result->fetch_assoc();
                                        echo " ".$value['cnt'];
                                    }
                                    else
                                    {
                                        echo 0;
                                    }                        


                                    ?>

                                </h4>
                                
                            </td>
                        </tr>
                        <tr class="danger col-md-4" onclick="window.location.href='./latestchanges.php'" style=" cursor: pointer;">
                            <td class="col-md-6" >
                                <h4>Latest Changes: </h4>  
                            </td>
                            <td>
                                <h4 class="text-right">
                                    <?php
                                    $sql="select count(*) as cnt,S.updated_on,M.host, S.service,S.state,S.version,S.protocol from 
services as S,machines as M where updated_on = (select updated_on from 
services ORDER BY updated_on DESC limit 1) and M.mid = S.mid;";
                                    $result= $conn->query($sql);
                                    if($result->num_rows >0)
                                    {   
                                        $value = $result->fetch_assoc();
                                        echo $value['cnt'];
                                    }
                                    else
                                    {
                                        echo 0;
                                    }                        


                                    ?>
                                     

                                </h4>
                            </td>
                            
                            
                            
                        </tr>
                        
                    </thead>
                </table>
              
            </div> 
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12"><h2>Access Admin Functions:</h2>
                <div class="col-md-4">
                    <a href="readdata.php" class="btn-sm btn btn-success btn-block"><h4>Database Dump</h4></a>
                </div>
                <div class="col-md-4">
                    <a href="monthlyreport.php" class="btn-sm btn btn-success btn-block" ><h4>Monthly Report</h4></a>
                </div>      
                <div class="col-md-4">
                    <a href="latestchanges.php" class="btn btn-sm btn-success btn-block"><h4>Latest Changes</h4></a>
                </div>
                <div class="col-md-4" style=" margin-top: 10px;">
                    <a href="addip.php" class="btn btn-sm btn-success btn-block"><h4>Add IP Into Database</h4></a>
                </div>
            </div>
        </div>
    </div>

    

    
</body>
</html>
