<?php
include('login.php');
?>
<html>
    <head>
        <title>ScanX - The SubNet Scanner</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <link href="css/form.css" rel="stylesheet" type="text/css"/>
        <style>
            .jumbotron {
                padding-top: 30px;
                padding-bottom: 10px;
                background-image: url("./images/jumbo.jpeg");
                background-repeat: no-repeat;
                background-size: cover;
                background-position: center;
                margin-bottom: 0px;
                
            }
            body{
                margin-top: 20px;
            }
            .hit-the-floor {
            color: #fff;
            font-size: 12em;
            font-weight: bold;
            font-family: Helvetica;
            text-shadow: 0 1px 0 #ccc, 0 2px 0 #c9c9c9, 0 3px 0 #bbb, 0 4px 0 #b9b9b9, 0 5px 0 #aaa, 0 6px 1px rgba(0,0,0,.1), 0 0 5px rgba(0,0,0,.1), 0 1px 3px rgba(0,0,0,.3), 0 3px 5px rgba(0,0,0,.2), 0 5px 10px rgba(0,0,0,.25), 0 10px 10px rgba(0,0,0,.2), 0 20px 20px rgba(0,0,0,.15);
            }

            .hit-the-floor {
              text-align: center;
            }
            .footer {
                height: 60px;
                margin-bottom: 0px;
                margin: 50px;
                
            }
                

        </style>
    </head>
    <body>
        
        <div class="container text-center center-block">
            <div class="jumbotron">
                <img src=" ./images/logo.png" height="200" width="600">
            </div>    
        </div>
        <div class="container col-md-offset-4">
            <h2> Enter The Credentials </h2>
            <form role="form" class="form form-horizontal" action="" method="POST">
                <div class="row">
                    <div class ="form-group col-md-4">
                        <label for="inputUser" class="control-label col-md-3">Username</label>
                        <div class="col-md-9">
                        <input type="text" class="form-control" id="inputUser" placeholder="User Name" name="user" >
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="inputPassword" class="control-label col-md-3">Password </label>
                        <div class="col-md-9">
                        <input type="password" class="form-control" id="inputPassword" placeholder="Password" name="pass" >
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-4 text-center">
                        <div class="row" >
                            <button type="Submit" class="btn btn-primary">Log In </button>
                        </div>

                </div>
            </form>
        </div>
                <?php 
                if($_SERVER['REQUEST_METHOD']=="POST")
                {
                    echo '<div class=container">
                        <div class="col-md-offset-4">
                        <div class="alert alert-danger col-md-5">
            
                <p><h3>Invalid Credentials
                </h3>
                </p>
                    
            </div>
            </div>
        </div>';
        
                   
                }
                
                ?>
        <div class="footer">
        <div class="container">
            <div class="row col-md-4 pull-right" onclick="window.open('http://www.shivammehta.me')" style=" cursor: pointer;" >
                <div class="alert alert-success text-center">
                Developed by <strong> Shivam Mehta </strong>

                </div>
            </div>
        </div>
        </div>
    </body>
</html>
