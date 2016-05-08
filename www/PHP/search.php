<?php
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";
$content = '<h1>Sökresultat:</h1><button type="submit" class="close" id="closeSearch">X</button>';

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
$script = '<script type="text/javascript" src="http://ideweb2.hh.se/~sigsto14/Test/js/main.js"></script>';
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");


$search = $_POST['search'];

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


else {
// kollar efter klipp som matchar sökningen i databasen
$searchQ = <<<END
SELECT * FROM  sounds WHERE
soundID = '{$search}' OR
title LIKE '%{$search}%'
END;
// hämtar
$searchG = $mysqli->query($searchQ);
$nr = mysqli_num_rows($searchG);
if($searchG->num_rows >0){
    $row = $searchG->fetch_object(); 
$channelIDS = $row->channelID;
$channelIDQ = <<<END
SELECT * FROM channels
WHERE channelID = '{$channelIDS}'
END;
$channelIDG = $mysqli->query($channelIDQ);
$channel = $channelIDG->fetch_object();
$channelname = utf8_encode($channel->channelname);
  $title = utf8_encode($row->title);
    $content .= '
<audio id="audio" preload="auto" tabindex="0" controls="" >
  <source src="' . $row->URL . '">
  Your Fallback goes here
</audio></pre>
<ul id="playlist"><br>
  <li class="active">
            <a href="' . $row->URL . '">'
            . $title . '
            </a><p>Kanal:' . $channelname . '</p>
        </li>';
while($row = $searchG->fetch_object()){
  $channelIDS = $row->channelID;
$channelIDQ = <<<END
SELECT * FROM channels
WHERE channelID = '{$channelIDS}'
END;
$channelIDG = $mysqli->query($channelIDQ);
$channel = $channelIDG->fetch_object();
$channelname = utf8_encode($channel->channelname);
  $title = utf8_encode($row->title);
  $content .= '<li id="notActive">
            <a href="' . $row->URL . '">' . $title . '
            </a><p>Kanal:' . $channelname . '</p>
        </li>';
}

}
else {
  echo '<h3 style="color:red;">Inga klipp matchade din sökning</h3><button type="submit" class="close" id="closeSearch">X</button>';
  }

echo $script;
$content .= '</ul>';
echo $content;


}
?>