<?php
	//39 独自のファンクションの作成

	function intax($value){
		return ceil($value * 1.1);
	}

	$price = 148495;
	$price_tax = intax($price);
	echo $price_tax;
?>
