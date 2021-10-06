<head>
<link rel="stylesheet" href="/plusultra/css/header-style.css">
</head>
<header>
  <div class="collapse" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">投稿しよう</h4>
          <p class="">趣味や好きなゲームなど、あなたに関する情報を追加しましょう。いくつかの文を書いておくと、共通の趣味を持つ友人を見つける手助けになるかもしれません。</p>
        </div>
        <div class="col-sm-4 offset-md-1 py-4">
          <h4 class="text-white">アカウント</h4>
          <ul class="list-unstyled">
            <li><a href="/plusultra/join/index.php" class="text-white">会員登録</a></li>
            <li><a href="/plusultra/join/login.php" class="text-white">ログイン</a></li>
            <li><a href="/plusultra/join/logout.php" class="text-white">ログアウト</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark shadow-sm">
    <div class="container">
      <!-- 下記コードは消さないで下さい。ログイン時はpost.php 非ログイン時はindex.phpへ遷移 --> 
      <?php if(isset($_SESSION['id'])){
        $urlpass = 'post.php';
      } else {
        $urlpass = 'index.php';
      }
      ?> 
      <a href="/plusultra/<?php echo $urlpass;?>" class="navbar-brand d-flex align-items-center">
      <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-emoji-sunglasses" viewBox="0 0 16 16">
        <path d="M4.968 9.75a.5.5 0 1 0-.866.5A4.498 4.498 0 0 0 8 12.5a4.5 4.5 0 0 0 3.898-2.25.5.5 0 1 0-.866-.5A3.498 3.498 0 0 1 8 11.5a3.498 3.498 0 0 1-3.032-1.75zM7 5.116V5a1 1 0 0 0-1-1H3.28a1 1 0 0 0-.97 1.243l.311 1.242A2 2 0 0 0 4.561 8H5a2 2 0 0 0 1.994-1.839A2.99 2.99 0 0 1 8 6c.393 0 .74.064 1.006.161A2 2 0 0 0 11 8h.438a2 2 0 0 0 1.94-1.515l.311-1.242A1 1 0 0 0 12.72 4H10a1 1 0 0 0-1 1v.116A4.22 4.22 0 0 0 8 5c-.35 0-.69.04-1 .116z"/>
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-1 0A7 7 0 1 0 1 8a7 7 0 0 0 14 0z"/>
      </svg>        
      <strong>PlusUltra!!</strong>  
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>