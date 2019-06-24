<?php 
session_start();
include '/config/database_connect.php';
include '/config/debug_functions.php';
include '/config/way_functions.php';

if(isset($_SESSION["session_username"])){
// If session exist, redirect to main page
header("Location: /");
}

if ($_POST['login']) {

	$login = mysqli_real_escape_string($dbConnect, htmlspecialchars($_POST['username']));
	$pass = mysqli_real_escape_string($dbConnect, htmlspecialchars($_POST['password']));

	// setcookie('user', $login);
	if ($login && $pass) {
		$loginQuery = "SELECT * FROM user WHERE `nickname` = '$login' OR `email` = '$login'";
		$loginResult = mysqli_query($dbConnect, $loginQuery);

		$loginRow = mysqli_fetch_assoc($loginResult);

		if ($loginRow['password'] === $pass) {
			$_SESSION['session_username'] = $loginRow['name'];
			header('Location: /');
		} else {
			$message = "Неправильные имя пользователя или пароль";
		}
	} elseif (!$login && $pass) {
		$message =  "Не введен логин<br>";		
	} elseif (!$pass && $login) {
		$message = "Не введен пароль<br>";		
	} else {
		$message = "Введите данные";
	}
}

include '/config/doc_head.html';

?>


<h1 class="login-head">Geek.Shop радиодетали</h1>
<?php 
	if ($message) {
		echo "<h3 class='message'>".$message."</h3>"; 
	}
	
?>
<form action="" method="post" id="login-user">
	<input type="text" name="username" placeholder="Логин или email">
	<input type="password" name="password" placeholder="Пароль">
	<input type="submit" name="login" value="Войти">
	<a href="/register" class="register-link">Зарегистрироваться</a>
</form>
