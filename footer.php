<footer class="text-muted py-5">
  <div class="container">
    <p class="float-end mb-1">
    <!-- 下記コードは消さないで下さい。ログイン時はpost.php 非ログイン時はindex.phpへ遷移 --> 
    <?php if(isset($_SESSION['id'])){
        $urlpass = 'post.php';
      } else {
        $urlpass = 'index.php';
      }
      ?> 
      <a href="/plusultra/<?php echo $urlpass;?>">トップに戻る</a>
    </p>
    <p class="mb-1">&copy; PlusUltra!! </p>
  </div>
</footer>