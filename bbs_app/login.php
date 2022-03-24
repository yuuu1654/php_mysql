<?php
    session_start();
    require("function.php");
	require("dbconnect.php");

    //配列の初期化
    $error = [];
    $email = "";
    $password = "";

    //フォームからポスト送信された時の処理
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        //フォームの内容を受け取る
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING); //平文のパスワード

        //フォームが空欄の時の処理
        if ($email === "" || $password === ""){
            $error["login"] = "blank";
        }else{
            //ログインチェック
            $db = dbconnect();
            //SQL文のセット
            $stmt = $db->prepare("select id, name, password from members where email=? limit 1"); //limitで会員のメールアドレスの流出を防ぐ
            if (!$stmt){
                die($db->error);
            }
            //データの受け取り
            $stmt->bind_param("s", $email);
            $success = $stmt->execute();
            if (!$success){
                die($db->error);
            }
            $stmt->bind_result($id, $name, $hash);
            $stmt->fetch();

            //入力されたパスワードと保存されているハッシュ化されたパスワードを照合
            //password_verify($password, $hash)
            $password_hash = $_SESSION["password"];
            var_dump($password_hash);
            var_dump($hash);
            if ($password_hash === $hash){
                //ログイン成功
                echo "ログイン成功しました";
                session_regenerate_id();  //セッションハイジャック対策
                $_SESSION["id"] = $id;
                $_SESSION["name"] = $name;
                header("Location: index.php");
                exit();
            } else {
                // var_dump($password_hash);
                // var_dump($hash);
                $error["login"] = "failed";
            }
        }
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <title>ログインする</title>
</head>

<body>
<div id="wrap">
    <div id="head">
        <h1>ログインする</h1>
    </div>
    <div id="content">
        <div id="lead">
            <p>メールアドレスとパスワードを記入してログインしてください。</p>
            <p>入会手続きがまだの方はこちらからどうぞ。</p>
            <p>&raquo;<a href="join/">入会手続きをする</a></p>
        </div>
        <form action="" method="post">
            <dl>
                <dt>メールアドレス</dt>
                <dd>
                    <input type="text" name="email" size="35" maxlength="255" value="<?php echo h($email); ?>"/>
                    <?php if (isset($error["login"]) && $error["login"] === "blank"): ?>
                        <p class="error">* メールアドレスとパスワードをご記入ください</p>
                    <?php endif; ?>
                    <?php if (isset($error["login"]) && $error["login"] === "failed"): ?>
                        <p class="error">* ログインに失敗しました。正しくご記入ください。</p>
                    <?php endif; ?>
                </dd>
                <dt>パスワード</dt>
                <dd>
                    <input type="password" name="password" size="35" maxlength="255" value="<?php echo h($password); ?>"/>
                </dd>
            </dl>
            <div>
                <input type="submit" value="ログインする"/>
            </div>
        </form>
    </div>
</div>
</body>
</html>
