<?php
    //セッション開始
    session_start();
    require_once './dbcboard.php';
 
    if(isset($_SESSION['id'])) {
        $id = $_REQUEST['id'];
        $messages = $pdo->prepare('SELECT * FROM post WHERE message_id=?');
        $messages -> execute(array($id));
        $message = $messages->fetch();
        if ($message['created_by'] == $_SESSION['id']) {
            $del = $pdo->prepare('DELETE FROM post WHERE message_id=?');
            $del->execute(array($id));
        }
    }header('Location: board6.php');
    exit();
?>