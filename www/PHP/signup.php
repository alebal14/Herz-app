<?php
//php fil för registering

//koppla till databas
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

//variabler
//inmatat
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
//default länk till profile pic
$profilepicture = 'http://ideweb2.hh.se/~sigsto14/Herz/public/images/Profilepictures/none.png';
//inmatad info
$informationRaw = $_POST['information'];
//encodar den
$information = utf8_encode($informationRaw);


if (!$conn) {
	//om ej kopplad till databas
    die("Connection failed: " . mysqli_connect_error());
}


else {
//om vi kopplas till databas

	if(isset($_POST['username']))
{
	// om username inmatat

	//kollar om username redan finns
	$query = <<<END
	SELECT username FROM users
	WHERE username = '{$_POST['username']}'

END;
$res = $mysqli->query($query);
	if($res->num_rows > 0)
	{
				//om användarnamn finns kan man ej registrera sig för användarnamnet är upptaget
echo 'false';

	}
	else
	{
		//om användarnamn inte är upptaget
		//lägg in i databas
	$sql = "INSERT INTO users (username, email, password, profilePicture, information)
VALUES ('{$username}', '{$email}', '{$password}', '{$profilepicture}', '{$information}')";

if (mysqli_query($conn, $sql)) {
//om insert lyckades
	//hämta ut nya användarens info
	//lägg in det i channel också
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