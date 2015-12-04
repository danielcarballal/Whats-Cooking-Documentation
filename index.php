<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<title>Whats Cooking?</title>
</head>

<html>
<div class="container">
	<div class="row">
		<h1 class="col-md-10"> Welcome to What is Cooking</h1>
		<div class="col-md-2" style="float:right">
		<br>
<?php
$username = "whatscoo_site";
$password = "cookdb411pass/";
$hostname = "localhost";

$dbconn = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");

$db = mysql_select_db("whatscoo_maindb",$dbconn) or die("Could not select examples");

$top_id = 1;
$top_id2 = 2;
$top_id3 = 3;

if($curEmail = $_COOKIE['currentUser']) {
$userResult = mysql_query("SELECT * FROM Users WHERE email = '$curEmail'");
$userp = mysql_fetch_assoc($userResult);

echo "<div class='btn btn-default' style='background-color:#FFFFFF; cursor:default;' onclick='goProfilePage()' type='button'>Welcome, " . $_COOKIE['currentUser'] . "!</div>";
$top_score=10000;
$top_score2=20000;
$top_score3=30000;

$queryGet = mysql_query("SELECT * FROM Platters");
while($dishp = mysql_fetch_assoc($queryGet)){
	$score = pow($userd['spicy'] - $dishp['spiciness'], 2) + pow($userd['sweet'] - $dishp['sweetness'], 2) + 5 * pow($userd['vegetarian'] - $dishp['vegetarian'], 2) + pow($userd['garlicky'] - $dishp['garlicky'], 2) + pow($userd['uniqueness'] - $dishp['uniqueness'], 2) + pow($userd['savouriness'] - $dishp['savouriness'], 2);
	$score = $score * (7 - $dishp['rating']);
	# echo "<p>" . $dishp['name'] . " is " . $score . " with overall rating " . $dishp['rating'] . "</p>";
	if($score < $top_score)
	{
		$top_score3 = $top_score2;
		$top_score2 = $top_score;
		$top_score = $score;
		
		$top_id3 = $top_id2;
		$top_id2 = $top_id;
		$top_id = $dishp['platterID'];
		
	}
	else if($score < $top_score2)
	{
		$top_score3 = $top_score2;
		$top_score2 = $score;
		
		$top_id3 = $top_id2;
		$top_id2 = $dishp['platterID'];
	}
	else if($score < $top_score3)
	{
		$top_score3 = $score;
		
		$top_id3 = $dishp['platterID'];
	}

}

}
else {
echo "<div class='btn btn-default' type='button' style='background-color:#FFFFFF; cursor:default;' name='login' onclick='goLoginPage()'>Log in/Sign up</div>";
}
echo"
		</div>
	</div>
	<br>
	<div class='row'><p class='col-md-12'>We will rate the food at whatever restaurant you like.</p></div>
	<div class='row'><p class='col-md-12'>Where would you like to eat?</p></div>
	<div class='row'><div class='col-md-5'> <div class='input-group'>
	      <input type='text' class='form-control' placeholder='Search for a restaurant' id='query_term' onkeydown='if (event.keyCode == 13) goResultsPage()'>
	      <span class='input-group-btn'>
	        <button class='btn coolBtn' id='gobutton' type='button' onclick='goResultsPage()'>Go!</button>
	      </span>
	</div></div></div>
	<a class='row' href='results.php'><div class='col-md-3 btn coolBtn' type='button'>View all Restaurants</div></a>
	
";
	$inlink_1 = mysql_fetch_assoc(mysql_query("SELECT image_url FROM Platters WHERE $top_id = platterID;"))['image_url'];
	$inlink_2 = mysql_fetch_assoc(mysql_query("SELECT image_url FROM Platters WHERE $top_id2 = platterID;"))['image_url'];
	$inlink_3 = mysql_fetch_assoc(mysql_query("SELECT image_url FROM Platters WHERE $top_id3 = platterID;"))['image_url'];
	$outlink_1 = "#";
	$outlink_2 = "#";
	$outlink_3 = "#";
	$firstassoc = mysql_fetch_assoc(mysql_query("SELECT * FROM Platters WHERE $top_id = platterID;"));
	$secondassoc = mysql_fetch_assoc(mysql_query("SELECT * FROM Platters WHERE $top_id2 = platterID;"));
	$thirdassoc = mysql_fetch_assoc(mysql_query("SELECT * FROM Platters WHERE $top_id3 = platterID;"));
	
	$firstrest = mysql_fetch_assoc(mysql_query("SELECT name FROM Restaurants WHERE YelpID= '" . $firstassoc['restaurantID'] . "'"))['name'];
	$secondrest = mysql_fetch_assoc(mysql_query("SELECT name FROM Restaurants WHERE YelpID= '" . $secondassoc['restaurantID']. "'"))['name'];
	$thirdrest = mysql_fetch_assoc(mysql_query("SELECT name FROM Restaurants WHERE YelpID= '" . $thirdassoc['restaurantID']. "'"))['name'];
	
	echo "
	<h3> Your Personalised Recommendations: </h3>
	<div class='row'>
		<table class='col-md-5'>
			<tr>
				<td><img src=" . $inlink_1 . " href=" . $outlink_1 . " alt='No pic' class='recommendation' height='180' width='200'></td>
				<td><img src=" . $inlink_2 . " href=" . $outlink_2 . " alt='No pic' class='recommendation' height='180' width='200'></td>
				<td><img src=" . $inlink_3 . " href=" . $outlink_3 . " alt='No pic' class='recommendation' height='180' width='200'></td>
			</tr>
			<tr>
				<td> " . $firstassoc['name'] . "</td>
				<td> " . $secondassoc['name'] . "</td>
				<td> " . $thirdassoc['name'] . "</td>
			</tr>	
			<tr>
				<td> " . $firstrest . "</td>
				<td> " . $secondrest . "</td>
				<td> " . $thirdrest . "</td>
			</tr>	
		</table>
	</div>";
?>
</div>
</html>

<script type="text/javascript">
	function goResultsPage(){
		query = document.getElementById('query_term').value;
		if(query)
			location.href = "results.php?query=" + query;
	}
	function goLoginPage(){
		location.href = "login.html";
	}
	function goProfilePage(){
		location.href = "profile.php";
	}
</script>