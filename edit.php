<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<title>Whats Cooking?</title>
</head>

<body>
<?php
	/* query and id got mixed up in the URL, don't care enough to fix it 
	id = the query that the user entered
	query = id of the restaurant
	Yeah, weird
	*/
	$res_id = $_GET['query'];
	$username = "whatscoo_site";
	$password = "cookdb411pass/";
	$hostname = "localhost";
	$dbconn = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
	$db = mysql_select_db("whatscoo_maindb",$dbconn) or die("Could not select examples");
	
	$result = mysql_query("SELECT name, city FROM Restaurants WHERE YelpID='$res_id'");
	while ($row = mysql_fetch_assoc($result)) {

		  $res_name = $row['name'];
		  $res_town = $row['city'];
	
	}
	if($_POST['name'])
	{
		$new_name = mysql_real_escape_string($_POST['name']);
		$new_city = mysql_real_escape_string($_POST['city']);
		$result = mysql_query("UPDATE Restaurants SET name='$new_name', city='$new_city' WHERE YelpID='$res_id'");
	}
	
?>
<div class="container">
	<br>
	<?php
	echo "<a href='results.php?query=" . $_GET['id'] . "'><div class='row btn coolBtn' type='button'>Go Back</div></a>";
	?>
	<h1 class="row">Edit Restaurant</h1>
	<br>
	<div class="row">
	<?php
		echo "<form class='col-md-7' action='edit.php?query=" . $res_id. "' method='post'>";
	?>
			<span class="row">
				<span class="col-md-3"> Restaurant Name: </span>
			<?php
				echo "<span class='col-md-9'> <input type='text' name='name' placeholder='" . $res_name . "'></span>";
			?>
			</span>
			<span class="row">
				<span class="col-md-3"> New Address:</span>
			<?php
				echo "<span class='col-md-9'> <input type='text' name='city' placeholder='" . $res_town . "'></span>";
			?>
			</span>
			<span class="row">
				<button type="submit" class="btn coolBtn" id="submit">Edit</button>
			</span>
		</form>
	</div>
</div>
</body>
</html>