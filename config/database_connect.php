<?php 

define ("DBHOST", "127.0.0.1");
define ("DBUSER", "creator");
define ("DBPASS", "password");
define ("DBDATABASE", "geekshop");

define("DEFAULT_FORM_ACTION", substr($_SERVER['PHP_SELF'],0,-4));
$dbConnect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBDATABASE) or die('CONNECT ERR');
// define("DBCONNECT", "mysqli_connect(DBHOST, DBUSER, DBPASS, DBDATABASE) or die('CONNECT ERR')");

// if ($dbConnect) {
// 	echo "<strong>connect success</strong><br>";
// }
?>