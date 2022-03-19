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
		//$db->query("create table test2(id INT, point INT, preview TEXT)");

		$db->query("drop table test if exists test");
		$success = $db->query("create table test(id INT)");
		//var_dump($success);

		if ($success){
			echo "テーブルを削除して、作成しました。";
		}else{
			echo "SQLが正常に動作しませんでした";
			echo $db->error;
		}
	?>
</body>
</html>