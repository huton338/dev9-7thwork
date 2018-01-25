<?php 

//フォームのデータ受け取り
$titile = $_POST["title"];
$authors = $_POST["authors"];
$book_url = $_POST["bookurl"];
$img_url = $_POST["imgurl"];
$manufacturer = $_POST["manufacturer"];
$releasedate = $_POST["releasedate"];

// $memo = $_POST["memo"];

//PDOでデータベース接続
try {
    $pdo= new PDO("mysql:host=localhost;dbname=php;charset=utf8;",'root','root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}

// 実行したいSQL文
$sql="INSERT INTO aws_book(id,title,authors,book_url,img_url,manufacturer,releasedate,memo,datetime) VALUE(null,:title,:authors,:book_url,:img_url,:manufacturer,:releasedate,null,sysdate());";

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title',$titile,PDO::PARAM_STR);
$stmt->bindValue(':authors',$authors,PDO::PARAM_STR);
$stmt->bindValue(':book_url',$book_url,PDO::PARAM_STR);
$stmt->bindValue(':img_url',$img_url,PDO::PARAM_STR);
$stmt->bindValue(':manufacturer',$manufacturer,PDO::PARAM_STR);
$stmt->bindValue(':releasedate',$releasedate,PDO::PARAM_STR);
// $stmt->bindValue(':memo',$memo,PDO::PARAM_STR);

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