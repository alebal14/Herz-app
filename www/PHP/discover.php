<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$content ='';
$newC = '';
$popC = '';
$popChannel = '';
$counter = 0;
$counterPop = 0;
$counterChanSound = 0;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection

$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");


$counter = 0;
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main.js"></script>';
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
<audio id="audio" preload="none" tabindex="0" controls="" >
  <source src="' . $new->URL . '">
  Your Fallback goes here
</audio></pre>
<ul id="playlist"><br>
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

}
//query för populära podar (de som har flest fav-markeringar)
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
        	$counterPop++;
//max 5 res
        	if($counterPop < 5){
        		$title = utf8_encode($pop->title);
$channelname = utf8_encode($pop->channelname);
        		$popC .='<li id="notActive">
            <a href="' . $pop->URL . '">' . $title . '
            </a><p>Kanal:' . $channelname . '</p>
        </li>';
        	}
        }
}

//query för o hämta populär kanal
$popChanQ = <<<END

SELECT *, COUNT(subscribe.channelID) AS occurances FROM subscribe INNER JOIN channels ON channels.channelID = subscribe.channelID GROUP BY subscribe.channelID ORDER BY occurances DESC LIMIT 1;
END;

//kör query
$popChanG = $mysqli->query($popChanQ);
//kollar resultat
if($popChanG->num_rows >0){
	//hämtar resultaten
$popChan = $popChanG->fetch_object();
//lägger till i popchan
$popChannel = '<h2>' . $popChan->channelname .'</h2><br><p>' . $popChan->information . '<br><h3>Podcasts:</h3><br>';
//gör query i sounds med channelID
$channelID = $popChan->channelID;
$chanSoundsQ = <<<END
SELECT * FROM sounds
WHERE channelID = '{$channelID}'
END;
//Hämtar ljuden
$chanSoundsG = $mysqli->query($chanSoundsQ);
if($chanSoundsG->num_rows >0){
	$chanSounds = $chanSoundsG->fetch_object();
$title = utf8_encode($chanSounds->title);
$desc = utf8_encode($chanSounds->description);
	$popChannel .= '<form class="add2PL" action="" method="POST">
<audio id="audio" preload="none" tabindex="0" controls="" >
  <source src="' . $chanSounds->URL . '">
  Your Fallback goes here
</audio></pre>
<ul id="playlist"><br>
  <li class="active">
            <a href="' . $chanSounds->URL . '">'
            . $title . '
            </a><form id="add2PL" action="" method="POST"><input type="hidden" id="soundID" name="soundID" value="' . $chanSounds->soundID . '">
            <button type="button" class="addTrigger btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $chanSounds->soundID . '"> <p>' . $desc . '</p>
        </li>';

        //while med fler res 
        while($chanSounds = $chanSoundsG->fetch_object()){
        	$counterChanSound++;
        	if($counterChanSound < 5){
$title = utf8_encode($chanSounds->title);
$desc = utf8_encode($chanSounds->description);
        		$popChannel .='<li id="notActive">
            <a href="' . $chanSounds->URL . '">' . $title . '
            </a><button type="button" class="addTrigger btn-success">+</button><input type="hidden" id="soundID" name="soundID" class="soundID" value="' . $chanSounds->soundID . '">
 <p>' . $desc . '</p>       </li>';

        	}
        }
}
}
//läggar i content
$content .= '<button id="openNew" class="plist2" type="submit">Nytt<span class="caret"></span></button><button id="closeNew" class="plist2 hidden" type="submit">Nytt
<span class="caret caret-reversed"></span></button><div id="newBox" class="hidden">' . $newC . '</div>';

$content .= '<button id="openPop" class="plist2" type="submit">Populärt<span class="caret"></span></button><button id="closePop" class="plist2 hidden" type="submit">Populärt
<span class="caret caret-reversed"></span></button><div id="popBox" class="hidden">' . $popC . '</div>';


$content .= '<button id="openPopchan" class="plist2" type="submit">Veckans kanal<span class="caret"></span></button><button id="closePopchan" class="plist2 hidden" type="submit">Veckans kanal
<span class="caret caret-reversed"></span></button><div id="popchanBox" class="hidden">' . $popChannel . '</div>';

echo $content;
}

?>