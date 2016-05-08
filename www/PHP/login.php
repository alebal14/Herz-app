<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$response = array();
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");
$username = $_POST['username'];
$password = $_POST['password'];


$user = array();
   session_start();

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {

if(isset($_POST['username']))
{
    $query = <<<END
    SELECT username,password FROM users
    WHERE username = '{$_POST['username']}'
    AND password = '{$_POST['password']}'
END;
$res = $mysqli->query($query);
    if($res->num_rows > 0)
    {

       
echo 'true';
$_SESSION["username"] = $_POST['username'];

    }
    }
    else
    {
        /*om användarnamn inte är upptaget */
echo 'fail';
}
    }


mysqli_close($conn);
?>