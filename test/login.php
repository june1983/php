<?php 
  require("../dbconnect.php");
  session_start();

  if ($_COOKIE['email'] != '') {
    $_POST['email'] = $_COOKIE['email'];
    $_POST['password'] = $_COOKIE['password'];
    $_POST['save'] = 'on';
  }

  if (!empty($_POST)) {
    if ($_POST['email'] != '' && $_POST['password'] != '') {

      //DBに行ってデータを持ってくる
      $login = $db->prepare('select * from members where email=? AND password=?');
      $login -> bindParam(1,$_POST['email']);
      $login -> bindParam(2,sha1($_POST['password']));
      $login -> execute();
    
      $member = $login->fetch();

      if($member) {
        $_SESSION['id'] = $member['id'];
        $_SESSION['time'] = time();

          //ログイン情報を記録
          if ($_POST['save'] == 'on') {
            setcookie('email', $_POST['email'], time()+60*60*24*14);
            setcookie('password', $_POST['password'], time()+60*60*24*14);
          }

        header('Location: ../post.php');
        exit();

      } else {
        $error['login'] = 'failed';
      } 

    } else {
        $error['login'] = 'blank';
      }
    } 
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- BootstrapのCSS読み込み -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>
    <title>ログイン</title>
  </head>
  
  <body class="d-flex flex-column min-vh-100">
  <?php require('../header.php');?>
  <main class="container flex-fill py-4 my-4 border shadow p-3 mb-5 bg-white rounded" style="max-width:500px;">
  <h1>ログイン</h1>
    <form action="" method="post">
        <div class="row mb-3">
        <p>メールアドレスとパスワードを記入してログインしてください。</p>
        <p>入会手続きがまだの方はこちらからどうぞ。</p>
        <p>&raquo;<a href="test/">入会手続きをする</a></p>        
      </div>
        <div class="row mb-3">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="text" name="email" class="form-control" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>">
            <?php if (isset($error['login']) && $error['login'] == 'blank'): ?>
            <p>*メールアドレスとパスワードを記入ください</p>
            <?php endif; ?>
            <?php if (isset($error['login']) && $error['login'] == 'failed'): ?>
            <p>*ログインに失敗しました。正しくご記入ください</p>
            <?php endif; ?>
            </div>
        </div>
        <div class="row mb-3">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" name="password" class="form-control" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['password'], ENT_QUOTES); ?>">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-10 offset-sm-2">
            <div class="form-check">
                <input id="save" name="save" class="form-check-input" type="checkbox" value="on">
                <label class="form-check-label" for="save">
                次回からは自動的にログインする
                </label>
            </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">ログインする</button>
    </form>    
  </main>
  
    <?php require('../footer.php');?>
  </body>
  </html>
  