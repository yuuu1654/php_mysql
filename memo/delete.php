<?php
	require("dbconnect.php");
	require("function.php");

	$stmt = $db->prepare("delete from memos where id=?");

	//エラー処理
	if(!$stmt){
		die($db->error);
	}

	//aタグからidを受け取る
	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
	$stmt->bind_param("i", $id);
	$result = $stmt->execute();

	//データが正しく入っていなかったときの処理
	if(!$result){
		die("メモの指定が正しくありません");
	}

	header("Location: index.php");
?>

