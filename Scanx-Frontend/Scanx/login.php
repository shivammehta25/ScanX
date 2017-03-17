<?php
include("config.php");
session_start();
if ($conn->connect_error)
{
    die("Conenction Failed: ".$conn->connect_error);
}
$myuser= htmlentities($_POST['user']);
$myPass = htmlentities($_POST['pass']);
$sql = "select Uname,Pass from admin;";
$result = $conn->query($sql);
if ($result->num_rows > 0)
{
    while($row= $result->fetch_assoc())
    {
        $dbuser = $row['Uname'];
        $dbpass = $row['Pass'];
        if(isset($myuser) AND isset($myPass))
        {

    
            if ($dbuser == $myuser and $dbpass== $myPass)
            {
                echo 'Login Successful';
                $_SESSION['login_user'] = $myuser;
                header("location: welcome.php");
            }
         }
    }
}

$conn->close();

?>

