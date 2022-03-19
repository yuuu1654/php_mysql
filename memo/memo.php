<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>メモ詳細</title>
</head>
<body>
	<?php
		require("dbconnect.php");
		//$memos = $db->query("select * from memos where id=21"); フォームと連携するので危険なので使わない
		$stmt = $db->prepare("select * from memos where id=?");

		//エラー処理
		if (!$stmt){
			die($db->error);
		}

		//$id = 16; //仮
		//$id = $_GET["id"];  //GETリクエストで飛んできたidを取得する
		$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_SPECIAL_CHARS);
		var_dump($id);
		$stmt->bind_param("i", $id);
		$stmt->execute();

		$stmt->bind_result($id, $memo, $created_at);
		$stmt->fetch();
	?>

	<div><pre><?php echo htmlspecialchars($memo); ?></pre></div>
	<a href="update.php?id=<?php echo $id; ?>">編集する</a> | 
	<a href="delete.php?id=<?php echo $id; ?>">削除する</a> |
	<a href="index.php">メモ一覧画面へ</a>
	
</body>
</html>