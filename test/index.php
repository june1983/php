<?php
require('../dbconnect.php');
session_start();

$errors =[
    'name' => 0,
    'email' => 0,
    'password' => 0,
    'image' => 0,
];

if (!empty($_POST)) {

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
    $fileName = $_FILES['image']['name'];
    if (!empty($fileName)) {
        $ext = substr($fileName, -3);
        if ($ext != 'jpg' && $ext != 'gif') {
            $error['image'] = 'type';
        }
    }

    if (empty($error)) {
        //画像をアップロードする
        $image = date('YmdHis') . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/' . $image);
        $_SESSION['test'] = $_POST;
        $_SESSION['test']['image'] = $image;
        header('Location: check.php');
        exit();
    }
}




//書き直し
if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite') {
$_POST = $_SESSION['test'];
$error['rewrite'] = true;
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
            <input type="text" name="name" class="form-control" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['name'], ENT_QUOTES); ?>" />
            <?php if (!empty($error['name']) && $error['name'] == 'blank'): ?>
                <p class="error">* ニックネームを入力してください</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="text" name="email" class="form-control" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>" />
            <?php if (isset($error['email']) && $error['email'] == 'blank') : ?>
                <p class="error">* メールアドレスを入力してください</p>
            <?php endif; ?>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" name="password" class="form-control" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>" />
            <?php if (isset($error['password']) && $error['password'] == 'blank'): ?>
                <p class="error">* パスワードを入力してください</p>
            <?php endif; ?>
            <?php if (isset($error['password']) && $error['password'] == 'length'): ?>
                <p class="error">* パスワードは4文字以上で入力してください</p>
            <?php endif; ?>
        </div>
        <div class="row mb-3">
          <h5></h5>
          <input type="file" name="image" size="35">
          <?php if (isset($error['image']) && $error['image'] == 'type'): ?>
            <p clsaa="error">*写真などは「.gif」または「.jpg」の画像を指定してください</p>
            <?php endif; ?>
            <?php if (!empty($error)): ?>
            <p class="error">* 恐れ入りますが、画像を改めて指定してください</p>
            <?php endif; ?>
        </div>
        <input type="submit" class="btn btn-primary" value="入力内容を確認する">
        </div>
    </form>    

</main>
<?php require('../footer.php');?>
</body>
</html>