<?php 
  require("dbconnect.php");
  session_start();

//ログインしている人の会員情報を取得する
  $get = $db->prepare("SELECT * FROM members WHERE id=?");
  $get -> bindParam(1,$_SESSION["id"]);
  $get -> execute();
  
  $data = $get -> fetch();

    if (!empty($_POST)) {
        // エラー項目の確認
        if ($_POST['name'] == '') {
            $error['name'] = 'blank';
        }
        if ($_POST['email'] == '') {
            $error['email'] = 'blank';
        }
      
        $fileName = $_FILES['image']['name'];
        if (!empty($fileName)) {
            $ext = substr($fileName, -3);
            if ($ext !== 'jpg' && $ext !== 'gif' && $ext !== 'png' && $ext !='peg') {
                $error['image'] = 'type';
            }
        }
        if(empty($fileName)){
          $error["image"] = "no-image";
        }
        if (empty($error)) {
          //画像をアップロードする

          $image = date('YmdHis') . $_FILES['image']['name'];
          move_uploaded_file($_FILES['image']['tmp_name'], 'member_picture/' . $image);
    
          //登録処理をする
          $statement = $db->prepare('UPDATE members SET name=?, email=?,  picture=?, modified=NOW() WHERE id=?');
          echo $ret = $statement->execute(array(
              $_POST['name'],
              $_POST['email'],
              $image,
              $_SESSION["id"]
          ));
          setcookie("email","",time()-3600);
          setcookie("email",$_POST["email"],time()+60*60*24*14);
    
          header('Location: post.php');
          exit();
      }
    }    
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- BootstrapのCSS読み込み -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- BootstrapのJS読み込み -->
  <script src="js/bootstrap.min.js"></script>
    <!-- cssの読み込み -->
    <link href="css/index.css" rel="stylesheet">
  <title>プロフィールを編集｜PlusUltra!!</title>
</head>
<body class="d-flex flex-column min-vh-100">
    <?php require('header.php');?>
    <main class="container flex-fill py-4 my-4 border shadow p-3 mb-5 bg-white rounded" style="max-width:500px;">


    <h2>プロフィールを編集</h2>
    <form action="" method="post" enctype="multipart/form-data" class="container mw-500px" >
        <div class="form-floating mb-3">
            <input type="text" name="name"  class="form-control" id="floatingName" placeholder="Name" max-width="50%" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['name'], ENT_QUOTES); ?>" />
            <label for="floatingName">ニックネーム</label>
            <?php echo "現在のニックネーム：" . $data["name"]?>
        </div>
            <?php if (!empty($error['name']) && $error['name'] == 'blank'): ?>
            <p class="error">* ニックネームを入力してください</p>
            <?php endif; ?>
            
        <div class="form-floating mb-3">
            <input type="text"  name="email" class="form-control" id="floatingInput" placeholder="name@example.com" value="<?php if(!empty($_POST))echo htmlspecialchars($_POST['email'], ENT_QUOTES); ?>"/>
            <label for="floatingInput">メールアドレス</label>
            <?php echo "現在のメールアドレス：" . $data["email"]?>
        </div>
            <?php if (isset($error['email']) && $error['email'] == 'blank') : ?>
            <p class="error">* メールアドレスを入力してください</p>
            <?php endif; ?>
            <?php if (isset($error['email']) && $error['email'] == 'duplicate'): ?>
            <p class="error">* 指定されたメールアドレスはすでに登録されています</p>
            <?php endif; ?>
          <div class="mb-3 ">
            <input class="form-control mb-3" type="file" id="formFile"  name="image" />
            <label for="formFile" class="d-flex flex-column justify-content-center">
              <?php if($data["picture"] || !empty($fileName)): ?>
              <p>現在の画像<p>
              <img src="member_picture/<?php echo $data["picture"]?>" alt="プロフィール画像" width=150px height=150px class="rounded-circle">
              <?php else: ?>
              <div class="rounded-circle bg-primary d-flex justify-content-center align-items-center text-white" style="width:150px; height:150px;"><p>画像なし</p></div>
              <?php endif; ?>
            </label>
          </div>
              
                <?php if (isset($error['image']) && $error['image'] == 'type'): ?>
                <p clsaa="error">*写真などは「.gif」「.png」「.jpg」の画像を指定してください</p>
                <?php endif; ?>
                <?php if (empty($fileName) && !empty($error)): ?>
                <p class="error">* 恐れ入りますが、画像を改めて指定してください</p>
                <?php endif; ?>
                <div class="d-flex justify-content-between">
                  <div class=button><button type="submit" class="btn btn-outline-primary">変更する</button></div>
                  <a href="post.php" class="btn btn-outline-danger">キャンセル</a>
                </div>
    </form>
    </main>
    <?php require('footer.php');?>
</body>
</html>