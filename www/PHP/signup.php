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
$profilepicture = 'http://ideweb2.hh.se/~sigsto14/Herz/public/images/Profilepictures/none.png';
$informationRaw = $_POST['information'];
$information = utf8_encode($informationRaw);


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
	$sql = "INSERT INTO users (username, email, password, profilePicture, information)
VALUES ('{$username}', '{$email}', '{$password}', '{$profilepicture}', '{$information}')";

if (mysqli_query($conn, $sql)) {

$userIDQ = <<<END
SELECT * FROM users
WHERE username = '{$username}'
END;
$userIDG = $mysqli->query($userIDQ);
if($userIDG->num_rows >0){
$userID1 = $userIDG->fetch_object();
$userID = $userID1->userID;
$sql2 = "INSERT INTO channels (channelname, information, userID)
VALUES ('{$username}', '{$information}', '{$userID}')";
	
if (mysqli_query($conn, $sql2)) {
echo 'true';

}	
}
}
else {
    exit(json_encode('fail'));
}
}
	}
}




mysqli_close($conn);
?>