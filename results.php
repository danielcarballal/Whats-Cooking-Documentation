<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<meta content="utf-8" http-equiv="encoding">

<title>What's Cooking?</title>
</head>
<html>
<div class="container">
	<br>
	<a href="index.php"><div class="row btn coolBtn" type="button">Go Back</div></a>
	<h1 class="row">Welcome to What's Cooking</h1>
	<p class="row">Here are some restaurants that match your query</p>
	<table class="row table" style="width:60%">
	<tr>
	  	<th>Restaurant</th>
	  	<th>Location</th>
	  	<th></th>
	</tr>
<?php
$username = "whatscoo_site";
$password = "cookdb411pass/";
$hostname = "localhost";
$name = $_GET["query"];
$dbconn = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");

$db = mysql_select_db("whatscoo_maindb",$dbconn) or die("Could not select examples");

$result = mysql_query("SELECT * FROM Restaurants WHERE name LIKE '%$name%' ORDER BY name ASC");
while ($row = mysql_fetch_assoc($result)) {
    $format = '<tr>
	  	<td><a href="returnResults.php?id=%s&query=%s">%s</a></td>
	  	<td>%s</td>
		<td>
			<a href="edit.php?id=%s&query=%s"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>&nbsp
			<a href="delete.php?id=%s"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a>
		</td>
		</tr>';
    $table_result = sprintf($format, $row['YelpID'], $name, $row['name'], $row['city'],  $name, $row['YelpID'], $row['YelpID']);
    echo $table_result;
}
?>
	</table>
	<p>Don't see the restaurant you're looking for?</p>
	<a href="add.php"><div class="row btn coolBtn" type="button">Add a Restaurant</div></a>
	
</div>
</html>
