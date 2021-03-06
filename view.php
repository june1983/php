<?php
session_start();
require('dbconnect.php');

if (empty($_REQUEST['id'])) {
	header('Location:index.php');exit();
}

//投稿を取得する
$posts = $db->prepare('SELECT m.name,m.picture, p.* FROM members m,posts p WHERE m.id=p.member_id AND p.id=? ORDER BY p.created DESC');
$posts->execute(array($_REQUEST['id']));

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>投稿内容｜PlusUltra!!</title>
    <link href="css/view.css" rel="stylesheet">
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
  </head>
<body>
<?php require('header.php');?>
<main class="container flex-fill py-4 my-4 border shadow p-3 mb-5 bg-white rounded">

  <div class="m-5" id="wrap">
    <div class="wrapper" id="content">
    <!-- 下記コードは消さないで下さい。ログイン時はpost.php 非ログイン時はindex.phpへ遷移 --> 
    <?php if(isset($_SESSION['id'])){
          $urlpass = 'post.php';
        } else {
          $urlpass = 'index.php';
        }
        ?> 
    <p>&laquo;<a href="<?php echo $urlpass;?>">一覧に戻る</a></p>
    <?php
    if ($post = $posts->fetch()):
    ?>
    <div class="p-3">
      <div class="msg">
        <img src="member_picture/<?php echo htmlspecialchars($post['picture'], ENT_QUOTES); ?>" class="mr-3 rounded-circle" width="50" height="50" alt="<?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?>" />
        
        <p><?php echo htmlspecialchars($post['message'], ENT_QUOTES); ?></p>
        
        <?php if(isset($post['image']) && $post['image'] != ''): ?> 
        <img class="msg-img" src="member_picture/<?php echo htmlspecialchars($post['image'], ENT_QUOTES); ?>">
        <?php endif?>
        
        <p class="day"><?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?></p>
        
        <?php if(isset($_SESSION['id']) && $_SESSION['id']==$post['member_id']):?>
          <a class="delete-button" href="delete.php?id=<?php echo ($post['id']); ?>">投稿を削除する</a>
        <?php endif;?> 
      </div>
    </div>
    <?php
    else:
    ?>
      <p class="text-danger">その投稿は削除されたか、URLが間違っています</p>
    <?php
    endif;
    ?>
	  </div>
  </div>
</main>  
<?php require('footer.php');?>
</body>
</html>


