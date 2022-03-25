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

	$post_id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
	if (!$post_id) {
		header("Location: index.php");
		exit();
	}

	$db = dbconnect();
	$stmt = $db->prepare("delete from posts where id=? and member_id=? limit 1"); //全件削除の事故を防ぐ為のlimit
	if (!$stmt) {
		die($db->error);
	}
	$stmt->bind_param("ii", $post_id, $id);
	//$stmt->bind_param("i", $post_id);
	$success = $stmt->execute();
	if (!$success) {
		die($db->error);
	}

	header('Location: index.php'); exit();
?>
