<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
		//17 一年後までの日付を表示するカレンダー
		// $time = strtotime("+0 day");
		// $day = date("n/j(D)", $time);
		// echo $day."<br>";

		// $time = strtotime("+1 day");
		// $day = date("n/j(D)", $time);
		// echo $day."<br>";

		// $time = strtotime("+2 day");
		// $day = date("n/j(D)", $time);
		// echo $day."<br>";

		for ($i=0; $i<365; $i++):
			$time = strtotime("+".$i. "day");
			$day = date("n/j(D)", $time);
			echo $day."<br>";
		endfor;

		$hello = "こんにちは";
		echo '$hello<br>';
		echo "$hello<br>";
	?>
</body>
</html>