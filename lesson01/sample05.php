<?php
	$xmlTree = simplexml_load_file("rss.xml");
	//echo $xmlTree->channel->title;
	var_dump($xmlTree);
?>

<?php
	//26 jsonの読み込み
	$file = file_get_contents("feed.json");
	$json = json_decode($file); //日本語に変換してくれる

	//タイトルを取得したい場合
	echo $json->title;
?>