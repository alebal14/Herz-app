<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main3.js"></script>';
$counter = 0;
$popC = '';
$playlists = '';
$selectPL = '<select class="listID" id="listID"><option value="default">Välj spellista</option>';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");
$username = $_POST['username'];
//variabler som ska fylas på
$ADD = '';
$title = '';

$content = '';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {

//hämta spellistor för att kunna lägga till populära klipp i dem

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

    //query för hämta populära klipp

$popQ = <<<END
SELECT * FROM favorites
INNER JOIN sounds
ON favorites.soundID = sounds.soundID
INNER JOIN channels
ON channels.channelID = sounds.channelID
GROUP BY sounds.title
ORDER BY count(sounds.title) DESC
END;
//kör query
$popG = $mysqli->query($popQ);
//kollar om finns
if($popG->num_rows >0){
	//hämtar
	$pop = $popG->fetch_object();
	//gör variabler
$title = utf8_encode($pop->title);
$channelname = utf8_encode($pop->channelname);
//första resultat aktivt
	$popC = '<div id="searchFBP"></div>
<audio id="audioP" preload="none" tabindex="0" controls="" >
  <source src="' . $pop->URL . '">
  Your Fallback goes here
</audio></pre>
<ul id="playlistP"><br>
  <li class="active">
            <a href="' . $pop->URL . '">'
            . $title . '
            </a><p>Kanal:' . $channelname . '</p>
        </li>'. $selectPL . '<button type="button" class="addTriggerP btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $pop->soundID . '">';
//andra resultat i loop
        while($pop = $popG->fetch_object()){
        	$counter++;
//max 5 res
        	if($counter < 5){
        		$title = utf8_encode($pop->title);
$channelname = utf8_encode($pop->channelname);
        		$popC .='<li id="notActive">
            <a href="' . $pop->URL . '">' . $title . '
            </a><p>Kanal:' . $channelname . '</p>
        </li>'. $selectPL . '<button type="button" class="addTriggerP btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $pop->soundID . '">';
        	}
        }

}
else {
	$popC = 'Finns inga populära podcasts';
}
echo $popC;
echo $script;
}

?>