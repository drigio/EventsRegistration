<?php
//for testing
$host = 'localhost';
$user = 'drigio';
$pass = 'hello';
$db = 'eventsregister';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

/*//for production
$host = 'localhost';
$user = 'id3364432_drigio';
$pass = 'dastur123';
$db = 'id3364432_eventsregister';
$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);*/
?>
