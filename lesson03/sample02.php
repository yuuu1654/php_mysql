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

		//文字化け防止
		function h($str){
			return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
		}

		//64: PHPでselect構文
		$records = $db->query("select count(*) as cnt from my_items");
		//var_dump($records);

		if ($records){
			while ($record = $records->fetch_assoc()){
				echo h($record["cnt"])."<br>";
			}
		}else{
			echo $db->error;
		}
	?>
</body>
</html>