<?php
	// $name = $_GET["my_name"];
	//$name = $_POST["my_name"];
	//var_dump($name);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>sample_form</title>
</head>
<body>
	<!-- <p>お名前 : <?php //echo $name ?></p> -->
	
	
	<?php if (isset($_POST["my_name"]) && $_POST["my_name"]): ?>
		<p>お名前 : <?php echo htmlspecialchars($_POST["my_name"], ENT_QUOTES); ?></p>
	<?php endif; ?>

	<?php if(!empty($_POST["my_name"])): ?>
		<p>お名前 : <?php echo htmlspecialchars($_POST["my_name"], ENT_QUOTES); ?></p>
	<?php endif; ?>
</body>
</html>