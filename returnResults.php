<!DOCTYPE html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="stars.css">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
<title>Whats Cooking?</title>
</head>
<html>

<script type="text/javascript">
function openPopup(form) {
  document.getElementById("overlay").style.display = 'block';
  document.getElementById("popup").style.display = 'block';
  document.getElementById("submitButton").onclick = function() { submitForm(form); };
  document.getElementById("exitButton").onclick = function() { closePopup() };
}

function closePopup() {
  document.getElementById("overlay").style.display = 'none';
  document.getElementById("popup").style.display = 'none';
}

function submitForm(form) {
	console.log(form);
	form.elements["sweet"].value = document.querySelector('input[name="sweet"]:checked').value;
	form.elements["spicy"].value = document.querySelector('input[name="spicy"]:checked').value;
	form.elements["uniqueness"].value = document.querySelector('input[name="uniqueness"]:checked').value;
	form.elements["healthiness"].value = document.querySelector('input[name="healthiness"]:checked').value;
	form.elements["savouriness"].value = document.querySelector('input[name="savouriness"]:checked').value;
	form.elements["garlicky"].value = document.querySelector('input[name="garlicky"]:checked').value;
	form.submit();
}
</script>

<div id="overlay"></div>
<div id="popup" style="height: 300px">
    <div class="popupcontent">
    	<label for="sweetness" style="float:left;">Sweetness:</label>
    	<fieldset id="sweetness" class="rating">
		<input type="radio" id="sweet5" name="sweet" value="5" /><label for="sweet5" title="Rocks!">5 stars</label>
		<input type="radio" id="sweet4" name="sweet" value="4" /><label for="sweet4" title="Pretty good">4 stars</label>
		<input type="radio" id="sweet3" name="sweet" value="3" checked /><label for="sweet3" title="Meh">3 stars</label>
		<input type="radio" id="sweet2" name="sweet" value="2" /><label for="sweet2" title="Kinda bad">2 stars</label>
		<input type="radio" id="sweet1" name="sweet" value="1" /><label for="sweet1" title="Sucks big time">1 star</label>
	</fieldset><br/><br/>
	<label for="Spiciness" style="float:left;">Spiciness:</label>
    	<fieldset id="Spiciness" class="rating">
		<input type="radio" id="spicy5" name="spicy" value="5" /><label for="spicy5" title="Rocks!">5 stars</label>
		<input type="radio" id="spicy4" name="spicy" value="4" /><label for="spicy4" title="Pretty good">4 stars</label>
		<input type="radio" id="spicy3" name="spicy" value="3" checked /><label for="spicy3" title="Meh">3 stars</label>
		<input type="radio" id="spicy2" name="spicy" value="2" /><label for="spicy2" title="Kinda bad">2 stars</label>
		<input type="radio" id="spicy1" name="spicy" value="1" /><label for="spicy1" title="Sucks big time">1 star</label>
	</fieldset><br/><br/>
	<label for="Uniqueness" style="float:left;">Uniqueness:</label>
    	<fieldset id="Uniqueness" class="rating">
		<input type="radio" id="uniqueness5" name="uniqueness" value="5" /><label for="uniqueness5" title="Rocks!">5 stars</label>
		<input type="radio" id="uniqueness4" name="uniqueness" value="4" /><label for="uniqueness4" title="Pretty good">4 stars</label>
		<input type="radio" id="uniqueness3" name="uniqueness" value="3" checked /><label for="uniqueness3" title="Meh">3 stars</label>
		<input type="radio" id="uniqueness2" name="uniqueness" value="2" /><label for="uniqueness2" title="Kinda bad">2 stars</label>
		<input type="radio" id="uniqueness1" name="uniqueness" value="1" /><label for="uniqueness1" title="Sucks big time">1 star</label>
	</fieldset><br/><br/>
	<label for="Savouriness" style="float:left;">Savouriness:</label>
    	<fieldset id="Savouriness" class="rating">
		<input type="radio" id="savouriness5" name="savouriness" value="5" /><label for="savouriness5" title="Rocks!">5 stars</label>
		<input type="radio" id="savouriness4" name="savouriness" value="4" /><label for="savouriness4" title="Pretty good">4 stars</label>
		<input type="radio" id="savouriness3" name="savouriness" value="3" checked /><label for="savouriness3" title="Meh">3 stars</label>
		<input type="radio" id="savouriness2" name="savouriness" value="2" /><label for="savouriness2" title="Kinda bad">2 stars</label>
		<input type="radio" id="savouriness1" name="savouriness" value="1" /><label for="savouriness1" title="Sucks big time">1 star</label>
	</fieldset><br/><br/>
	<label for="Healthiness" style="float:left;">Healthiness:</label>
    	<fieldset id="Healthiness" class="rating">
		<input type="radio" id="healthiness5" name="healthiness" value="5" /><label for="healthiness5" title="Rocks!">5 stars</label>
		<input type="radio" id="healthiness4" name="healthiness" value="4" /><label for="healthiness4" title="Pretty good">4 stars</label>
		<input type="radio" id="healthiness3" name="healthiness" value="3" checked /><label for="healthiness3" title="Meh">3 stars</label>
		<input type="radio" id="healthiness2" name="healthiness" value="2" /><label for="healthiness2" title="Kinda bad">2 stars</label>
		<input type="radio" id="healthiness1" name="healthiness" value="1" /><label for="healthiness1" title="Sucks big time">1 star</label>
	</fieldset><br/><br/>
	<label for="Garlicky" style="float:left;">Garlicky:</label>
    	<fieldset id="Garlicky" class="rating">
		<input type="radio" id="garlicky5" name="garlicky" value="5" /><label for="garlicky5" title="Rocks!">5 stars</label>
		<input type="radio" id="garlicky4" name="garlicky" value="4" /><label for="garlicky4" title="Pretty good">4 stars</label>
		<input type="radio" id="garlicky3" name="garlicky" value="3" checked /><label for="garlicky3" title="Meh">3 stars</label>
		<input type="radio" id="garlicky2" name="garlicky" value="2" /><label for="garlicky2" title="Kinda bad">2 stars</label>
		<input type="radio" id="garlicky1" name="garlicky" value="1" /><label for="garlicky1" title="Sucks big time">1 star</label>
	</fieldset><br/><br/>
	<fieldset id="Vegetarian" class="rating">
		<input type="radio" id="vegetarian" name="vegetarian" />
	</fieldset>


        <div id="submitButton" type="button" class="btn coolBtn">SUBMIT</div> 
        <div id="exitButton" type="button" class="btn coolBtn">CLOSE</div>
    </div>
