<?php
    session_start();
    require("../function.php");
	require("../dbconnect.php");


    //配列の初期化
    if(isset($_GET["action"]) && $_GET["action"] === "rewrite" && isset($_SESSION["form"])){
        //書き直しリンクを押されてセッションに値が入っていた時
        $form = $_SESSION["form"];
        //var_dump($form);
    }else{
        $form = [
            "name" => "",
            "email" => "",
            "password" => "",
        ];
    }
    
    $error = [];



    //フォームが送信された時：
    if($_SERVER["REQUEST_METHOD"] === "POST"){

        /** ニックネームのチェック */
        $form["name"] = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        //エラーが起こった事を記録しておく→下のフォームの部分で表示する
        if($form["name"] === ""){
            $error["name"] = "blank";
        }

        /** メールアドレスのチェック */
        $form["email"] = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        //エラーメッセージ
        if($form["email"] === ""){
            $error["email"] = "blank";
        }else{
            $db = dbconnect();
            $stmt = $db->prepare("select count(*) from members where email = ?");
            //エラー処理
            if(!$stmt){
                die($db->error);
            }
            $stmt->bind_param("s", $form["email"]);
            
            //SQLの実行
            $success = $stmt->execute();
            //うまく実行されなかったときの処理
            if(!$success){
                die($db->error);
            }
            $stmt->bind_result($cnt);
            $stmt->fetch();
            
            //メールアドレスが重複している時
            if($cnt > 0){
                $error["email"] = "duplicate";
            }
        }

        /** パスワードのチェック */
        $form["password"] = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        //エラーメッセージ
        if($form["password"] === ""){
            $error["password"] = "blank";
        }else if(strlen($form["password"]) < 4){  //else ifにしてるのでpasswordが空ならここの判定は行われない
            $error["password"] = "length";
        }

        /** 画像のチェック */
        $image = $_FILES["image"];
        if($image["name"] !== "" && $image["error"] === 0){ //画像の名前が入っていて、エラーがなければ
            $type = mime_content_type($image["tmp_name"]);  //ファイルの形式を判断する為のファンクション
            //エラーメッセージ
            if($type !== "image/png" && $type !== "image/jpeg"){
                $error["image"] = "type";
            }
        }

        //エラーが無かったら確認画面に遷移する
        if(empty($error)){
            //セッションに値を格納して確認画面に渡す
            $_SESSION["form"] = $form;

            //画像のアップロード
            if($image["name"] !== ""){
                $filename = date("YmdHis")."_".$image["name"];
                if(!move_uploaded_file($image["tmp_name"], "../member_picture/".$filename)){ //①テンポラリーの名前　②実際の場所　
                    die("ファイルのアップロードに失敗しました");
                } 
                $_SESSION["form"]["image"] = $filename;
            }else{
                $_SESSION["form"]["image"] = "";
            }

            header("Location: check.php");
            exit(); //プログラムが終了する
        }
    }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>会員登録</title>

    <link rel="stylesheet" href="../style.css"/>
</head>

<body>
<div id="wrap">
    <div id="head">
        <h1>会員登録</h1>
    </div>

    <div id="content">
        <p>次のフォームに必要事項をご記入ください。</p>
        <form action="" method="post" enctype="multipart/form-data">
            <dl>
                <dt>ニックネーム<span class="required">必須</span></dt>
                <dd>
                    <input type="text" name="name" size="35" maxlength="255" value="<?php echo h($form["name"]); ?>"/>
                    <!-- エラーがあれば表示 -->
                    <?php if(isset($error["name"]) && $error["name"] === "blank"): ?>
                        <p class="error">* ニックネームを入力してください</p>
                    <?php endif; ?>
                </dd>
                <dt>メールアドレス<span class="required">必須</span></dt>
                <dd>
                    <input type="text" name="email" size="35" maxlength="255" value="<?php echo h($form["email"]); ?>"/>
                    <!-- エラーがあれば表示 -->
                    <?php if(isset($error["email"]) && $error["email"] === "blank"): ?>
                        <p class="error">* メールアドレスを入力してください</p>
                    <?php endif; ?>
                    <?php if(isset($error["email"]) && $error["email"] === "duplicate"): ?>
                        <p class="error">* 指定されたメールアドレスはすでに登録されています</p>
                    <?php endif; ?>
                <dt>パスワード<span class="required">必須</span></dt>
                <dd>
                    <input type="password" name="password" size="10" maxlength="20" value="<?php echo h($form["password"]); ?>"/>
                    <!-- エラーがあれば表示 -->
                    <?php if(isset($error["password"]) && $error["password"] === "blank"): ?>
                        <p class="error">* パスワードを入力してください</p>
                    <?php endif; ?>
                    <?php if(isset($error["password"]) && $error["password"] === "length"): ?>
                        <p class="error">* パスワードは4文字以上で入力してください</p>
                    <?php endif; ?>
                </dd>
                <dt>写真など</dt>
                <dd>
                    <input type="file" name="image" size="35" value=""/>
                    <!-- エラーがあれば表示 -->
                    <?php if(isset($error["image"]) && $error["image"] === "type"): ?>
                        <p class="error">* 写真などは「.png」または「.jpg」の画像を指定してください</p>
                    <?php endif; ?>
                    <p class="error">* 恐れ入りますが、画像を改めて指定してください</p>
                </dd>
            </dl>
            <div><input type="submit" value="入力内容を確認する"/></div>
        </form>
    </div>
</body>

</html>