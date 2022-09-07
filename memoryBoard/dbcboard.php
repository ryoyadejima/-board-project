<?php


try {
    $pdo = new PDO("mysql:dbname=board_db;host=localhost","root","root",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET `utf8`"));
    //$db = new PDO ('mysql:dbname=test;host=localhost; charset=utf8', 'root', 'root');
   // echo'DB接続成功だ';
    return $pdo;
} catch (PDOException $e) {
    echo 'DB接続エラー' . exit($e->getMessage());
}


function dbc()
{
    $host = "localhost";
    $dbname = "board_db";
    $user = "root";
    $pass = "root";
    
    $dns = "mysql:host=$host;dbname=$dbname;charset=utf8";
    
    
    try {
        $pdo = new PDO($dns, $user, $pass,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        //echo'DB接続成功';
        return $pdo;
    } catch (PDOException $e) {
        echo '※DB接続失敗';
        exit($e->getMessage());
    }
}

/**ファイルデータを保存
 * @param array $userData
 * @return bool $result
 */
/**ファイルデータを保存
 * @param string $fileName ファイル名
 * @param string $save_path 保存先のパス
 * @param string $caption 投稿の説明
 * @return bool $result
 */
function fileSave($filename,$save_path,$caption) {
    $result = False;
    
    $sql = "INSERT INTO post (file_name, file_path, caption) VALUE (?,?,?)";
    
    try {
        $stmt = dbc()->prepare($sql);
        $stmt->bindValue(1, $filename);
        $stmt->bindValue(2, $save_path);
        $stmt->bindValue(3, $caption);
        $result = $stmt->execute();
        return $result;
    } catch (Exception $e) {
        echo $e->getMessage();
        return  $result;
    }
}

/**ファイルデータを取得
 * @return array $fileData
 */
function getAllFile() {
    $sql = "SELECT * FROM post";
    
    $fileData = dbc()->query($sql);
    
    return $fileData;
}

function h($s){
    return  htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

?>