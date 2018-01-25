<?php
// エラーメッセージの初期化
$errorMessage = "";

session_start();


// 1. ユーザIDの入力チェック
if (empty($_POST["name"])) {  // emptyは値が空のとき
    $errorMessage = 'ユーザーIDが未入力です。';
} else if (empty($_POST["password"])) {
    $errorMessage = 'パスワードが未入力です。';
}


if (!empty($_POST["name"]) && !empty($_POST["password"])) {
    // 入力したユーザIDを格納
    $name = $_POST["name"];

    // 3. エラー処理
    try {
        $pdo= new PDO("mysql:host=localhost;dbname=php;charset=utf8;",'root','root');

        $stmt = $pdo->prepare('SELECT * FROM user WHERE name = :name');
        $stmt->bindValue(':name',$name,PDO::PARAM_STR);
        $flag= $stmt->execute();

        $password = $_POST["password"];

        if ($flag) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                session_regenerate_id(true);
                 $_SESSION["NAME"] = $name;
                header("Location: index.php");  // メイン画面へ遷移
                exit();  // 処理終了
            } else {
                // 認証失敗
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。1';
            }
        } else {
            // 該当データなし
            $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。2';
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        //  $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
        //  echo $e->getMessage();
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>認証失敗</title>
    </head>
    <body>
        <h1><?php  echo $errorMessage; ?></h1>
        <ul>
            <li><a href="Login.php">ログイン画面に戻る</a></li>
        </ul>
    </body>
</html>
