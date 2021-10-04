<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- BootstrapのCSS読み込み -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- cssの読み込み -->
    <link href="../css/thanks.css" rel="stylesheet">
    <title>Document</title>
    
    
</head>
<body>
<?php require('../header.php');?>
<script type="text/javascript">
   var imglist = new Array(
      "../images/kansya1.jpg",
      "../images/kansya2.jpg",
      "../images/kansya1.png",
      "../images/kansya2.png",
       "../images/kansya3.png");
   var selectnum = Math.floor(Math.random() * imglist.length);
   var output = "<img src=" + imglist[selectnum] + " >";
   document.write(output);
</script>
    <p>ユーザー登録が完了しました</p>
    <p><a href="login.php">ログイン</a></p>
    <?php require('../footer.php');?>
</body>
</html>