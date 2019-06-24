<?php 

include_once '../../config/database_connect.php';
include_once '../../config/debug_functions.php';
include_once '../../config/way_functions.php';

// preVar($_POST);
$formAction = substr($_SERVER['PHP_SELF'],0,-4);

if ($_POST) {
	//find function
	if ($_POST['find'] && $_POST['submit'] && $_COOKIE['find'] == 0) {
		$findCityId = $_POST['find']['id'];
		$findCityName = $_POST['find']['name'];
		$findCityPost = $_POST['find']['postcode'];
	
		setcookie('find_id', $findCityId);
		setcookie('find_name', $findCityName);
		setcookie('find_post', $findCityPost);
	
	
		if ($findCityId) {
			$QfindCityId = '%'.$findCityId.'%';
		}
		if ($findCityName) {
			$QfindCityName = '%'.$findCityName.'%';
		}
		if ($findCityPost) {
			$QfindCityPost = '%'.$findCityPost.'%';
		}


		if ($findCityId || $findCityName || $findCityPost) {
			$findQuery = "SELECT * FROM `city` WHERE `postcode` LIKE '$QfindCityPost' OR `city_id` LIKE '$QfindCityId' OR `name` LIKE '$QfindCityName'";
		}
		
		if ($findQuery) {
			setcookie('find', $findQuery);
			setcookie('find_id', $findCityId);
			setcookie('find_name', $findCityName);
			setcookie('find_post', $findCityPost);
		}
	}
	//delete function
	if ($_POST['del'] && $_POST['submit'] && $_COOKIE['del'] == 0) {
		$delArrId = $_POST['del'];
		foreach ($delArrId as $key => $value) {
			$delQuery[] = "DELETE FROM `city` WHERE `city_id` = '$key'";
			$delArrId[$key] = $key;
		}
		$delArrId = implode('.', $delArrId);

		$lnDelQuery = count($delQuery);

		for ($i=0; $i < $lnDelQuery; $i++) { 
			$delResult = mysqli_query($dbConnect, $delQuery[$i]);
		}

	}
	//add function
	// Пока что не трогаем, никак не могу прикрутить функцию
	if ($_POST['add'] && $_COOKIE['add'] == 0 && $_POST['submit']) {
		$addCityName = $_POST['add']['name'];
		$addCityPost = $_POST['add']['postcode'];

		if ($addCityName && $addCityPost) {	
			$addQuery = "INSERT INTO `city` (`name`,`postcode`) VALUES ('$addCityName', '$addCityPost')";
	
			$addResult = mysqli_query($dbConnect, $addQuery) or die('ERRR');
		}
	}
	//edit function
	if ($_POST['edit'] && $_COOKIE['edit'] == 0 && $_POST['submit']) {
			foreach ($_POST['edit'] as $key => $value) {
				$editQuery[] = "UPDATE `city` SET `name` = '$value[name]', `postcode` = '$value[postcode]' WHERE `city_id` = '$key'";
				$editResultId[] = $key;
			}
	
			$editResultId = implode('.', $editResultId);
	
			$lnEditQuery = count($editQuery);
	
			for ($i=0; $i < $lnEditQuery; $i++) { 
				$editResult = mysqli_query($dbConnect, $editQuery[$i]);
			}
	}
	//redirects
	if ($addResult && $editResult) {	
		redirectAddEdit($editResult);
	}
	if ($editResult) {
		redirectEdit($editResultId);
	}
	if ($addResult) {
		redirectAdd();
	}
	if ($delResult) {
	 	redirectDel($delArrId);
	} 
	elseif ($_POST['submit']) {
		redirectSelf();
	}

}

if ($_COOKIE['find']) {
	$findQueryCookie = $_COOKIE['find'];
	// preVar($findQueryCookie);
	setcookie('find', 0);
}
// SCRIPT END

include_once '../../config/doc_head.html';
include_once '../../include/top_nav.html';

echo "<h1>Города</h1>";

// header

	echo "<form method='post' action='".$formAction."'>";
	echo "<table>";
	echo "<tr>";
	echo "<th>ID</th>";
	echo "<th>Имя</th>";
	echo "<th>Почтовый код</th>";	
	echo "</tr>";

