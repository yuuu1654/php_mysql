<?php
	require("dbconnect.php");

	//最大ページ数を求める為にデータの件数を取得する
	$counts = $db->query("select count(*) as cnt from memos");
	$count = $counts->fetch_assoc();
	$max_page = floor(($count["cnt"]-1)/5 + 1);
	echo $max_page;

	$stmt = $db->prepare("select * from memos order by id desc limit ?, 5");

	//sqlが間違った時にエラーを表示する
	if (!$stmt){
		die($db->error);
	}

	//ページを指定する
	$page = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);
	// if(!$page){
	// 	$page = 1;  //デフォルトのページ数
	// }
	//三項演算子での条件分岐
	$page = ($page ?: 1);
	$start = ($page - 1)*5;

	$stmt->bind_param("i", $start);

	//sqlを実行する
	$result = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>メモ帳</title>
</head>
<body>
	<h1>メモ帳</h1>

	<p>→　<a href="input.html">メモの新規作成</a></p>
	<?php if ($result == ""): ?>
		<p>表示するメモはありませんねん</p>
	<?php endif; ?>
	<?php
		var_dump($result);
	?>
	
	<?php $stmt->bind_result($id, $memo, $created_at); ?>
	<?php while ($stmt->fetch()): ?>
		<div>
			<h2><a href="memo.php?id=<?php echo $id; ?>"><?php echo htmlspecialchars(mb_substr($memo, 0, 50)); ?></a></h2>
			<time><?php echo htmlspecialchars($created_at); ?></time>
		</div>
		<hr>
	<?php endwhile; ?>

	<!-- ページネーション実装 -->
	<p>
		<?php if ($page>1){ ?>
			<a href="?page=<?php echo $page-1; ?>"><?php echo $page-1; ?>ページ目へ</a> |
		<?php } ?>
		
		<?php if ($page < $max_page){ ?>
			<a href="?page=<?php echo $page+1; ?>"><?php echo $page+1; ?>ページ目へ</a>
		<?php } ?>
	</p>

</body>
</html>