<?php
include '../config/database_connect.php';
include '../config/debug_functions.php';
include '../config/way_functions.php';

if ($_POST) {
	$login = mysqli_real_escape_string($dbConnect, htmlspecialchars($_POST['login']));
	$pass = mysqli_real_escape_string($dbConnect, htmlspecialchars($_POST['password']));


	if ($login && $pass) {
		$loginQuery = "SELECT * FROM user WHERE `nickname` = '$login'";
		$loginResult = mysqli_query($dbConnect, $loginQuery);

		$loginRow = mysqli_fetch_assoc($loginResult);

		if ($loginRow['password'] == $pass) {
			header('Location: /index');
		} else {
			echo "Неправильные имя пользователя или пароль<br>";
		}
	}
	if (!$login) {
		echo "Не введен логин<br>";		
	}
	if (!$pass) {
		echo "Не введен пароль<br>";		
	}
}
?>
<form action="/user/login.php" method="post" class="form_login">
	<input type="text" name="login" placeholder="Ваш логин">
	<input type="password" name="password" placeholder="Ваш пароль">
	<input type="submit" value="ВОЙТИ">
</form>
