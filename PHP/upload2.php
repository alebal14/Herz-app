<?php
//php för att ladda up info om uppladdad fil till databas

//kopplar till databas
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");


//hämtar variabler
$username = $_POST['username'];
$desc = $_POST['desc'];
$titleRaw = $_POST['title'];
$title = utf8_decode($titleRaw);
$tag = $_POST['tag'];
$links = $_POST['links'];
$categoryID = $_POST['categoryID'];

//skickade med i array från upload 1 bryter ut dem
 $URLS = array_values(explode(',',$links,10));
$audio = $URLS[0];
$image = $URLS[1];



if (!$conn) {
	//om vi ej kommer åt databas
    die("Connection failed: " . mysqli_connect_error());
}


else {
	//kollar inmatningsdata (skickat från uppladdningsphp genom ajax)

	if($audio == 'invalid file'){
//om otillåten fil
		echo '<div class="alert alert-danger">Inga eller otillåtna filer</div>';
	}
	else if($audio == '') {
		//om tom fil
		echo '<div class="alert alert-danger">Ingen eller otillåten ljudfil</div>';
	}
		else if($image == '') {
			//om tom bildinmatning
		echo '<div class="alert alert-danger">Ingen eller otillåten bildfil</div>';
	}
	else {
		//om allt står rätt till
// hämtar ut channelID med hjälp av username
$queryQ =<<<END
SELECT * FROM users
WHERE username = '{$username}'
END;
// kör queryn
$queryG = $mysqli->query($queryQ);
//kollar så det är resultat
if($queryG->num_rows > 0){
	//gör variabel om resultat
	$user = $queryG->fetch_object();
	$userID = $user->userID;
}
else {
	$userID = '';
}
//en query som matar in infon
	$sql = "INSERT INTO sounds (title, description, URL, podpicture, tag, channelID, categoryID)
VALUES ('{$title}', '{$desc}', '{$audio}', '{$image}', '{$tag}', '{$userID}', '{$categoryID}')";

if (mysqli_query($conn, $sql)) {
//om insert gått rätt till
//matar ut resultat

echo '<div class="alert alert-success"><button id="closeUploaded" class="close">X</button><br><h3> Pod uppladdad!</h3><h1>' . utf8_encode($title) .'</h1><br><p>Beskrivning:' . $desc . '<br>Taggar:' . $tag . '</p><br><img src="' . $image . '" style="width:60px; height 40px;" /><audio controls>
<source src="' . $audio . '" type="audio/ogg">
<source src="' . $audio . '" type="audio/mpeg">
Your browser does not support the audio element.
</audio></div>';
	
		
}
else {
	// om det ej gick som tänkt
    exit(json_encode('fail'));
}
}
}







?>