<?php 

//フォームのデータ受け取り
$titile = $_POST["title"];
$url = $_POST["url"];
$memo = $_POST["memo"];

//DB定義
// const DB = "mysql:host=localhost";
// const DB_ID = "root";
// const DB_PW = "root";
// const DB_NAME = "dbname=php;";
// const DB_CHAR="charset=utf8;";

//PDOでデータベース接続
try {
    $pdo= new PDO("mysql:host=localhost;dbname=php;charset=utf8;",'root','root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}

// 実行したいSQL文
$sql="INSERT INTO book(id,title,url,memo,datetime) VALUE(null,:title,:url,:memo,sysdate());";

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title',$titile,PDO::PARAM_STR);
$stmt->bindValue(':url',$url,PDO::PARAM_STR);
$stmt->bindValue(':memo',$memo,PDO::PARAM_STR);

//実際に実行
$flag=$stmt->execute();

//実行完了した場合はentry.phpにリダイレクト
//失敗した場合はエラーメッセージ表示
if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
    header('Location: entry.php');
    exit();
}

?>