<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <!-- BootstrapのCSS読み込み -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
<body>
    <?php
    session_start();
    require('../dbconnect.php');

    if (!isset($_SESSION['join'])) {
        header('location: index.php');
        exit();
    }
 

    if (!empty($_POST)) {
        //登録処理をする
        $statement = $db->prepare('INSERT INTO members SET name=?, email=?, password=?, picture=?, created=NOW()');
        echo $ret = $statement->execute(array(
            $_SESSION['join']['name'],
            $_SESSION['join']['email'],
            sha1($_SESSION['join']['password']),
            $_SESSION['join']['image']
        ));
        unset($_SESSION['join']);

        header('Location: thanks.php');
        exit();
    }
    ?>
    
    <form action="" method="post">
        <input type="hidden" name="action" value="submit" />
        <dl>
            <dt>ニックネーム</dt>
            <dd>
            <?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); ?>
            </dd>
            <dt>メールアドレス</dt>
            <dd>
            <?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES); ?>
            </dd>
            <dt>パスワード</dt>
            <dd>
            [表示されません]
            </dd>
            <dt>写真など</dt>
            <dd>
            <img src="../member_picture/<?php echo htmlspecialchars($_SESSION['join']['image'], ENT_QUOTES); ?>" width="100" height="100" alt="" />
            </dd>
        </dl>
        <div><a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="登録する" /></div>
    </form>
</body>
</html>