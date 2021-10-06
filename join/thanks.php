<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/thanks.css" rel="stylesheet">
    <!-- BootstrapのCSS読み込み -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="../js/bootstrap.min.js"></script>
    <!-- cssの読み込み -->
    <link href="../css/thanks.css" rel="stylesheet">
    <title>ユーザー登録完了｜PlusUltra!!</title>
</head>
<body>
<?php require('../header.php');?>
<main class="container flex-fill py-4 my-4 border shadow p-3 mb-5 bg-white rounded" style="max-width:500px;">
    <div class="thanks-body">
        
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
        <p class=""><a  class="login-button" href="login.php">ログイン</a></p>
    </div>    
</main> 
<?php require('../footer.php');?>
</body>
</html>