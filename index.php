<?php 
require('dbconnect.php');

//投稿を取得する
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
                    <div class="card-body ">
                        <div class="h5">名無しさん</div>
                        <div class="h7 text-muted">Email : </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <a href="join/" class="nav__link nav-link-faded has-icon active">会員登録</a>
                        </li>
                        <li class="list-group-item">
                            <a href="join/login.php" class="nav__link nav-link-faded has-icon">ログイン</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-6 gedf-main">

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