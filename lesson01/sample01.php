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
		
		//14変数
		$sum = 100 + 1050 + 200;

		$text = "あいうえお"."\n"."かきくけこ";
		echo $text;
	?> 

	<?php
		$sum = 199 + 201 * 67;
	?>
	<p>合計金額は、<?php echo $sum; ?>円です</p>
	<p>税込金額は、<?php echo $sum * 1.1; ?>円です</p>

	<?php
	//15 繰り返し構文
		$i = 1;
		

		// while ($i < 10){
		// 	$i = $i + 1;
		// 	echo $i."<br>";
		// }
		while ($i < 10):
			echo $i . "日<br>";
			$i += 1;
		endwhile;
	?>

	<?php
		for ($i=1; $i<101; $i++): 
			echo $i."<br>";
		endfor;
	?>
	
</body>
</html>