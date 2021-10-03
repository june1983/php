<?php
    session_start();
    require('../dbconnect.php');

    if (!isset($_SESSION['test'])) {
        header('Location: index.php');
        exit();
    }

    if (!empty($_POST)) {
        //登録処理
        $statement = $db->prepare('insert into members set name=?, email=?, password=?, picture=?, created=NOW()');
        echo $ret = $statement->execute(array(
            $_SESSION['test']['name'],
            $_SESSION['test']['email'],
            sha1($_SESSION['test']['password']),
            $_SESSION['test']['image']
        ));
        unset($_SESSION['test']);

        header('Location: thanks.php');
        exit();
    }


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="test.css" rel="stylesheet">
    <!-- BootstrapのCSS読み込み -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>

    <title>Document</title>
</head>
<body>
<?php require('../header.php');?>    
<main class="container flex-fill py-4 my-4 border shadow p-3 mb-5 bg-white rounded" style="max-width:500px;">   
    <form class="wrap" action="" method="post">
        <input type="hidden" name="action" value="submit" />
        <dl>
            <dt>ニックネーム</dt>
            <dd>
            <?php echo htmlspecialchars($_SESSION['test']['name'], ENT_QUOTES); ?>    
            </dd>
            <dt>メールアドレス</dt>
            <dd>
            <?php echo htmlspecialchars($_SESSION['test']['email'], ENT_QUOTES); ?>    
            </dd>
            <dt>パスワード</dt>
            <dd>
            [表示されません]
            </dd>
            <dt>写真など</dt>
            <dd>
            <img src="../member_picture/<?php echo htmlspecialchars($_SESSION['test']['image'], ENT_QUOTES); ?>" width="200" height="200" alt="">    
            </dd>
        </dl>
        <div><a href="index.php?action=rewrite">&laquo;&nbsp;書き直す</a> | <input type="submit" value="登録する" /></div>
    </form>
</main>  
<?php require('../footer.php');?>
</body>
</html>