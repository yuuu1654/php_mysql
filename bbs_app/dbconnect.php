<?php
	/**
	 * dbに接続する処理
	 */
	
	function dbconnect(){
		$db = new mysqli("localhost", "root", "ekr33695", "mini_bbs");
		$db->set_charset('utf8'); //文字化け防止

		//接続に失敗したらエラー表示
		if(!$db){
			die($db->error);
		}

		return $db;
	}
?>