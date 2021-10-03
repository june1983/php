<header>
  <div class="collapse bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 col-md-7 py-4">
          <h4 class="text-white">投稿しよう</h4>
          <p class="text-muted">撮影者や撮影した背景など、アルバムに関する情報を追加しましょう。いくつかの文を書いておくと、友達が写真を選ぶ手助けになるかもしれません。また、写真は SNS や連絡先へとリンクしておきましょう。</p>
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
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <!-- 下記コードは消さないで下さい。ログイン時はpost.php 非ログイン時はindex.phpへ遷移 --> 
      <?php if(isset($_SESSION['id'])){
        $urlpass = 'post.php';
      } else {
        $urlpass = 'index.php';
      }
      ?> 
      <a href="/plusultra/<?php echo $urlpass;?>" class="navbar-brand d-flex align-items-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"/><circle cx="12" cy="13" r="4"/></svg>
        <strong>PlusUltra!!</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>