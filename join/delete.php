<?php 
  require("../dbconnect.php");
  session_start();
    
if(isset($_SESSION['id'])) {
    $id = $_REQUEST['id'];

    //ユーザーを検査する
    $members = $db->prepare('select * from members where id=?');
    $members->execute(array($id));
    $member = $members->fetch();

    if($member['id'] == $_SESSION['id']) {
        //削除する
        $del = $db->prepare('delete from members where id=?');
        $del->execute(array($id));
    }
}

// セッション情報の削除
$_SESSION = array();
if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(),"",time()-42000,
    $params["path"],$params["domain"],
    $params["secure"],$params["httponly"]
);
}
session_destroy();

//cookie情報削除
setcookie("email","",time()-3600);
setcookie("password","",time()-3600);

header('Location: ../index.php'); exit();
?>