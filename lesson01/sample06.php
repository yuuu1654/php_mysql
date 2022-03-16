<?php
//jsonファイルを書き込もう
$json_sample = [
	"title" => "JSONサンプル",
	"items" => [
		"りんご",
		"みかん"
	]
	];

$json = json_encode($json_sample, JSON_UNESCAPED_UNICODE);
echo $json;
//file_put_contents("json_sample.json", $json);

?>