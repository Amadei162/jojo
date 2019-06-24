<?php

	 // starting the session
	session_start();
?>

<html>
<head>
<link rel="icon"
      type="image/png"
      href="images/favicon.ico">
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

<title>Shopping Cart</title>
<link rel="stylesheet" type="text/css" href="css/theme.css">

</head>

<body>

<div class="container">
	<div class="titleSection">
		<h1>Top Singles - Online Store</h1>
	</div>
	<div class='songDisplay'>

<?php

	include('functions.php');
	$dbConn = connectToDatabase();
	
	// using sessions
	$songs = $_SESSION['shoppingCart'];
	
	if(count($songs) == 0)
		echo "<center><h1>Nothing selected</h1></center>";

	else
	{

		// to get the songs that were selected
		$placeholders  = implode(",",$songs);

		$sql = "SELECT Songs.name,
				Songs.artist,
				Genres.genre,
				Catalog.price,
				Catalog.songID,
				Catalog.pictureLink,
				Songs.length
				FROM Songs
				INNER JOIN Genres ON Genres.genreID = Songs.genreID
				INNER JOIN Catalog ON Catalog.songID = Songs.songID
				WHERE Catalog.songID IN ($placeholders)";

		echo "<center><h3>Here is your shopping cart</h3></center>";
		$total = displayShoppingCart($dbConn,$sql);
		echo "<center><h3>Total:$$total</h3></center>";

	}
?>
	</div>

 
<center><a href="javascript:history.go(-1)">Go back to Music Store</center>
</div>
</body>

</html>
