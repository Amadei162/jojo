<?php

	ini_set('session.cache_limiter','public');
	session_cache_limiter(false);
	session_start();

	if (isset($_POST['songs']))
	{
		$_SESSION['shoppingCart'] = $_POST['songs'];
		header("Location: process.php");
	}

?>

<html>
	<head>
		<title>Online Store</title>
		<link rel="icon"
		      type="image/png"
		      href="images/favicon.ico">
		<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	</head>
	<link rel="stylesheet" type="text/css" href="css/theme.css">
	
	<body>
		<!--
		FORM SEARCH - BEGIN
		-->
		<div class="container">
			<div class="titleSection">
				<h1>Top Singles - Online Store</h1>
			</div>
		</div>

		<!--
		FORM SEARCH - END
		-->
		<?php
			include ('functions.php');
			
			$dbConn = connectToDatabase();
			
			// base sql
			
			$sql = "SELECT Songs.name,
							Songs.artist,
							Songs.length,
							Genres.genre,
							Catalog.price,
							Catalog.songID,
							Catalog.pictureLink
							FROM Songs
							INNER JOIN Genres ON Genres.genreID = Songs.genreID
							INNER JOIN Catalog ON Catalog.songID = Songs.songID";
			
			// Check to see if button was pressed and atleast one option
			// was selected
			
			$genreSet = false;
			$doDefault = true;
			
			// Logic to deal with queries selected
			if (isset($_POST['submit']) && atLeastOne())
			{
				if (isset($_POST['genre']) && $_POST['genre'] != "")
				{
					$sql.= " WHERE Genres.genreID=" . $_POST['genre'];
					$genreSet = true;
				}
			
				if (isset($_POST['artistName']) && $_POST['artistName'] != "")
				{
					$doDefault = false;
					if ($genreSet)
					{
			        	$sql.= " AND Songs.artist='" . $_POST['artistName'] . "'";
					}
					else
					{
						$sql.= " WHERE Songs.artist='" . $_POST['artistName'] . "'";
					}
				}
			
				if (isset($_POST['sortPrice']))
				{
					$doDefault = false;
					$sql.= " ORDER BY price " . $_POST['sortPrice'];
				}
			}
			
			$do = $_SERVER['PHP_SELF'];
			echo "<form method='POST' action='" . htmlspecialchars($do) . "'>";
			
			if($doDefault && !$genreSet)
				$sql .= " ORDER BY Songs.name";
			
			echo "<div class='songDisplay'>";
			echo "<div class='tableContainer'>";
			echo "<h3> Select from the following</h3>";
			displayData($dbConn, $sql);
			echo "</div>";
			echo "
			<div class='userInput'>
				<div class='separation'>
					<form action='' method='POST'  >
					
						Search artist: 
						<input type='text' name='artistName'>
						<br />
						
					  	Select Genre: 
					  	<select name='genre'>
							<option disabled selected value> -- select an option -- </option>
						
						    <option value=1>Hip-Hop</option>
						    <option value=2>Rock</option>
						    <option value=3>Pop</option>
						    <option value=4>Country</option>
					  	</select>
						<br />
						
					   	Sort by price: 
					   	<select name='sortPrice'>
							<option disabled selected value> -- select an option -- </option>
					
					    	<option value='desc'>high-low</option>
					    	<option value='asc'>low-high</option>
					  	</select>
					
					  	<br /><br />
					  	<input type='submit' name='submit' value='Submit'>
					</form>
				</div>
			</div>
			";
			echo "<div class='submitSection'>";
			echo "<input type='submit' name='buy' value='Buy Now'>";
			echo "</div>";
			echo "</form>";
			echo "</div>";
			
			
			function atLeastOne()
			{
				return isset($_POST['genre']) || isset($_POST['sortPrice']) || isset($_POST['artistName']);
			}
		?>
		
	</body>
</html>