<?php 
session_start();
include '/config/database_connect.php';
include '/config/debug_functions.php';
include '/config/way_functions.php';

if(isset($_SESSION["session_username"])){
	// Если уже есть сессия, значит автоматом перенаправляем на главную страницу.
	header("Location: /");
}

if ($_POST['register']) {
	$name = mysqli_real_escape_string($dbConnect, htmlspecialchars($_POST['name']));
	$login = mysqli_real_escape_string($dbConnect, htmlspecialchars($_POST['login']));
	$email = mysqli_real_escape_string($dbConnect, htmlspecialchars($_POST['email']));
	$password = mysqli_real_escape_string($dbConnect, htmlspecialchars($_POST['password']));
	$confirm = mysqli_real_escape_string($dbConnect, htmlspecialchars($_POST['confirm']));

	if ($login && $email && $password && $confirm) {
		
		$queryFind = "SELECT * FROM `user` WHERE `nickname` = '$login' OR `email` = '$email'";
		$resultFind = mysqli_query($dbConnect, $queryFind);
		$arrFind = mysqli_fetch_assoc($resultFind);

		if (!$arrFind) {
			if ($password === $confirm) {
				$queryAdd = "INSERT INTO user (`name`, `nickname`, `password`, `email`) VALUES ('$name', '$login', '$password', '$email')";
				$resultAdd = mysqli_query($dbConnect, $queryAdd);
		
				if ($resultAdd) {
					header("Location: /login");
				} else {
					echo "Произошла ошибка, попробуйте еще раз";
				}
			} else {
				echo "Введенные пароли не совпадают";
			}
		}
		if ($arrFind['email'] == $email) {
			echo "Такой email уже зарегестрирован. Введите другой адрес<br>";
		}
		if ($arrFind['nickname'] == $login) {
			echo "Такой ник уже зарегестрирован. Введите другой<br>";
		}		
	} else {
		echo "Вы ввели не все данные. Повторите ввод";
	}
} else {
	echo "Для регистрации, заполните форму ниже";
}

?>

<form action="" method="post">
	<input required type="text" name="name" placeholder="Вас зовут">
	<input required type="text" name="login" placeholder="Ваш логин">
	<input required type="email" name="email" placeholder="Электронная почта">
	<input required type="password" name="password" placeholder="Введите пароль">
	<input required type="password" name="confirm" placeholder="Подтвердите пароль">
	<input type="submit" name="register" value="Зарегистрироваться">
</form>