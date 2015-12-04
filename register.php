<?php

$username = "whatscoo_site";
$password = "cookdb411pass/";
$hostname = "localhost";

$dbconn = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");

$db = mysql_select_db("whatscoo_maindb",$dbconn) or die("Could not select examples");

$name = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$passCheck = $_POST['passCheck'];
$passEnc = crypt($pass);

if($pass != $passCheck) exit;

$query = mysql_query("INSERT INTO Users (email, password, username, sweet, spicy, garlicky, uniqueness, savoury, vegetarian ) VALUES ('$email', '$passEnc', '$name', 2.5, 2.5, 2.5, 2.5, 2.5, .5)") or die("Email already exists");

setcookie("currentUser", $email, time() + (86400 * 30), "/");

mysql_close($dbconn);

header( 'Location: index.php' ) ;
?>