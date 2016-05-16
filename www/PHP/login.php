<?php
//PHP FÖR LOGIN FUNKTION
//SKAPA KONTAKT MED DATABAS
$servername = "localhost";
$username = "sigsto14";
$password = "ZW_6W5CiiC";
$dbname = "sigsto14_db";


$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = new mysqli("localhost","sigsto14","ZW_6W5CiiC","sigsto14_db");

//variabler av inmatning
$username = $_POST['username'];
$password = $_POST['password'];


if (!$conn) {
    //om kontakt ej etableras
    die("Connection failed: " . mysqli_connect_error());
}


else {
//om kontakt
    //om username inmatat
if(isset($_POST['username']))
{
    //kollar mot databas om användarnamnet finns med matchande pw
    $query = <<<END
    SELECT username,password FROM users
    WHERE username = '{$_POST['username']}'
    AND password = '{$_POST['password']}'
END;
//kör query
$res = $mysqli->query($query);
//om resultat finns är man inloggad
    if($res->num_rows > 0)
    {
//om res finns inloggad
echo 'true';
$_SESSION["username"] = $_POST['username'];

    }
    }
    else
    {
      //annars ej (kollar mot fail i ajax)
echo 'fail';
}
    }
//stänger conn

mysqli_close($conn);
?>