</div>

<div class="container">
<?php
$username = "whatscoo_site";
$password = "cookdb411pass/";
$hostname = "localhost";
$id = $_GET["id"];
$dbconn = mysql_connect($hostname, $username, $password) or die("Unable to connect to MySQL");

$db = mysql_select_db("whatscoo_maindb",$dbconn) or die("Could not select examples");

if($_POST['platter_id']) {
	$platter_id = $_POST['platter_id'];
	$rating = $_POST['rating'];
	$new_sweet = mysql_real_escape_string($_POST['sweet']);
	$new_spicy = mysql_real_escape_string($_POST['spicy']);
	$new_unique = mysql_real_escape_string($_POST['uniqueness']);
	$new_garlic = mysql_real_escape_string($_POST['garlicky']);
	$new_savoury = mysql_real_escape_string($_POST['savouriness']);
	$new_healthy = mysql_real_escape_string($_POST['healthiness']);
	$curEmail = $_COOKIE['currentUser'];
	
	if(empty($curEmail)) {
		die("Not logged in!");
	}
	mysql_query("UPDATE Platters SET rating = (rating * num_ratings + '$rating') / (num_ratings + 1) WHERE platterID='$platter_id'") or die("Platter rating update failed");
	mysql_query("UPDATE Platters SET sweetness = (sweetness * num_ratings + '$new_sweet') / (num_ratings + 1) WHERE platterID='$platter_id'");
	mysql_query("UPDATE Platters SET spiciness = (spiciness * num_ratings + '$new_spicy') / (num_ratings + 1) WHERE platterID='$platter_id'");
	mysql_query("UPDATE Platters SET uniqueness = (uniqueness * num_ratings + '$new_unique') / (num_ratings + 1) WHERE platterID='$platter_id'");
	mysql_query("UPDATE Platters SET garlicky = (garlicky * num_ratings + '$new_garlic') / (num_ratings + 1) WHERE platterID='$platter_id'");
	mysql_query("UPDATE Platters SET savouriness = (savouriness * num_ratings + '$new_savoury') / (num_ratings + 1) WHERE platterID='$platter_id'");
	mysql_query("UPDATE Platters SET healthiness = (healthiness * num_ratings + '$new_healthy') / (num_ratings + 1) WHERE platterID='$platter_id'");
	
	mysql_query("UPDATE Platters SET num_ratings = num_ratings + 1 WHERE platterID='$platter_id'") or die("Platter count update failed");
	
	echo "UPDATE Users SET sweet = ((sweet * num_ratings + ((3 - $rating) * (3 - $new_sweet) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'";
	mysql_query("UPDATE Users SET sweet = ((sweet * num_ratings + ((3 - $rating) * (3 - $new_sweet) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'") or die("Daniel, you failure");
	mysql_query("UPDATE Users SET spicy = ((spicy * num_ratings + ((3 - $rating) * (3 - $new_spicy) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'");
	mysql_query("UPDATE Users SET uniqueness = ((uniqueness * num_ratings + ((3 - $rating) * (3 - $new_unique) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'");
	mysql_query("UPDATE Users SET garlicky = ((garlicky * num_ratings + ((3 - $rating) * (3 - $new_garlic) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'");
	mysql_query("UPDATE Users SET savouriness = ((savouriness * num_ratings + ((3 - $rating) * (3 - $new_savoury) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'");
	mysql_query("UPDATE Users SET healthiness = ((healthiness * num_ratings + ((3 - $rating) * (3 - $new_healthy) + 4) * (5/8))) / (num_ratings + 1) WHERE email='$curEmail'");
	
	mysql_query("UPDATE Users SET num_ratings = num_ratings + 1 WHERE email='$curEmail';") or die("Platter count update failed");
	
	mysql_query("INSERT INTO Rating(user_email, dish_id, rating) VALUES ('$curEmail', $platter_id, $rating)") or die("GDJSKJLKFDLKJSD");
	
	//echo "Daniel has succeeded";

	
}

