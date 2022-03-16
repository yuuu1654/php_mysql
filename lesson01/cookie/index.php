<?php
	$value = "変数に保存した値です";
	//cookieに値を保存してページを跨げるようにする
	setcookie("message", "Cookieに保存した値です", time() + 60 * 60 * 24 * 14);

	//36 セッションに値を保存
	session_start();
	session_regenerate_id(); //セッションを使う一番初めのページで使う

	$_SESSION["message"] = "セッションに保存した値です";
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<a href="page02.php">2ページ目</a>
</body>
</html>