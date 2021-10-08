<?php
require('../dbconnect.php');
    session_start();

    if (!empty($_POST)) {
        // エラー項目の確認
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
            if ($ext != 'jpg' && $ext != 'gif' && $ext !='png') {
                $error['image'] = 'type';
            }
        }


        //重複アカウントのチェック
        if (empty($error)) {
            $member = $db->prepare('SELECT COUNT(*) AS cnt FROM members WHERE email=?');
            $member->execute(array($_POST['email']));
            $record = $member->fetch();
            if ($record['cnt'] > 0) {
                $error['email'] = 'duplicate';
            }
        }
    
        if (empty($error)) {
            //画像をアップロードする
            $image = date('YmdHis') . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], '../member_picture/' . $image);
            $_SESSION['join'] = $_POST;
            $_SESSION['join']['image'] = $image;
            $_SESSION["join"]["name"] = $_POST["name"];
            $_SESSION["join"]["email"] = $_POST["email"];

            header('Location: check.php');
            exit();
        }
    }else{

    }
    
   

    //書き直し
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'rewrite') {
        $_POST = $_SESSION['join'];
        $error['rewrite'] = true;
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BootstrapのCSS読み込み -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>
     <!-- cssの読み込み -->
     <link href="../css/index.css" rel="stylesheet">
    <title>会員登録｜PlusUltra!!</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php require('../header.php');?>
    <main class="container flex-fill py-4 my-4 border shadow p-3 mb-5 bg-white rounded" style="max-width:500px;">
    <h2>会員登録</h2>
    <form action="" method="post" enctype="multipart/form-data" class="container mw-500px" >
        <dl>
            <div class="form-floating">
                <input type="text" name="name"  class="form-control" id="floatingPassword" placeholder="Password" max-width="50%" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['name'], ENT_QUOTES); ?>" />
                <label for="floatingPassword">ニックネーム</label>
            </div>
            <!-- <dt>ニックネーム<span class="required">必須</span></dt> -->
            <dd>
                <!-- <input type="text" name="name" size="35" maxlength="255" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['name'], ENT_QUOTES); ?>" /> -->
                <?php if (!empty($error['name']) && $error['name'] == 'blank'): ?>
                <p class="error">* ニックネームを入力してください</p>
                <?php endif; ?>
                
            </dd>
            <div class="form-floating mb-3">
                <input type="email"  name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>"/>
                <label for="floatingInput">メール </label>
            </div>
            <!-- <dt>メールアドレス<span class="required">必須</span></dt> -->
            <dd>
                <!-- <input type="text" name="email" size="35" maxlength="255" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>"/> -->
                <?php if (isset($error['email']) && $error['email'] == 'blank') : ?>
                <p class="error">* メールアドレスを入力してください</p>
                <?php endif; ?>
                <?php if (isset($error['email']) && $error['email'] == 'duplicate'): ?>
                <p class="error">* 指定されたメールアドレスはすでに登録されています</p>
                <?php endif; ?>
            </dd>
            <div class="form-floating">
                <input type="password" name="password"  class="form-control" id="floatingPassword" placeholder="Password" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>"/>
                <label for="floatingPassword">パスワード</label>
            </div>
            <!-- <dt>パスワード<span class="required">必須</span></dt> -->
            <dd>
                <!-- <input type="password" name="password" size="10" maxlength="20" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>"/> -->
                <?php if (isset($error['password']) && $error['password'] == 'blank'): ?>
                <p class="error">* パスワードを入力してください</p>
                <?php endif; ?>
                <?php if (isset($error['password']) && $error['password'] == 'length'): ?>
                <p class="error">* パスワードは4文字以上で入力してください</p>
                <?php endif; ?>
            </dd>
            <dt class="center"><label for="formFile" class="form-label">写真</label></dt>
            <dd>
                <div class="mb-3">
                    <input class="form-control" type="file" id="formFile"  name="image" />
               
                    <?php if (isset($error['image']) && $error['image'] == 'type'): ?>
                    <p clsaa="error">*写真などは「.gif」「.png」「.jpg」の画像を指定してください</p>
                    <?php endif; ?>
                    <?php if (!empty($error)): ?>
                    <p class="error">* 恐れ入りますが、画像を改めて指定してください</p>
                    <?php endif; ?>
                </div>

                  
            </dd>
        </dl>
        <div class=button><button type="submit" class="btn btn-outline-primary">入力内容を確認する</button></div>
    </form>
    </main>
    <?php require('../footer.php');?>
</body>
</html>