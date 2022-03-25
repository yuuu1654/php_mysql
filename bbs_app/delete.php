<?php
	session_start();
	require("function.php");
	require("dbconnect.php");

	//ログインしていないと一覧ページは表示しないようにする
	if (isset($_SESSION["name"]) && isset($_SESSION["id"])) {
			$id = $_SESSION["id"];
			$name = $_SESSION["name"];
	} else {
			header("Location: login.php");
			exit();
	}

	//DB接続共通化
	$db = dbconnect();
	
	header('Location: index.php'); exit();
?>
