<?php
    //セッション開始
    session_start();
    require_once './dbcboard.php';
 
    if (isset($_SESSION['id']) && ($_SESSION['time'] + 3600 > time())) {
        $_SESSION['time'] = time();
 
        $members=$pdo->prepare('SELECT * FROM user_db WHERE id=?');
        $members->execute(array($_SESSION['id']));
        $member=$members->fetch();
        } else {
        header('Location: board5.php');
        exit();
    }

    if (!empty($_POST)){
        if (isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
            $message=$pdo->prepare('INSERT INTO post SET created_by=?, message=?, created=NOW()');
            $message->execute(array($member['id'] , $_POST['message']));
            header('Location: board6.php');
            exit();
        }else {
            header('Location: board5.php');
            exit();
        }
    }
 
    $posts=$pdo->query('SELECT m.name, p.* FROM user_db m, post p WHERE m.id=p.created_by ORDER BY p.created DESC');
  
    $TOKEN_LENGTH = 16;
    $tokenByte = openssl_random_pseudo_bytes($TOKEN_LENGTH);
    $token = bin2hex($tokenByte);
    $_SESSION['token'] = $token;
 
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type"content="text/html;charset=UTF-8">	
	<title>掲示板</title>
	<link rel="stylesheet" type="text/css" href="board.css">
</head>
<body>
	<div class="image3"><div style="text-align: center">
    <!-- ★ログアウト★ -->
	<header>
	<div class="title2">	
		<h1>思い出掲示板 旅の思い出投稿画面</h1><h2>~思い出を残そう!~</h2>
		<span class="logout"><a href="board5.php">ログアウト</a></span>
	</div>
	</header>
	
	<div class="title2">
	<form action='' method="post">
	<input type="hidden" name="token" value="<?=$token?>">
	<?php if (isset($error['login']) &&  ($error['login'] =='token')): ?>
	<p class="error">不正なアクセスです。</p>
	<?php endif; ?>
	<?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?>さん、ようこそ<br>
	<textarea name="message" placeholder="投稿しよう！"cols='50' rows='10'><?php echo htmlspecialchars($message??"", ENT_QUOTES); ?></textarea><br>
	<input type="submit" value="投稿する" >
	</form><br></div><br><br>

    <!-- ★投稿画面★ -->
	<section class="toukou">

    <!-- ★投稿コメント★ -->
	<?php foreach($posts as $post):?><br>
	<?php echo htmlspecialchars($post['message'], ENT_QUOTES);?>
	<br>-----------------------------------------------------------<br>
	<span class="name"><?php echo htmlspecialchars($post['name'], ENT_QUOTES); ?> | <?php echo htmlspecialchars($post['created'], ENT_QUOTES); ?> | 
    <!-- ★削除★ -->
	<?php if($_SESSION['id'] == $post['created_by']): ?>
	<a href="board7.php?id=<?php echo htmlspecialchars($post['message_id'], ENT_QUOTES); ?>">[削除]</a><?php endif; ?></span>
	</section><br>
	<section class="toukou">

	<?php endforeach;?>
	</section>
	</div></div>
</body>
</html>
