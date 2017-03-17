<?php
include("session.php");
include("configdb.php");
if($conn->connect_errno>0)
{
    die("Connection Error" . $conn->connect_error);
}
if($_GET)
{
    

    if($_GET['wholedump'])
    {
        $sql = "SELECT * FROM machines as M,services as S where M.mid = S.mid" ;
    }
    else if ($_GET['latestchange'])
    {
        $sql="select S.updated_on,M.host, S.service,S.state,S.version,S.protocol from 
services as S,machines as M where updated_on = (select updated_on from 
services ORDER BY updated_on DESC limit 1) and M.mid = S.mid;";
    }
    else if ($_GET['monthlyreport'])
    {
        $sql="select M.ip,S.service,S.version,S.banner,S.port,S.protocol from services as
S,machines as M where updated_on = (select updated_on from services ORDER
BY updated_on DESC limit 1) and M.mid = S.mid;";
    }
    else if ($_GET['customsearch'])
    {
        $sql = $_SESSION['sql'];
    }
}
$result  = $conn->query($sql);
$fp = fopen('php://output', 'w');        
if($result->num_rows >0)
{
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="export.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');
    while($row = $result->fetch_assoc())
    {
        fputcsv($fp,$row);
    }
}
fclose($fp);
?>
