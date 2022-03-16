<?php
	require_once "intax.php";

	$price = 300;
	$price_tax = intax($price);
	echo $price_tax;
?>