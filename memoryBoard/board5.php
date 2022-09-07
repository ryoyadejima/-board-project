<?php
    //セッション開始
    session_start();
    require_once './dbcboard.php';

    if(!empty($_POST)) {
        if(($_POST['email'] != '') && ($_POST['password'] != '')) {
                $login = $pdo->prepare('SELECT * FROM user_db WHERE email=?');
                $login->execute(array($_POST['email']));
                $member=$login->fetch();
            
            if(password_verify($_POST['password'],$member['password'])) {
                $_SESSION['id'] = $member['id'];
                $_SESSION['time'] =time();
                header('Location: board6.php');
                exit();
            } else {
                $error['login']='failed';
                } 
        } else {
        $error['login'] ='blank';
        }
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type"content="text/html;charset=UTF-8">	
    <title>思い出掲示板ログイン</title>
    <link rel="stylesheet" type="text/css" href="board.css">
</head>
<body>
	<div class="image1"><div class="header4"><div style="text-align: center"><div class="title">
	<h1>旅の思い出掲示板ログイン</h1>
	<form action='' method="post">
   <label for="area1">email<br><input type="text" name="email" id="area1" value="<?php echo htmlspecialchars($_POST['email']??"", ENT_QUOTES); ?>"></label>
    <?php if (isset($error['login']) &&  ($error['login'] =='blank')): ?>
    <p class="error">メールアドレスとパスワードを入力してください</p>
    <?php endif; ?><br>
    <?php if( isset($error['login']) &&  $error['login'] =='failed'): ?>
    <p class="error">メールアドレスかパスワードが間違っています</p>
    <?php endif; ?><br>
    <label for="area2">パスワード<br><input type="password" name="password" id="area2" value="<?php echo htmlspecialchars($_POST['password']??"", ENT_QUOTES); ?>"></label>
	<div class="login2"><input type="submit" value="ログインする" class="button"></div>
	</form>
	<br>
	<form action="board2.php" method="POST">
  	<input type="submit" value="新規登録に戻る">
  	</form>
  	<form action="board1.php" method="POST">
	<input type="submit" value="トップページに戻る">
	</form>
	</div></div></div></div>
</body>
</html>