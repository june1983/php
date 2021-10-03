<?php
require('../dbconnect.php');
session_start();

if (!empty($_POST)) {
    $error = array();

    //エラー項目の確認
    if ($_POST['name'] == '') {
        $error['name'] = 'blank';
    }
    if ($_POST['email'] == '') {
        $error['email'] = 'blank';
    }
    if (strlen($_POST['password']) < 4) {
        $error['password'] = 'length';
    }
    if ($_POST['password'] == '') {
        $error['password'] = 'blank';
    }

    if (empty($error)) {
        $_SESSION['test'] = $_POST;
        header('Location: check.php');
        exit();
    }

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <form action="" method="post" enctype="multipart/form-data">
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES); ?>" />
            <?php if($error['name'] == 'blank'):?>
                <p style="color: red;">*ニックネームを入力してください</p>
            <?php endif;?>    
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="text" name="email" class="form-control" value="<?php echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>" />
            <?php if($error['email'] == 'blank'):?>
                <p style="color: red;">*メールアドレスを入力してください</p>
            <?php endif;?>   
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" name="password" class="form-control" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>" />
            <?php if($error['password'] == 'blank'):?>
                <p style="color: red;">*パスワードを入力してください</p>
            <?php endif;?>   
            <?php if ($error['password'] == 'length'): ?>
                <p style="color: red;">*パスワードは4文字以上で入力してください</p>
            </div>
            <?php endif;?>
        </div>
        <div class="row mb-3">
          <h5></h5>
          <input type="file" name="image" size="35">
        </div>
        <input type="submit" class="btn btn-primary" value="入力内容を確認する">
        </div>
    </form>    

</main>
<?php require('../footer.php');?>
</body>
</html>