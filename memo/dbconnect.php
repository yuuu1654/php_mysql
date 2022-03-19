<?php
	//db接続の処理
	$db = new mysqli("localhost", "root", "ekr33695", "mydb");
	$db->set_charset('utf8'); //文字化け防止
?>