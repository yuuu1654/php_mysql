<?php
    session_start();
    require("function.php");
    require("dbconnect.php");

    //ログインしていないと一覧ページは表示しないようにする
    if (isset($_SESSION["name"]) && isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $name = $_SESSION["name"];
    } else {
        header("Location: login.php");
        exit();
    }

    //DB接続共通化
    $db = dbconnect();

    //メッセージの投稿
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_STRING);
        var_dump($message);

        
        $stmt = $db->prepare("insert into posts (message, member_id) values(?, ?)");
        if (!$stmt) {
            die($db->error);
        }

        $stmt->bind_param("si", $message, $id);
        $success = $stmt->execute();
        if (!$success) {
            die($db->error);
        }

        //postの内容をクリアにする為に自分自身のページを呼び出す(２重登録防止)
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ひとこと掲示板</title>

    <link rel="stylesheet" href="style.css"/>
</head>

<body>
<div id="wrap">
    <div id="head">
        <h1>ひとこと掲示板</h1>
    </div>
    <div id="content">
        <div style="text-align: right"><a href="logout.php">ログアウト</a></div>
        <form action="" method="post">
            <dl>
                <dt><?php echo h($name); ?>さん、メッセージをどうぞ</dt>
                <dd>
                    <textarea name="message" cols="50" rows="5"></textarea>
                </dd>
            </dl>
            <div>
                <p>
                    <input type="submit" value="投稿する"/>
                </p>
            </div>
        </form>

        <!-- ポスト一覧を取得する為のテーブル結合 -->
        <?php 
            $stmt = $db->prepare("select p.id, p.member_id, p.message, p.created_at, m.name, m.picture from posts p, members m where m.id=p.member_id order by id desc"); 
            if (!$stmt) {
                die($db->error);
            }
            $success = $stmt->execute();
            if (!$success) {
                die($db->error);
            }
            //取得結果を一時保存
            $stmt->bind_result($id, $member_id, $message, $created_at, $name, $picture);
            
        ?>
        <?php while ($stmt->fetch()): ?>
            <div class="msg">
                <?php if ($picture): ?>
                    <img src="member_picture/<?php echo h($picture); ?>" width="48" height="48" alt=""/>
                <?php endif; ?>
                <p><?php echo h($message); ?><span class="name">（<?php echo h($name); ?>）</span></p>
                <p class="day"><a href="view.php?id="><?php echo h($created_at); ?></a>
                    [<a href="delete.php?id=" style="color: #F33;">削除</a>]
                </p>
            </div>
        <?php endwhile; ?>
    </div>
</div>
</body>

</html>