$query = mysql_query("SELECT * FROM Restaurants WHERE YelpID = '$id'");
$res = mysql_fetch_assoc($query);
echo "<br>";
echo "<a href='results.php?query=" . $_GET['query'] . "'><div class='row btn coolBtn' type='button'>Go Back</div></a>";
?>
	<h1 class="row"><?=$res[name]?></h1>
	<table class="row table" style="width:60%">
	  <tr>
	  	<th>Item</th>
	  	<th>Cost</th>
	  	<th>Rating</th>
	  </tr>
<?php
$pQuery = mysql_query("SELECT * FROM Platters WHERE restaurantID = '$id'");
while ($row = mysql_fetch_assoc($pQuery)) {
echo '<tr>
  	<td>'.$row['name'].'</td>
  	<td>'.$row['cost'].'</td>
  	<td>
  		<form action="returnResults.php?id='.$id.'" method="POST">
  			<input type="hidden" name="platter_id" value="'.$row['platterID'].'" />
  			<input type="hidden" name="sweet" value="0" />
  			<input type="hidden" name="spicy" value="0" />
  			<input type="hidden" name="uniqueness" value="0" />
  			<input type="hidden" name="savouriness" value="0" />
  			<input type="hidden" name="healthiness" value="0" />
  			<input type="hidden" name="garlicky" value="0" />
  			<input type="hidden" name="vegetarian"/>
  			<fieldset class="rating" onclick="openPopup(form);">
    				<input type="radio" id="star5'.$row['platterID'].'" name="rating" value="5" '.(floor($row['rating'])==5?'checked':'').' /><label for="star5'.$row['platterID'].'" title="Rocks!">5 stars</label>
    				<input type="radio" id="star4'.$row['platterID'].'" name="rating" value="4" '.(floor($row['rating'])==4?'checked':'').' /><label for="star4'.$row['platterID'].'" title="Pretty good">4 stars</label>
    				<input type="radio" id="star3'.$row['platterID'].'" name="rating" value="3" '.(floor($row['rating'])==3?'checked':'').' /><label for="star3'.$row['platterID'].'" title="Meh">3 stars</label>
    				<input type="radio" id="star2'.$row['platterID'].'" name="rating" value="2" '.(floor($row['rating'])==2?'checked':'').' /><label for="star2'.$row['platterID'].'" title="Kinda bad">2 stars</label>
    				<input type="radio" id="star1'.$row['platterID'].'" name="rating" value="1" '.(floor($row['rating'])==1?'checked':'').' /><label for="star1'.$row['platterID'].'" title="Sucks big time">1 star</label>
			</fieldset>
		</form>
	</td>
  </tr>';
}
?>
	</table>
	<p>Dont see the platter you are looking for?</p>
	<a href="addPlatter.php?id=<?=$id?>"><div class="row btn coolBtn" type="button">Add Platter</div></a>
	
</div>
</html>