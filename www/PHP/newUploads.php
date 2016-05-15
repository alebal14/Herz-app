<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$counter = 0;
//variabel för att välja playlist
$selectPL = '<select class="listID" id="listID"><option value="default">Välj spellista</option>';

$conn = mysqli_connect($servername, $username, $password, $dbname);


$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");


$ADD = '';
$title = '';
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main2.js"></script>';
$content = '';

$username = $_POST['username'];
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {

//query för att hämta användares spellistor 
$playlistsQ = <<<END
SELECT * FROM playlists
INNER JOIN users
ON users.userID = playlists.userID
WHERE users.username = '{$username}'
END;
//hämta playlists 
$playlistG = $mysqli->query($playlistsQ);
if($playlistG->num_rows > 0){
$playlists = $playlistG->fetch_object();

  $selectPL .= '<option value="' . $playlists->listID . '">' . $playlists->listTitle . '</option>';

  while($playlists = $playlistG->fetch_object()){
$selectPL .= '<option value="' . $playlists->listID . '">' . $playlists->listTitle . '</option>';
  }
  $selectPL .= '</select>';
}

else {
  $selectPL = 'Du har inga spellistor än. Skapa under "Sparade spellistor"';
}




	//query hämta ut nya uppladdningar

	$newQ = <<<END
SELECT * FROM sounds
INNER JOIN channels
ON sounds.channelID = channels.channelID
ORDER BY sounds.created_at DESC
END;
//kör query
$newG = $mysqli->query($newQ);
//kollar om resultat finns 
if($newG->num_rows > 0){
$new = $newG->fetch_object();
//gör utf encode variabel av titeln o kanalnamn
$title = utf8_encode($new->title);
		$channelname = utf8_encode($new->channelname);
//lägger till data i new variabel
$newC = '<div id="searchFBNew"></div>
<audio id="audioNU" class="audio" preload="none" tabindex="0" controls="" >
  <source src="' . $new->URL . '">
  Your Fallback goes here
</audio></pre>
<ul id="playlistNU" cladd="playlist"><br>
  <li class="active">
            <a href="' . $new->URL . '">'
            . $title . '
            </a><p>Kanal:' . $channelname . '</p>
        </li>'. $selectPL . '<button type="button" class="addTriggerNew btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $new->soundID . '">';
//while loop
while($new = $newG->fetch_object()){
	//räknar upp counter
	$counter++;
	//om counter är mindre än 5 vi lägger i mer content
	if($counter < 5){
		$title = utf8_encode($new->title);
		$channelname = utf8_encode($new->channelname);
		$newC .= '<li id="notActive">
            <a href="' . $new->URL . '">' . $title . '
            </a><p>Kanal:' . $channelname . '</p>
        </li>'. $selectPL . '<button type="button" class="addTriggerNew btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $new->soundID . '">';
	}

}
$newC .= '</ul>';
}
else {
	$newC = 'Inga nya uppladdningar';
}
echo $newC;
echo $script;
}

?>