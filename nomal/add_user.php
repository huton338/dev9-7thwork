<?php 

//フォームのデータ受け取り
$name = $_POST["name"];
$maill = $_POST["maill"];
$password = $_POST["password"];
$password=password_hash($password, PASSWORD_BCRYPT);



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
$sql="INSERT INTO user(id,name,maill,password,datetime) VALUE(null,:name,:maill,:password,sysdate());";

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name',$name,PDO::PARAM_STR);
$stmt->bindValue(':maill',$maill,PDO::PARAM_STR);
$stmt->bindValue(':password',$password,PDO::PARAM_STR);

//実際に実行
$flag=$stmt->execute();

//実行完了した場合はentry.phpにリダイレクト
//失敗した場合はエラーメッセージ表示
if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{
    header('Location: login.php');
    exit();
}

?>