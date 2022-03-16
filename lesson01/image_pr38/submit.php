<?php
	//38 画像アップロード
	$file = $_FILES["picture"];
	var_dump($file);

	//送信されたファイルが画像形式のものだけ、受け取ったファイルを保存する
	if ($file["type"] === "image/jpeg" || $file["type"] === "image/png"){

		$path = "images/".$file["name"];

		$success = move_uploaded_file($file["tmp_name"], $path);

		if ($success){
			echo "成功しました";
		}else{
			echo "失敗しました";
		}
	}else{
		echo "画像を選択してください！！";
	}
?>