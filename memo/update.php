<?php
	require("dbconnect.php");
	require("function.php");
	$stmt = $db->prepare("select * from memos where id=?");

	//エラー処理
	if (!$stmt){
		die($db->error);
	}

	$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT); 
	$stmt->bind_param("i", $id);
	$stmt->execute();
	
	$stmt->bind_result($id, $memo, $created_at);
	$result = $stmt->fetch();

	//データが正しく入っていなかったときの処理
	if(!$result){
		die("メモの指定が正しくありません");
	}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>メモの編集</title>
</head>
<body>
	<form action="update_do.php" method="POST">
		<!-- idを渡す為のinput -->
		<input type="hidden" name="id" value="<?php echo $id; ?>">
		<textarea name="memo" cols="50" rows="10" placeholder="メモを入力してください"><?php echo h($memo); ?></textarea><br>
		<button type="submit">編集する</button>
	</form>
</body>
</html>