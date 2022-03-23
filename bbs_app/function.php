<?php
	//XSS対策 : エスケープ処理 (JSインジェクション)
	function h($str){
		return htmlspecialchars($str, ENT_QUOTES);
	}
?>