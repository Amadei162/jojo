<?php 
session_start();
include 'config/database_connect.php';
include 'config/debug_functions.php';
include 'config/way_functions.php';


if (!$_SESSION['session_username']) {
	header("Location: /login");
} else {
	echo "Привет, пользователь ";
	echo $_SESSION['session_username']."<br>";
	echo "<a href='/logout'>Выйти</a>";
}


// здесь расположим регистрацию
// вернее, сначала форму входа и ссылку на регистрацию
// итак, регистрация.
// preVar($_POST);


/* 
	Алгоритм работы.
	
	0. Располагаем поля для ввода данных: логин, пароль, сабмит, ссылка на регистрацию, после проверок.

	ПРОВЕРКИ
	1. Введены ли все данные?
	2. Правильность данных
		2.1. Правильный ли логин/почта (регулярка)
			2.1.1 Логин/почта уже существует?
		2.2. Пароль ли нужной длинны? (от 8-ми)
	3. Формируем запрос из этих данных, экранируя все, что можно. (SELECT COUNT(*) FROM table WHERE login = $login, pass = $pass LIMIT 1)
	4. Выполняем запрос. Проверяем результат. (true || false)
		4.1. Если все нормально, то в сессию записываем соответствующую запись.
		4.2. Если нет, то говорим, что логин, или пароль неправильный

*/

?>
<!-- <form action="/user/login" method="post" class="form_login">
	<input type="text" name="login" placeholder="Ваш логин">
	<input type="password" name="password" placeholder="Ваш пароль">
	<input type="submit" value="ВОЙТИ">
</form> -->

