<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	変数の値 : <?php echo $value; ?>
	Cookieの値: <?php echo $_COOKIE["message"]; ?><br>
	Sessionの値: <?php echo $_SESSION["message"]; ?><br>
</body>
</html>