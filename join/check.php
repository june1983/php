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
     <!-- cssの読み込み -->
     <link href="../css/check.css" rel="stylesheet">

    <title>会員登録</title>

    
</head>
<body class="d-flex flex-column min-vh-100">
    
<?php require('../header.php');?>

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
    <main  class="container flex-fill py-4 my-4 border shadow p-3 mb-5 bg-white rounded" style="max-width:500px;">
    <form action="" method="post" class="form">
        <input type="hidden" name="action" value="submit" />
        <dl>
        <div class="d-flex bd-highlight align-items-center">
            <div class="p-2 flex-fill bd-highlight">
                <dt class="dt"></dt>
                    <dd>
                        <img class="rounded-circle" src="../member_picture/<?php echo htmlspecialchars($_SESSION['join']['image'], ENT_QUOTES); ?>" width="170" height="170" alt="" />
                    </dd>
            </div>
            <div class="p-2 flex-fill bd-highlight form2">
                <dt class="dt">ニックネーム</dt>
                <dd>
                    <?php echo htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES); ?>
                </dd>
                <dt class="dt">メールアドレス</dt>
                <dd>
                    <?php echo htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES); ?>
                </dd>
                <dt class="dt">パスワード</dt>
                <dd>
                    <?php echo htmlspecialchars($_SESSION['join']['password'], ENT_QUOTES); ?>
                </dd>
            </div>
        </div>           
            
            
        </dl>
        <div><a href="index.php?action=rewrite " class="btn btn-outline-secondary">&laquo;&nbsp;書き直す</a>  <button type="submit" class="btn btn-outline-primary">登録する</button></div>
    </form>
    </main>
    <?php require('../footer.php');?>
</body>
</html>