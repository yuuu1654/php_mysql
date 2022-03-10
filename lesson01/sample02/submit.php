<?php
	$reserves = $_POST["reserve"];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<h2>ご予約日</h2>
	<ul>
		<?php foreach ($reserves as $reserve): ?>
			<li><?php echo htmlspecialchars($reserve, ENT_QUOTES); ?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>