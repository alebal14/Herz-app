<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$counter = 0;


$conn = mysqli_connect($servername, $username, $password, $dbname);


$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");


$ADD = '';
$title = '';
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main2.js"></script>';
$content = '';
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {
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
$newC = '
<audio id="audioNU" class="audio" preload="none" tabindex="0" controls="" >
  <source src="' . $new->URL . '">
  Your Fallback goes here
</audio></pre>
<ul id="playlistNU" cladd="playlist"><br>
  <li class="active">
            <a href="' . $new->URL . '">'
            . $title . '
            </a><p>Kanal:' . $channelname . '</p>
        </li>';
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
        </li>';
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