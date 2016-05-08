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
$email = $_POST['email'];
$password = $_POST['password'];
$profilepicture = 'http://ideweb2.hh.se/~sigsto14/Test/pictures/picture.png';




if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {


	if(isset($_POST['username']))
{
	$query = <<<END
	SELECT username FROM users
	WHERE username = '{$_POST['username']}'

END;
$res = $mysqli->query($query);
	if($res->num_rows > 0)
	{
echo 'false';

	}
	else
	{
	$sql = "INSERT INTO users (username, email, password, profilePicture)
VALUES ('{$username}', '{$email}', '{$password}', '{$profilepicture}')";

if (mysqli_query($conn, $sql)) {
   session_start();

echo 'true';
$_SESSION["username"] = $username;
	
		
}
else {
    exit(json_encode('fail'));
}
}
	}
}




mysqli_close($conn);
?>