<?php

$age = "２３";

//全角数字を半角数字に変換する
$age = mb_convert_kana($age, "n", "UTF-8");

if (is_numeric($age)){
	echo $age."歳です<br>";
}else {
	echo "数字で入力して下さい";
}



//32: 正規表現
$zip = "123-4588888888867";

if (preg_match("/\A\d{3}[-]\d{4}\z/", $zip)) {
	echo "郵便番号 : 〒 $zip";
}else{
	echo "※　郵便番号を正しくご記入してください";
}

//33 別のページにジャンプしよう
header("Location: https://tomosta.jp");
exit();
?>