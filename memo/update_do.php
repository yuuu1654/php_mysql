<?php
	require("dbconnect.php");
	require("function.php");

	$stmt = $db->prepare("update memos set memo=? where id=?");

	//エラー処理
	if (!$stmt):
		die($db->error);
	endif;

	//フォームからの値の受け取り
	$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
	$memo = filter_input(INPUT_POST, "memo", FILTER_SANITIZE_STRING);

	$stmt->bind_param("si", $memo, $id);
	$result = $stmt->execute();

	if($result){
		// echo "編集完了しました";
		// echo "<br> → <a href=\"index.php\">トップに戻る</a>";
		header("Location: memo.php?id=$id");
	}else{
		die($db->error);
	}
	








	
	// $stmt->bind_param("s", $memo);
	// $ret = $stmt->execute();

	// if ($ret):
	// 	echo "登録完了しました。";
	// 	echo "<br> → <a href=\"index.php\">トップに戻る</a>";
	// else:
	// 	$db->error;
	// endif;
?>
