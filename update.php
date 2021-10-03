<?php 
require('dbconnect.php');

//（2）$_FILEに情報があれば（formタグからpost送信されていれば）以下の処理を実行する
if(!empty($_FILES)){
 
  //（3）$_FILESからファイル名を取得する
  $filename = $_FILES['upload_image']['name'];
   
  //（4）$_FILESから保存先を取得して、images_after（ローカルフォルダ）に移す
  //move_uploaded_file（第1引数：ファイル名,第2引数：格納後のディレクトリ/ファイル名）
  $uploaded_path = 'images/'.$filename;
  //echo $uploaded_path.'<br>';
  $picture = $db->prepare('insert into members set picture=?, created=NOW()');
  $picture->execute(array($uploaded_path));
   
  $result = move_uploaded_file($_FILES['upload_image']['tmp_name'],$uploaded_path);
   
  if($result){
    $MSG = 'アップロード成功！ファイル名：'.$filename;
    $img_path = $uploaded_path;
  }else{
    $MSG = 'アップロード失敗！エラーコード：'.$_FILES['upload_image']['error'];
  }
   
  }else{
    $MSG = '画像を選択してください';
  }

?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Sample</title>
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
  </head>
  <section class="form-container">
 
 <div class="textarea">
  <h2>画像アップロード</h2>
  
<!--  メッセージを表示している箇所-->
<p><?php if(!empty($MSG)) echo $MSG;?></p>
 
  <!-- 画像を表示している箇所 -->
  <?php if(!empty($img_path)){;?>
 
   <img src="<?php echo $img_path;?>" alt="">
 
  <?php } ;?>
  
   <!-- （1）formタグにenctype="multipart/form-data"を記載 -->
   <form action="" method="post" enctype="multipart/form-data">
  
     <!-- （2）input 属性はtype="file" と指定-->
     <input type="file" name="upload_image">
  
     <!-- 送信ボタン -->
     <input type="submit" calss="btn_submit" value="送信">
  
   </form>
 </section>
  </body>
</html>