<?php
	$LOGIN_PATH = '../CS490/login.php';

	session_start();
	session_destroy();

	unset($_SESSION['teacher']);
	unset($_SESSION['student']);
	unset($_SESSION['logon']);
        unset($_SESSION['user']);

	header("Location:" . $LOGIN_PATH);
?>