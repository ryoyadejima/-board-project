<?php
    //セッション開始
    session_start();
    require('dbcboard.php');

    if(!empty($_POST)){
        $_SESSION['join'] = $_POST;
        header('Location: board4.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type"content="text/html;charset=UTF-8">	
	<link rel="stylesheet" type="text/css" href="board.css">
    <title>思い出掲示板ログイン</title>
</head>
<body>
<div style="text-align: center"><div class="body"><div class="grad"><div class="header1"><div class="title">
<h1>アカウントを作る</h1>
<form action="" method="post" enctype="multipart/form-data" class="registrationform">
<section class="label">
    <label for="area1">name<input type="text" name="name" id="area1" value="<?php echo htmlspecialchars($_POST['name']??"", ENT_QUOTES); ?>"></label><br>
    <label for="area2">email<input type="text" name="email" id="area2" value="<?php echo htmlspecialchars($_POST['email']??"", ENT_QUOTES); ?>"></label><br>
    <label for="area3">password<input type="password" name="password" id="area3" value="<?php echo htmlspecialchars($_POST['password']??"", ENT_QUOTES); ?>"></label><br>
    <label for="area4">password<span class="red">*</span><input type="password" name="password2" id="area4"></label><br>
</section><br><br>
<div style="text-align: center">
<input type="submit" value="アカウントを作る" class="button">
</div>
</form><br>
<form action="board1.php" method="POST">
<input type="submit" value="トップページに戻る">
</form>
</div></div></div></div></div>
</body>
</html>