//find
	echo "<tr class='find'>";
	echo "<td class='find-id'><input type='text' name='find[id]' placeholder='ID' value='$_COOKIE[find_id]' ></td>";
	echo "<td class='find-name'><input type='text' name='find[name]' placeholder='Имя' value='$_COOKIE[find_name]' ></td>";
	echo "<td class='find-post'><input type='text' name='find[postcode]' placeholder='Индекс' value='$_COOKIE[find_post]' ></td>";
	echo "<td colspan=2><input type='submit' name='submit' value='FIND' class='find-rec' ></td>";
	echo "</tr>";
//empty row;
	echo "<tr>";
	echo "<td colspan=5></td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td colspan=5></td>";
	echo "</tr>";

//add input

	echo "<tr>";
	echo "<td class='add-status' >ADD</td>";
	echo "<td><input type='text' name='add[name]' placeholder='Имя'></td>";
	echo "<td><input type='text' name='add[postcode]' placeholder='Индекс'></td>";
	echo "<td colspan=2><input type='submit' name='submit' value='SUBMIT' class='add-rec' ></td>";
	echo "</tr>";

//show
// preVar($_COOKIE['find']);
if ($findQueryCookie) {

	$findResult = mysqli_query($dbConnect, $findQueryCookie);
	
	if ($findResult) {
		$lnFindResult = mysqli_num_rows($findResult);

		for ($i=0; $lnFindResult > $i; $i++) { 
			$arrFindResult[] = mysqli_fetch_assoc($findResult);
			echo "<tr>";
			echo "<td class='city_id'>".$arrFindResult[$i]['city_id']."</td>";
			echo "<td class='name'>".$arrFindResult[$i]['name']."</td>";
			echo "<td class='postcode'>".$arrFindResult[$i]['postcode']."</td>";
			echo "<td class='edit-rec'>Edit</td>";
			echo "<td class='delete-rec'><label><input type='checkbox' name='del[".$arrFindResult[$i]['city_id']."]' ><span>Del</span></label></td>";
			echo "</tr>";
		}	
	}
} else {
	$showQuery = 'SELECT * FROM `city`';
	$showResult = mysqli_query($dbConnect, $showQuery);
	$lnShowResult = mysqli_num_rows($showResult);
	
	for ($i=0; $lnShowResult > $i; $i++) { 
		$arrShowResult[] = mysqli_fetch_assoc($showResult);
		echo "<tr>";
		echo "<td class='city_id'>".$arrShowResult[$i]['city_id']."</td>";
		echo "<td class='name'>".$arrShowResult[$i]['name']."</td>";
		echo "<td class='postcode'>".$arrShowResult[$i]['postcode']."</td>";
		echo "<td class='edit-rec'>Edit</td>";
		echo "<td class='delete-rec'><label><input type='checkbox' name='del[".$arrShowResult[$i]['city_id']."]'><span>Del</span></label></td>";
		echo "</tr>";
	}
}





echo "</table>";
echo "</form>";
/*
	сначала показываем, что у нас есть в таблице.
	потом, нужно сделать так, чтобы по нажатию одной
	кнопки, у нас редактировалась наша запись.
	Это можно реализовать на jquery (замена записи на input
	с placeholder'ом в текущей записи)
	Там же, расположить кнопку удаления.

	или нет. Сразу возле кажной записи расположить по кнопочке для редактирования и удаления, но без jquery 
	никуда снова.
	Эта идея мне нравиться больше, она легче реализуема и занимает меньше места. оставим ее. Но в учебных целях сделаем и другие варианты.

	или. можно добавить форму, в которую вводим id записи, которую нужно отредактировать. ее редактируем и хорошо, но нужны лишние телодвижения. Не подходит.
	
	...Чингис Айтматов "Прощай, Гульсары"...
	...Равель. Дитя и волшебство...

	если хотим удалить. Нажимаем на чекбокс. Он загорается красным, посылает всплывающее окно, вы действительно хотите удалить запись "такую-то". Если да - то выполняем запрос к базе и отчитываемся о результате

	или делаем множественный выбор, но здесь трудность с показом множества записей, или рпосто указать количество записей, которые хотим снести.

	передаем в куки массив с ID удаляемых записей, их считываем с инпута.

	второй вариант мне нравится больше. 
	И было бы неплохо все это дело запихнуть в функции

	коннект -> задаем запрос -> реультат -> SHOW          -> ok 
							 			 -> INSERT-ADD    -> ok
							 			 -> UPDATE-EDIT   -> ok
							 			 -> FIND-SELECT   -> ok
							 			 -> DELETE-DELETE -> ok

*/




?>