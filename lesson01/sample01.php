<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php 
		echo "I\"m \"studying\"";  //エスケープシーケンス

		//10：計算
		echo 123+2*5;
		echo 156*5;

		//11 現在時刻の表示
		date_default_timezone_set("Asia/Tokyo");
		echo date("G時 i分 s秒\n");

		//12 文字列連結
		date_default_timezone_set("Asia/Tokyo");
		echo "現在は、".date("G時 i分 s秒\n")."です。";

		//13 オブジェクトで日付を扱う
		$today = new DateTime();
		$today->setTimezone(new DateTimeZone("Asia/Tokyo"));
		echo "現在の時刻は", $today->format("G時 i分 s秒\n"), "です。";
		
	?> 
	
</body>
</html>