<?php 

//フォームのデータ受け取り
$titile = $_POST["title"];
$detail = $_POST["detail"];

//DB定義
const DB = "mysql:host=localhost";
const DB_ID = "root";
const DB_PW = "root";
const DB_NAME = "dbname=gsblog_db;";
const DB_CHAR="charset=utf8;";

//PDOでデータベース接続
try {
    // $pdo= new PDO(DB,DB_ID,DB_CHAR,DB_NAME);
    $pdo= new PDO("mysql:host=localhost;dbname=gsblog_db;charset=utf8;",'root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}

// 実行したいSQL文
$sql="insert into gs_table (id,title,detail,time) value(null,:title,:detail,sysdate();";

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title',$titile,POD::PARAM_STR);
$stmt->bindValue(':detail',$detail,POD::PARAM_STR);

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