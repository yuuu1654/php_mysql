<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
		//18 配列
		$week_name = ["日", "月", "火", "水", "木", "金", "土"];
		//echo $week_name[6]."<br>";

		date_default_timezone_set('Asia/Tokyo');
		$week = date('w');
		echo "今日は、$week_name[$week]曜日です。<br>";
	?>

	<?php
		//19 連想配列
		$fruits = [
			"apple" => "りんご",
			"grape" => "ぶどう",
			"lemon" => "レモン",
			"peach" => "桃"
		];

		//echo $fruits["apple"];
	?>
	<dl>
		<?php foreach ($fruits as $english => $japanese): ?>
			<dt><?php echo $english ?></dt>
			<dt><?php echo $japanese ?></dt>
		<?php endforeach; ?>
	</dl>

	<?php
		//20 if構文
		$time = 1;
	?>
	<?php if ($time < 9){ ?>
		<p>※営業時間外です</p>
	<?php }else{ ?>
		<p>ようこそ！</p>
	<?php } ?>

	<?php
		$str = "";
		if ($str !== ""):
			echo "変数内に文字が入っています。";
		else:
			echo "変数内は空です。";
		endif;
	?>

	3000円のものから、100円値引きしたい場合、
	<?php echo ceil(100/3000 * 100); ?> %引きです（ceil:切りあげ）。<br>
	3000円のものから、100円値引きしたい場合、
	<?php echo floor(100/3000 * 100); ?> %引きです（floor:切りすて）。<br>
	3000円のものから、100円値引きしたい場合、
	<?php echo round(100/3000 * 100); ?> %引きです（round:四捨五入）。<br>

	<?php
		// 22 文字のフォーマットを整える
		$date = sprintf("%04d.%02d.%02d", 22, 3, 8);
		echo "$date<br>";

		$str = sprintf("%04s", 1234);
		echo $str;

	?>
</body>
</html>