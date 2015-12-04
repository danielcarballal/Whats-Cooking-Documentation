<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/style.css">

<title>Whats Cooking?</title>
</head>

<body>
<?php

	$username = "whatscoo_site";
	$password = "cookdb411pass/";
	$hostname = "localhost";
	$dbconn = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");
	$db = mysql_select_db("whatscoo_maindb",$dbconn) or die("Could not select examples");

	$rest_id = $_GET["id"];
	
	$queryGet = mysql_query("SELECT * FROM Restaurants WHERE YelpID = '$rest_id'");
	$resultGet = mysql_fetch_assoc($queryGet);
	
	if($_POST["name"]){
		
		$new_name = mysql_real_escape_string($_POST['name']);
		$new_cost = mysql_real_escape_string($_POST['cost']);
		$new_rating = mysql_real_escape_string($_POST['rating']);
		$new_sweet = mysql_real_escape_string($_POST['sweet']);
		$new_spicy = mysql_real_escape_string($_POST['spicy']);
		$new_unique = mysql_real_escape_string($_POST['uniqueness']);
		$new_garlic = mysql_real_escape_string($_POST['garlicky']);
		$new_savoury = mysql_real_escape_string($_POST['savoury']);
		$new_healthy = mysql_real_escape_string($_POST['healthy']);
		$new_veggie = mysql_real_escape_string($_POST['veggie']);
		$new_url = mysql_real_escape_string($_POST['url']);
		$rating = $new_rating;
		if($new_veggie == 'on')
		{
			$veg = 1;
		}
		else{
			$veg = 0;
		}
		$curEmail = $_COOKIE['currentUser'];

		mysql_query("INSERT INTO Platters(cost, name, restaurantID, rating, image_url, garlicky, savouriness, spiciness, sweetness, uniqueness, vegetarian, healthy) VALUES ($new_cost, '$new_name', '$rest_id', $new_rating, '$new_url', $new_garlic, $new_savoury, $new_spicy, $new_sweet, $new_unique, $veg, $new_healthy);") or die("Platter died");
		$id = mysql_fetch_assoc(mysql_query("SELECT platterID FROM Platters WHERE name='$new_name' AND restaurantID='$rest_id'"))['platterID'];
		mysql_query("UPDATE Users SET sweet = ((sweet * num_ratings + ((3 - $rating) * (3 - $new_sweet) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'") or die("Daniel failed");
	mysql_query("UPDATE Users SET spicy = ((spicy * num_ratings + ((3 - $rating) * (3 - $new_spicy) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'");
	mysql_query("UPDATE Users SET uniqueness = ((uniqueness * num_ratings + ((3 - $rating) * (3 - $new_unique) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'");
	mysql_query("UPDATE Users SET garlicky = ((garlicky * num_ratings + ((3 - $rating) * (3 - $new_garlic) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'");
	mysql_query("UPDATE Users SET savouriness = ((savouriness * num_ratings + ((3 - $rating) * (3 - $new_savoury) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'");
	mysql_query("UPDATE Users SET healthiness = ((healthiness * num_ratings + ((3 - $rating) * (3 - $new_healthy) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'");
	
	mysql_query("UPDATE Users SET num_ratings = num_ratings + 1 WHERE email='$curEmail';") or die("Platter count update failed");
	
	mysql_query("INSERT INTO Rating(user_email, dish_id, rating) VALUES ('$curEmail', $id, $new_rating)");
	}     
?>		

<div class="container">
	<br>
	<a href="returnResults.php?id=<?=$rest_id?>"><div class="row btn coolBtn" type="button">Go Back</div></a>
	<h1 class="row centered">Add a platter to <?=$resultGet['name']?></h1>
	<br>



	<div class="container centered">
	<form action="addPlatter.php?id=<?=$rest_id?>" method="post">
	  <table align="center">
	    <tbody>
	      <tr class="row">
	        <td >Platter name: </td>
	        <td ><input type="text" name="name" placeholder="Platter Name" required></td>
	      </tr>
	      <tr class="row">
	        <td class="col-md-3">Cost: </td>
	        <td class="col-md-9"><input name="cost" placeholder="Cost" type="number" step="0.01" min="0.01" max="199" required></td>
	      </tr>
	      <tr class="row">
	        <td class="col-md-3">Rating(1-5): </td>
	        <td class="col-md-9"><input type="number" name="rating" max="5" min="1" required></td>
	      </tr>
	      <tr class="row">
	        <td class="col-md-3">Sweetness(1-5): </td>
	        <td class="col-md-9"><input type="number" name="sweet" max="5" min="1" required></td>
	      </tr>
	      <tr class="row">
	        <td class="col-md-3">Spiciness(1-5): </td>
	        <td class="col-md-9"><input type="number" name="spicy" max="5" min="1" required></td>
	      </tr>
	      <tr class="row">
	        <td class="col-md-3">Uniqueness(1-5): </td>
	        <td class="col-md-9"><input type="number" name="uniqueness" max="5" min="1" required></td>
	      </tr>
	      <tr class="row">
	        <td class="col-md-3">Garlickyness?(1-5): </td>
	        <td class="col-md-9"><input type="number" name="garlicky" max="5" min="1" required></td>
	      </tr>
	      <tr class="row">
	        <td class="col-md-3">Savoury(1-5): </td>
	        <td class="col-md-9"><input type="number" name="savoury" max="5" min="1" required></td>
	      </tr>
	      <tr class="row">
	        <td class="col-md-3">Healthiness(1-5): </td>
	        <td class="col-md-9"><input type="number" name="healthy" max="5" min="1" required></td>
	      </tr>
	      <tr class="row">
	        <td class="col-md-3">Vegetarian? </td>
	        <td class="col-md-9"><input type="radio" name="veggie"></td>
	      </tr>
	      <tr class="row">
	        <td class="col-md-3">Image URL: </td>
	        <td class="col-md-9"><input type="text" name="url" required></td>
	      </tr>
	      <tr class="row">
			<td class="col-md-3"><button type="submit" class="btn coolBtn" id="submit">Add</button></td>
		  </tr>
	    </tbody>
	  </table>
	</form>  
</div>

</div>
</body>
</html>
