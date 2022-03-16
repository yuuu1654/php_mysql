<?php
	//ファイルへの書き込み 
	
	$success = file_put_contents("news.txt", 
	"ホームページをリニューアルしました。");
	
	if ($success !== false){
		echo "ファイルの書き込みに成功しました。";
	} else {
		echo "ファイルの書き込みに失敗しました。";
	}


	if( isset($_POST["create_comment"]) && $_POST["create_comment"] ){
		if( !$_POST["comment"] ){
			$errmessage[] = "コメントを入力して下さい";
		}else if( mb_strlen($_POST["comment"]) > 500 ){
			$errmessage[] = "コメントは500文字以内で入力してください";
		}
		$_SESSION["comment"] = htmlspecialchars($_POST["comment"], ENT_QUOTES);  //無害化した文字列を代入
		

		if( $errmessage ){
			//エラーのみを表示して、コメントのDB登録はしない
		}else{
			// //コメントが重複していないかチェック
			// $resultDupComment = CommentLogic::searchDupComment($_SESSION);
			// if( $resultDupComment ){
			// 	//コメントを登録
			// 	CommentLogic::createComment($_SESSION);
			// }

			//コメントを登録
			CommentLogic::createComment($_SESSION);
			$_SESSION["comment"] = "";
			//リダイレクト
			header("Location: thread_detail.php?id=$id&page=$page");
			return;
		}
	}else{  //GETリクエスト
		
		$_SESSION["comment_id"] = "";
	}
	
?>
