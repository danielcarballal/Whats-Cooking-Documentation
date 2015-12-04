<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<title>Whats Cooking?</title>
<?php
	if($_POST['name']){
		$username = "whatscoo_site";
		$password = "cookdb411pass/";
		$hostname = "localhost";
		$dbconn = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
		$db = mysql_select_db("whatscoo_maindb",$dbconn) or die("Could not select examples");
		$name = mysql_real_escape_string($_POST['name']);
		$city = mysql_real_escape_string($_POST['city']);
		$YelpID = mysql_real_escape_string($_POST['YelpID']);
		/* We only concern ourselves with the right after /biz/ and before any ? in URL 
		If /biz/ is not there, go ahead and die*/
		$find   = '/biz/';
		$pos = strpos($YelpID, $find);
		if ($pos === false){
			mysql_close($dbconn);
			die('Not a valid URL');
		} else{
			$bizidsubstring = substr($YelpID, $pos, -1);
			$query = "INSERT INTO Restaurants (name, city, YelpID) VALUES ('$name', '$city', '$bizidsubstring')";
			$res = mysql_query($query) or die('error, insert query failed');
			echo "<font color='blue'>Restaurant added</font>"; 
			mysql_close($dbconn);
		}
	}
?>
</head>

<body>
<div class="container">
	<br>
	<a href="results.php"><div class="row btn coolBtn" type="button">Go Back</div></a>
	<h1 class="row">Add a restaurant</h1>
	<br>
	<div class="row">	
		<form class="col-md-7" action="add.php" method="post">
			<span class="row">
				<span class="col-md-3"> Restaurant Name:</span>
				<span class="col-md-9"> <input type="text" name="name" placeholder="Restaurant Name" required></span>
			</span>
			<span class="row">
				<span class="col-md-3"> City:</span>
				<span class="col-md-9"> <input type="text" name="city" placeholder="City" required></span>
			</span>
			<span class="row">
				<span class="col-md-3"> Yelp Link:</span>
				<span class="col-md-9"> <input type="text" name="YelpID" placeholder="Yelp Link" required></span>
			</span>
			<span class="row">
				<button type="submit" class="btn coolBtn" id="submit">Add</button>
			</span>
		</form>
	</div>
</div>
</body>
</html>