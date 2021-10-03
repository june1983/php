<?php 
  require("../dbconnect.php");
  session_start();

  if (isset($_SESSION['id']) && $_SESSION['time']+3600 > time()) {
    //ログインしている
    $_SESSION['time'] = time();

    $members = $db->prepare('select * from members where id=?');
    $members->execute(array($_SESSION['id']));
    $member = $members->fetch();
    } else {
        //ログインしていない
        header('Location: login.php'); exit();
    }


  
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="../css/cancel.css" rel="stylesheet">
    <!-- BootstrapのCSS読み込み -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>
    <title>退会する</title>
  </head>
  
  <body class="d-flex flex-column min-vh-100">
  <?php require('../header.php');?>
  <main class="container flex-fill py-4 my-4 border shadow p-3 mb-5 bg-white rounded" style="max-width:500px;">
  <h1>アカウント情報</h1>
  <div class="container-inside">
    <div class='deactivate__text'>
    <div class='deactivate__text__heading'>必ずご確認ください</div>
      <ul>
        <li class='u-mb10'>
        <p class='u-inline'>
        <?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?>さん、本当に退会しますか？
        </p>
        </li>
        <li>
        <p class='u-inline'>アカウントを削除すると、これまでのデータはすべて削除されます。</p>
        </li>
      </ul>
    </div>
    <div class="u-mb20">
      <p class='txt02'>
      よろしければ、理由をお書きください（任意、255字以内）
      </p>
      <textarea class="form-control contact-input" name="" id="" cols="50">
      </textarea>
    </div>
    <a href="delete.php?id=<?php echo $member['id']?>" class="btn btn-secondary">退会</a>
  </div>
  </main>
  
    <?php require('../footer.php');?>
  </body>
  </html>
  