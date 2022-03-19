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
		$db->query("insert into memos (memo) values('PHPからのメモですよん')");
		echo "データを挿入しました";
	?>
</body>
</html>