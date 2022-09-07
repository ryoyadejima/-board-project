<?php
    //セッション開始
    session_start();
    require_once './dbcboard.php';

    if (!empty($_POST) ){
    //エラーの出る条件を設定
        if ($_POST['name'] == "" ) {
            $error['name'] = 'blank';
        }
        if ($_POST['email'] == "" ) {
            $error['email'] = 'blank';
        }
        if ($_POST['password'] == "" ) {
            $error['password'] = 'blank';
        }
        if ($_POST['password2'] == "" ) {
            $error['password2'] = 'blank';
        }

        if (strlen($_POST['password'] )< 6 ) {
            $error['password'] = 'length';
        }

        if (($_POST['password'] != $_POST['password2']) && ($_POST['password2'] != "")){
            $error['password2'] = 'difference';
        }
    if(empty($error)) {
        $_SESSION['join'] = $_POST;
        header('Location: board4.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type"content="text/html;charset=UTF-8">	
	<link rel="stylesheet" type="text/css" href="board.css">
	<title>思い出掲示板の会員登録</title>
</head>
<body>
	<div style="text-align: center"><div class="body"><div class="grad"><div class="header2"><div class="title">
	<h1>アカウント修正</h1>
	
	<form action="" method="post" enctype="multipart/form-data" class="registrationform">
    <label for="area1">ニックネーム<br><input type="text" name="name" id="area1" value="<?php echo htmlspecialchars($_POST['name']??"", ENT_QUOTES); ?>"></label><br>
    <?php if (isset($error['name']) && ($error['name'] == "blank")): ?>
        <p class="error">名前を入力してください"</p>
    <?php endif; ?><br>
    <label for="area2">email<br><input type="text" name="email" id="area2" value="<?php echo htmlspecialchars($_POST['email']??"", ENT_QUOTES); ?>"></label><br>
    <?php if (isset($error['email']) && ($error['email'] == "blank")): ?>
        <p class="error">emailを入力してください</p>
    <?php endif; ?><br>
    <label for="area3">パスワード<br><input type="password" name="password" id="area3" value="<?php echo htmlspecialchars($_POST['password']??"", ENT_QUOTES); ?>"></label>
    <?php if (isset($error['password']) && ($error['password'] == "blank")): ?>
        <p class="error"> パスワードを入力してください</p>
    <?php endif; ?><br>
    <?php if (isset($error['password']) && ($error['password'] == "length")): ?>
        <p class="error"> 6文字以上で指定してください</p>
    <?php endif; ?><br>
    <label for="area4">パスワード再入力<span class="red">*</span><br><input type="password" name="password2"  id="area4"></label>
    <?php if (isset($error['password2']) && ($error['password2'] == "blank")): ?>
        <p class="error"> パスワードを入力してください</p>
    <?php endif; ?><br>
    <?php if (isset($error['password2']) && ($error['password2'] == "difference")): ?>
        <p class="error"> パスワードが上記と違います</p>
    <?php endif; ?><br>
	<input type="submit" value="確認する">
	</form><br>
	<form action="board1.php" method="POST">
	<input type="submit" value="トップページに戻る">
	</form>
	</div></div></div></div></div>
</body>
</html>