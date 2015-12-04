<?php

$username = "whatscoo_site";
$password = "cookdb411pass/";
$hostname = "localhost";

$dbconn = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");

$db = mysql_select_db("whatscoo_maindb",$dbconn) or die("Could not select examples");

$email = $_POST['email'];
$pass = $_POST['pass'];

$query = mysql_query("SELECT password FROM Users WHERE email = '$email'");
$res = mysql_fetch_assoc($query);

if(crypt($pass, $res['password']) == $res['password']) {
setcookie("currentUser", $email, time() + (86400 * 30), "/");
header( 'Location: index.php' ) ;
}
else {
echo "Login failed";
header( 'Location: login.html' ) ;
}

mysql_close($dbconn);
?>