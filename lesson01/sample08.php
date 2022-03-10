<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<table>
		<?php for ($i=1; $i<=10; $i++): ?>
			<?php if($i % 4 === 1){ ?>
				<tr>
					<td><?php echo $i; ?>行目</td>
					<td>ABC</td>
				</tr>
			<?php }else{ ?>
				<tr style="background-color: #ccc">
					<td><?php echo $i; ?>行目</td>
					<td>ABC</td>
				</tr>
			<?php } ?>
		<?php endfor; ?>
	</table>
</body>
</html>