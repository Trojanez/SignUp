<?php

	$link = mysqli_connect("localhost", "Max", "516201", "Signup");


	if(isset($_POST['button'])){
	$login = htmlspecialchars($_POST['login']);
	$login = mysqli_real_escape_string($link, $login);
	$email = $_POST['email'];
	$email = mysqli_real_escape_string($link, $email);
	$password1 = md5($_POST['password1']);
	$password1 = mysqli_real_escape_string($link, $password1);
	$password2 = md5($_POST['password2']);
	$password2 = mysqli_real_escape_string($link, $password2);

	// регистрируем

	$errors = array();
	if( $_POST['login'] == '' ){
		$errors[] = "Введите логин!";
	}

	if( $_POST['email'] == '' ){
		$errors[] = "Введите email!";
	}

	if ($_POST['password1'] == '' ){
		$errors[] = "Введите пароль";
	}
	if ($_POST['password2'] != $_POST['password1']){
		$errors[] = "Повторный пароль введен неверно";
	}
	if ($_POST['password2'] != $_POST['password1']){
                $errors[] = "Повторный пароль введен неверно";
        }

	$result = mysqli_query($link, 'SELECT * FROM Sign_up WHERE login = "'.$login.'"');
	$myrow = mysqli_fetch_array($result);
	if (!empty($myrow['login'])){
		$errors[] = "Пользователь с данным логином уже существует!";
	}
	$result = mysqli_query($link, 'SELECT * FROM Sign_up WHERE email = "'.$email.'"');
        $myrow = mysqli_fetch_array($result);
        if (!empty($myrow['email'])){
        	$errors[] = "Пользователь с данным email'ом уже существует!";
	}

	if(empty($errors)){
	echo "Вы зарегистрированы!";

	mysqli_query ($link, 'INSERT INTO Sign_up (login,email,password) VALUES ("' . $login . '", "' .$email . '", "' . $password2 . '")');
	} else echo array_shift($errors);
}
?>

