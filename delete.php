<?php
   $id = $_GET["id"];
   $username = "whatscoo_site";
   $password = "cookdb411pass/";
   $hostname = "localhost";
   $dbconn = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
   $db = mysql_select_db("whatscoo_maindb",$dbconn) or die("Could not select examples");
   $success = mysql_query("DELETE FROM Restaurants WHERE YelpID='$id'");
   mysql_close($dbconn);
   header( 'Location: index.php' ) ;
?>