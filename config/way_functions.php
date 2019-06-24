<?php

function redirectSelf() {
	$_POST = NULL;
	header("Location: ".$_SERVER['REQUEST_URI']);
	exit();
}

function redirectAdd() {
	setcookie('add', '1');
	$_POST = NULL;
	header("Location: ".$_SERVER['REQUEST_URI']);
	exit();
}

function redirectEdit($editId) {
	setcookie('edit', $editId);
	$_POST = NULL;
	header("Location: ".$_SERVER['REQUEST_URI']);
	exit();
}

function redirectDel($delId) {
	setcookie('del', $delId);
	$_POST = NULL;
	header("Location: ".$_SERVER['REQUEST_URI']);
	exit();
}

function redirectAddEdit($editId) {
	setcookie('add', '1');
	setcookie('edit', $editId);
	$_POST = NULL;
	header("Location: ".$_SERVER['REQUEST_URI']);
}

function findRecord() {
	
}

function addRecord() {
	if ($_POST['add'] && $_COOKIE['add'] == 0 && $_POST['submit']) {
		$addCityName = $_POST['add']['name'];
		$addCityPost = $_POST['add']['postcode'];

		if ($addCityName && $addCityPost) {	
			$addQuery = "INSERT INTO `city` (`name`,`postcode`) VALUES ('$addCityName', '$addCityPost')";
	
			$addResult = mysqli_query($dbConnect, $addQuery);
		}
	}
}

function selectField($table) {

	$query = "SHOW COLUMNS FROM `$table`";
	// echo "$query";

	$dbConnect = mysqli_connect(DBHOST, DBUSER, DBPASS, DBDATABASE) or die('CONNECT ERR');

	$result = mysqli_query($dbConnect, $query) or die("ERRRR");
	$ln = mysqli_num_rows($result);

	for ($i=0; $i < $ln; $i++) { 
		$arr[$i] = mysqli_fetch_assoc($result);
		$arrField[] = $arr[$i]['Field'];
	}

	return $arrField;
}

function addQueryFromArr($arr, $name) {
	if ($arr) {
		$ln = count($arr);
		$query = "INSERT INTO `$name` (";

		for ($i=0; $i < $ln; $i++) {
			if ($i != $ln - 1) {
				$query .= "`$arr[$i]`, ";
			} else {
				$query .= "`$arr[$i]`";
			}
		}

		$query .= ") VALUES (";
	
		foreach ($arr as $key => $value) {
			$$value = $_POST['add'][$value];

			if ($$value) {
				$count++;
				if ($count != $ln) {
					$query .= "'".$$value."', ";
				} else {
					$query .= "'".$$value."'";
				}
			}
		
			$query .= ") ";
			return $query;
		}
	}
}

?>