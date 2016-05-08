<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main.js"></script>';
$counter = 0;
$popC = '';
$playlists = '';
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");


$ADD = '';
$title = '';
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main.js"></script>';
$content = '';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {
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
	$popC = '
<audio id="audio" preload="none" tabindex="0" controls="" >
  <source src="' . $pop->URL . '">
  Your Fallback goes here
</audio></pre>
<ul id="playlist"><br>
  <li class="active">
            <a href="' . $pop->URL . '">'
            . $title . '
            </a><p>Kanal:' . $channelname . '</p>
        </li>';
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
        </li>';
        	}
        }

}
else {
	$popC = 'Finnsa inga populära podcasts';
}
echo $popC;
echo $script;
}

?>