<?php
    session_start();
    require("function.php");
    require("dbconnect.php");

    //ログインしていないと詳細ページは表示しないようにする
    if (isset($_SESSION["name"]) && isset($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $name = $_SESSION["name"];
    } else {
        header("Location: login.php");
        exit();
    }

    $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    if (!$id) {
        header("Location: index.php");
        exit();
    }

    //DB接続共通化
    $db = dbconnect();
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
        <p>&laquo;<a href="index.php">一覧にもどる</a></p>
        <!-- ポスト一覧を取得する為のテーブル結合 -->
        <?php 
            $stmt = $db->prepare("select p.id, p.member_id, p.message, p.created_at, m.name, m.picture from posts p, members m where m.id=p.member_id and p.id=? order by id desc"); 
            if (!$stmt) {
                die($db->error);
            }
            //投稿のidを指定して検索 → 詳細ページ一件だけ取得
            $stmt->bind_param("i", $id);
            $success = $stmt->execute();
            if (!$success) {
                die($db->error);
            }
            //取得結果を一時保存
            $stmt->bind_result($id, $member_id, $message, $created_at, $name, $picture);
            
        ?>
        <?php if ($stmt->fetch()): ?>
            <div class="msg">
                <?php if ($picture): ?>
                    <img src="member_picture/<?php echo h($picture); ?>" width="48" height="48" alt=""/>
                <?php endif; ?>
                <p><?php echo h($message); ?><span class="name">（<?php echo h($name); ?>）</span></p>
                <p class="day"><a href="view.php?id="><?php echo h($created_at); ?></a>
                    [<a href="delete.php?id=<?php echo h($id); ?>" style="color: #F33;">削除</a>]
                </p>
            </div>
        <?php else: ?>
            <p>その投稿は削除されたか、URLが間違えています</p>
        <?php endif; ?>
    </div>
</div>
</body>

</html>