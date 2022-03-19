<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
		//db接続
		$db = new mysqli("localhost", "root", "ekr33695", "mydb");
		$message = "フォームからのメモです";
		//$ret = $db->query("insert into memos (memo) values('PHPからのメモですよん')");
		
		$stmt = $db->prepare("insert into memos(memo) values(?)");
		if (!$stmt):
			die($db->error);
		endif;
		$stmt->bind_param("s", $message);
		$ret = $stmt->execute();

		if ($ret){
			echo "データを挿入しました";
		}
	?>
</body>
</html>