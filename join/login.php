<?php 
  require("../dbconnect.php");
  session_start();

  if(isset($_COOKIE["email"]) && $_COOKIE["email"] !== ""){
    $_POST["email"] = $_COOKIE["email"];
    $_POST["password"] = $_COOKIE["password"];
    $_POST["save"] = "on";
  }

  //POST情報がある(ログインボタンが押された場合)
  if(!empty($_POST)){
    //入力値が空文字列でなければ
    if($_POST["email"] !== "" && $_POST["password"] !== ""){

      $encoded_password = sha1($_POST["password"]);

      //DBに行ってデータを持ってくる
      $login = $db->prepare("SELECT * FROM members WHERE email=? AND password=?");
      $login -> bindParam(1,$_POST["email"]);
      $login -> bindParam(2,$encoded_password);
      $login -> execute();
      
      $member = $login -> fetch();
      //DBに情報が存在すれば
      if($member){
        //sessionに保存する
        $_SESSION["id"] = $member["id"];
        $_SESSION["time"] = time();

        //COOKIEにアドレスとパスワードを保存
        if($_POST["save"] === "on"){
          setcookie("email",$_POST["email"],time()+60*60*24*14);
          setcookie("password",$_POST["password"],time()+60*60*24*14);
        }
        echo "<script>
        document.querySelectorAll('.toast')
       .forEach(function (toastNode) {
         var toast = new bootstrap.Toast(toastNode, {
           autohide: false
         })
     
         toast.show()
       })
     </script>";
        //トップページへ飛ばす
        header("Location:../post.php"); 
        exit();

      //DBに情報がなければ
      }else{
        //"login"ステートを定義して"failed"を入れる"
        $error["login"] = "failed";
      }
      
      //入力値が空文字列だったら
    }else{
      //"login"ステートを定義して"blank"を入れる"
      $error["login"] = "blank";
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
    <form action="" method="post"  class="mt-3">
        
        <div class="form-floating mb-3">
          <input 
          type="email" 
          class="form-control" 
          id="floatingInput" 
          placeholder="name@example.com"
          name="email"　
          value="<?php if(!empty($_POST))print(htmlspecialchars($_POST["email"],ENT_QUOTES)); ?>"
        />
          <label for="floatingInput">メール入力</label>
        </div>

        <div class="form-floating">
          <input 
          type="password" 
          class="form-control" 
          id="floatingPassword" 
          placeholder="Password"
          name="password"
          value="<?php if(!empty($_POST))print(htmlspecialchars($_POST["password"],ENT_QUOTES)); ?>"
          />
          <label for="floatingPassword">パスワード入力</label>
        </div>
            
        <div class="my-3 form-check form-switch">
          <label class="form-check-label"><input type="checkbox" name="save" class="form-check-input" checked/>次回から自動ログイン</label>
        </div>
        <?php if(!empty($_POST) && $error["login"] === "blank"): ?>
          <p class="text-danger">* メールアドレスおよびパスワードをご記入ください。</p>          
        <?php endif ?>
        <?php if(!empty($_POST) && $error["login"] === "failed"): ?>
          <p class="text-danger">* ログインに失敗しました。入力項目をご確認ください。</p>          
        <?php endif ?>
        <div class="d-flex justify-content-between">
          <input type="submit" value="ログイン" class="btn border border-primary bg-white text-primary"/>
          <a href="./index.php" class="btn btn-secondary">→ 会員登録画面へ移動</a>
        </div>
   </form>
  </main>
  
    <?php require('../footer.php');?>
  </body>
  </html>
  