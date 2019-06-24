<?php 

include_once '../../config/database_connect.php';
include_once '../../config/debug_functions.php';
include_once '../../config/way_functions.php';

$arrField = selectField('customer');

// формируем переменные на основе массива

if ($_POST) {
	//find
	if ($_POST['find'] && $_POST['submit'] && !$_COOKIE['find']) {
		
	}

	//delete
	if ($_POST['del'] && $_POST['submit'] && !$_COOKIE['del']) {
		
	}

	//add
	if ($_POST['add'] && $_POST['submit'] && !$_COOKIE['add']) {
		
	}

	//edit
	if ($_POST['edit'] && $_POST['submit'] && !$_COOKIE['edit']) {
		
	}

}

include_once '../../config/doc_head.html';






	echo "<form method='post' action='".DEFAULT_FORM_ACTION."'>";
	echo "<table>";
	echo "<tr>";
	foreach ($arrField as $key => $value) {
		echo "<th>$value</th>";
	}
	echo "</tr>";

	echo "<tr>";
	foreach ($arrField as $key => $value) {
		echo "<td>input$value</td>";
	}
	echo "</tr>";