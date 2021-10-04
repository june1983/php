<?php 
session_start();
require('dbconnect.php');

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

//投稿を記録する'
if(!empty($_POST)){
  if($_POST['message'] != '') {
    $message = $db->prepare('insert into posts set member_id=?, message=?, created=NOW()');
    $message->execute(array(
        $member['id'],
        $_POST['message']
    ));

    header('Location: post.php'); exit();
  }
}

    //$message = $db->prepare('INSERT INTO posts SET message=?, created=NOW()');
    //$message->execute(array($_POST['message']));


//投稿を取得する
$posts = $db->query('select m.name, m.picture, p.* from members m, posts p where m.id=p.member_id order by p.created desc');

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PlusUltra!!!!!</title>
    <link href="css/style.css" rel="stylesheet">
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
  </head>
  <body>
  <div class="container">
  <?php require('header.php');?>
  <div class="main-body p-0">
      <div class="inner-wrapper">      
          <!-- Inner sidebar -->
          <div class="inner-sidebar">
              <!-- Inner sidebar header -->

              <!-- /Inner sidebar header -->

              <!-- Inner sidebar body -->
              <div class="inner-sidebar-body p-0">
                  <div class="p-3 h-100" data-simplebar="init">
                      <div class="simplebar-wrapper" style="margin: -16px;">
                          <div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div>
                          <div class="simplebar-mask">
                              <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                  <div class="simplebar-content-wrapper" style="height: 100%; overflow: hidden scroll;">
                                      <div class="simplebar-content" style="padding: 16px;">
                                          <nav class="nav nav-pills nav-gap-y-1 flex-column">
                                              <a href="join/" class="nav-link nav-link-faded has-icon active">会員登録</a>
                                              <a href="join/login.php" class="nav-link nav-link-faded has-icon">ログイン</a>
                                              <a href="join/logout.php" class="nav-link nav-link-faded has-icon">ログアウト</a>
                                              <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">最近の投稿</a>
                                              <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">自分の投稿のみを表示</a>
                                              <a href="javascript:void(0)" class="nav-link nav-link-faded has-icon">未返信の投稿</a>
                                          </nav>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <div class="simplebar-placeholder" style="width: 234px; height: 292px;"></div>
                      </div>
                      <div class="simplebar-track simplebar-horizontal" style="visibility: hidden;"><div class="simplebar-scrollbar" style="width: 0px; display: none;"></div></div>
                      <div class="simplebar-track simplebar-vertical" style="visibility: visible;"><div class="simplebar-scrollbar" style="height: 151px; display: block; transform: translate3d(0px, 0px, 0px);"></div></div>
                  </div>
              </div>
              <!-- /Inner sidebar body -->
          </div>
          <!-- /Inner sidebar -->

          <!-- Inner main -->
          <div class="inner-main">
              <!-- Forum List -->
              <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">
                <div class="post-editor">
                    <form action="" method="post">
                        <dl>
                            <dt><?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?>さん、メッセージをどうぞ</dt>
                            <dd>
                            <textarea name="message" cols="50" rows="5"></textarea>
                            </dd>
                        </dl>
                        <div>
                            <input type="submit" value="投稿する"/>
                        </div>
                    </form>
                </div>

                <?php foreach($posts as $post):?>

                  <div class="card mb-2">
                      <div class="card-body p-2 p-sm-3">
                          <div class="media forum-item">
                            <a href="view.php?id=<?php echo htmlspecialchars($post['id'], ENT_QUOTES); ?>">
                              <img src="member_picture/<?php echo $post['picture'] ?>" class="mr-3 rounded-circle" width="50" alt="<?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?>" />
                              <div class="media-body">
                                
                                  <p class="text-secondary">
                                    <?php echo htmlspecialchars($post['message'], ENT_QUOTES); ?>
                                  </p>
                                  <p class="text-muted"><strong><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?></strong> posted <span class="text-secondary font-weight-bold"><?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?></span></p>
                                
                              </div>
                              <div class="text-muted small text-center align-self-center">
                                  <span class="d-none d-sm-inline-block"><i class="far fa-eye"></i> 19</span>
                                  <span><i class="far fa-comment ml-2"></i> 3</span>
                              </div>
                            </a>
                          </div>
                      </div>
                  </div>
                        

<?php
if($post['reply_post_id']>0):
?>
 <a href="view.php?id=<?php echo ($post['reply_post_id']);?>">返信元のメッセージ</a>
<?php
endif;
?>
<?php
if($_SESSION['id']==$post['member_id']):
?>
 [<a href="delete.php?id=<?php echo ($post['id']); ?>" style="color:#F33;">削除</a>]
<?php
endif;
?>

                <?php endforeach;?>
                  
                  <ul class="pagination pagination-sm pagination-circle justify-content-center mb-0">
                      <li class="page-item disabled">
                          <span class="page-link has-icon"><i class="material-icons">前のページ</i></span>
                      </li>
                      <li class="page-item"><a class="page-link" href="javascript:void(0)">1</a></li>
                      <li class="page-item active"><span class="page-link">2</span></li>
                      <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                      <li class="page-item">
                          <a class="page-link has-icon" href="javascript:void(0)"><i class="material-icons">次のページ</i></a>
                      </li>
                  </ul>
              </div>
              <!-- /Forum List -->
              <!-- /Inner main body -->
          </div>
          <!-- /Inner main -->
      </div>
  </div>
  <?php require('footer.php');?>
  </div>  
  </body>
</html>