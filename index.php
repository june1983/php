<?php 
require('dbconnect.php');

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
  </head>
  <body>
  <?php require('header.php');?>
  <div class="container">
  <div class="main-body p-0">
      <div class="inner-wrapper">      
          <!-- Inner sidebar -->
          <div class="inner-sidebar">
              <!-- Inner sidebar body -->
              <div class="inner-sidebar-body p-0">
                  <div class="p-3 h-100" data-simplebar="init">
                      <div class="simplebar-wrapper" style="margin: -16px;">
                          <div class="simplebar-height-auto-observer-wrapper"><div class="simplebar-height-auto-observer"></div></div>
                          <div class="simplebar-mask">
                              <div class="simplebar-offset" style="right: 0px; bottom: 0px;">
                                  <div class="simplebar-content-wrapper" style="height: 100%;">
                                      <div class="simplebar-content" style="padding: 16px;">
                                          <nav class="nav nav-gap-y-1 flex-column">
                                              <a href="join/" class="nav__link nav-link-faded has-icon active">会員登録</a>
                                              <a href="join/login.php" class="nav__link nav-link-faded has-icon">ログイン</a>
                                          </nav>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!-- /Inner sidebar body -->
          </div>
          <!-- /Inner sidebar -->

          <!-- Inner main -->
          <div class="inner-main">
              <!-- Forum List -->
              <div class="inner-main-body p-2 p-sm-3 collapse forum-content show">

                <?php foreach($posts as $post):?>

                    <div class="card mb-2">
                        <a href="view.php?id=<?php echo htmlspecialchars($post['id'], ENT_QUOTES); ?>">
                        <div class="card-body p-2 p-sm-3">
                            <div class="media forum-item">
                                    <div class="img-box">  
                                    <img src="member_picture/<?php echo $post['picture'] ?>" class="mr-3 rounded-circle" width="50" height="50" alt="<?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?>" />
                                    </div>
                                    <div class="media-body">
                                        
                                        <p class="">
                                            <?php echo htmlspecialchars($post['message'], ENT_QUOTES); ?>
                                        </p>
                                        <p class="text-muted"><strong><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?></strong> posted <span class="text-secondary font-weight-bold"><?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?></span></p>
                                        
                                    </div>
                            </div>
                        </div>
                        </a>
                    </div>
                  
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