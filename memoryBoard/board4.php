<?php
    //セッション開始
    session_start();
    require_once './dbcboard.php';

    if (!isset($_SESSION['join'])) {
        header ('Location: board3.php');
        exit();
    }

    $hash = password_hash($_SESSION['join']['password'], PASSWORD_BCRYPT);

    if(!empty($_POST)){
        $statement = $pdo->prepare('INSERT INTO user_db SET name=?, email=?, password=?, created=NOW()');
        $statement->execute(array($_SESSION['join']['name'],$_SESSION['join']['email'],$hash));
        unset($_SESSION['join']);
        header('Location: board5.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type"content="text/html;charset=UTF-8">	
    <title>掲示板ログイン</title>
    <link rel="stylesheet" type="text/css" href="board.css">
</head>
<body>
	<div class="image3"><div style="text-align: center"><div class="header3"><div class="title">
	<h1>アカウント登録画面</h1>
	<form action="" method="post">
	<input type="hidden" name="action" value="submit">
    <p>ニックネーム:<span class="check"><?php echo (htmlspecialchars($_SESSION['join']['name'], ENT_QUOTES)); ?></span></p>
    <p>email:<span class="check"><?php echo (htmlspecialchars($_SESSION['join']['email'], ENT_QUOTES)); ?></span></p>
    <p>パスワード:<span class="check">[セキュリティのため非表示] </span></p><br>
	<input type="button" onclick="location.href='board3.php?action=rewrite'" value="修正する" name="rewrite" class="button02">	
	<input type="submit" onclick="location.href='board5.php'" value="登録する" name="registration" class="button">
	</form>
	<br>
	<form action="board1.php" method="POST">
	<input type="submit" value="トップページに戻る">
	</form>
	</div></div></div></div>
</body>
</html>