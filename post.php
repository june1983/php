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
        header('Location: ./join/login.php'); exit();
    }

//投稿を記録する
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

//$_FILEに情報があれば（formタグからpost送信されていれば）以下の処理を実行する
if(!empty($_FILES)){
    if($_FILES['image'] != '') {
    //$_FILESからファイル名を取得する
    $image = date('YmdHis') . $_FILES['image']['name'];   
    //$_FILESから保存先を取得して、member_picture（ローカルフォルダ）に移す
    //move_uploaded_file（第1引数：ファイル名,第2引数：格納後のディレクトリ/ファイル名）
    move_uploaded_file($_FILES['image']['tmp_name'], 'member_picture/' . $image);
    $picture = $db->prepare('insert into posts set member_id=?, image=?, created=NOW()');
    $picture->execute(array(
        $member['id'],
        $image
    ));
   
    header('Location: post.php'); exit();
    }
}
//投稿を取得する（テキスト）
$posts = $db->query('select m.name, m.picture, m.email, p.* from members m, posts p where m.id=p.member_id order by p.created desc');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>トップページ｜PlusUltra!!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/style.css" rel="stylesheet">
    <!-- jQuery読み込み -->
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">        
<?php require('header.php');?>
    <div class="container gedf-wrapper">
        <div class="row">
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="mr-2">
                            <img class="rounded-circle" width="45" height="45" src="member_picture/<?php echo $member['picture'] ?>" alt="<?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?>">
                        </div>
                        <div class="ml-2">
                        <div class="h5"><?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?></div>
                        <div class="h7 text-muted">Email : <?php echo htmlspecialchars($member['email'], ENT_QUOTES); ?></div>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="user_edit.php" class="nav__link nav-link-faded has-icon active">アカウント情報</a>
                        </li>
                        <li class="list-group-item">
                            <a href="join/logout.php" class="nav__link nav-link-faded has-icon">ログアウト</a>
                        </li>
                        <li class="list-group-item">
                            <a href="join/cancel.php" class="nav__link nav-link-faded has-icon">退会する</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6 gedf-main">

                <!--- \\\\\\\Post-->
                <div class="card gedf-card shadow">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="posts-tab" data-toggle="tab" href="#posts" role="tab" aria-controls="posts" aria-selected="true">
                                    テキスト
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="images-tab" data-toggle="tab" role="tab" aria-controls="images" aria-selected="false" href="#images">
                                    写真
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                    <form action="" method="post" enctype="multipart/form-data">

                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="posts-tab">
                                <div class="form-group">
                                <dt class="form-txt"><?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?>さん、メッセージをどうぞ</dt>
                                    <textarea class="form-text-area" name="message" rows="3" placeholder="What's happening?"></textarea>
                                </div>

                            </div>
                            <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="image">
                                    </div>
                                </div>
                                <div class="py-4"></div>
                            </div>
                        </div>
                        <div class="btn-toolbar justify-content-between">
                            <div class="btn-group">
                                <input type="submit" class="form-input"　value="投稿する"/>
                            </div>
                        </div>
                    </form>     
                    </div>
                </div>
                <!-- Post /////-->

                <!--- \\\\\\\Post-->
                <?php foreach($posts as $post):?>

                <div class="card gedf-card shadow">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="mr-2">
                                    <img class="rounded-circle" width="45" height="45" src="member_picture/<?php echo $post['picture'] ?>" alt="<?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?>">
                                </div>
                                <div class="ml-2">
                                    <div class="h5 m-0"><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?></div>
                                    <div class="text-muted h7"><i class="fa fa-clock-o"></i><?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="view.php?id=<?php echo htmlspecialchars($post['id'], ENT_QUOTES); ?>">
                    <div class="card-body">

                        <p class="card-text">
                            <?php echo htmlspecialchars($post['message'], ENT_QUOTES); ?>
                        </p>

                        <?php if(isset($post['image']) && $post['image'] != ''): ?> 
                        <img src="member_picture/<?php echo htmlspecialchars($post['image'], ENT_QUOTES); ?>">
                        <?php endif?>

                    </div>
                    <div class="card-footer">
                        <!--<a href="#" class="card-link"><i class="fa fa-gittip"></i> Like</a>-->
                        <a href="#" class="card-link"><i class="fa fa-comment"></i> Comment</a>
                        <!--<a href="#" class="card-link"><i class="fa fa-mail-forward"></i> Share</a>-->
                    </div>
                    </a>
                </div>

                <?php endforeach;?>
                <!-- Post /////-->

            </div>
            <div class="col-md-3 news">
                <div class="h5">What’s happening</div>    
                <?php
                $xmlTree = simplexml_load_file('https://news.yahoo.co.jp/rss/topics/top-picks.xml');
                foreach($xmlTree->channel->item as $item):
                ?>    
                <div class="card gedf-card shadow">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $item->title?></h5>
                        <h6 class="card-subtitle mb-2 text-muted"><?php echo $item->pubDate?></h6>
                        <p class="card-text">
                            <?php echo $item->description?>
                        </p>
                        <a href="<?php echo $item->link?>" class="card-link"><?php echo $item->link?></a>
                    </div>
                </div>
                <?php endforeach?>    
            </div>
        </div>
    </div>
<?php require('footer.php');?>
</body>
</html>