<?php 

// session_start();

// // ログイン状態チェック
// if (!isset($_SESSION["NAME"])) {
//     header("Location: Logout.php");
//     exit;
// }


//PDOでデータベース接続
try {
    $pdo= new PDO("mysql:host=localhost;dbname=php;charset=utf8;",'root','root');
}catch (PDOException $e) {
    exit( 'DbConnectError:' . $e->getMessage());
}

// 実行したいSQL文（最新順番3つ取得）
$sql="SELECT * FROM aws_book ORDER BY datetime DESC;";

//MySQLで実行したいSQLセット。プリペアーステートメントで後から値は入れる
$stmt=$pdo->prepare($sql);
$flag=$stmt->execute();

if($flag==false){
    $error = $stmt->errorInfo();
    exit("ErrorQuery:".$error[2]);
}else{

?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="css/sanitize.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<!--header-->
<div class="header">
	<h1 class="site-title">登録参照</h1>
</div>
<!--//header-->

<!--Works-->
<div class="section section__work" id="work">
	<h2 class="content-title">Works</h2>	
	<div class="wrapper">
		<ul class="work-list">
			<?php
			while($result = $stmt->fetch(PDO::FETCH_ASSOC)){;
			?>
			<li class="work-item">
				<div class="work-thumb">
					<img src=<?php echo $result['img_url']; ?>>
				</div>
				<h3 class="work-title"></h3>
				<a href=<?php echo $result['book_url']; ?>><?php echo $result['title']; ?></a>
				<p class="book-author">著者:<?php echo $result['authors']; ?></p>
            	<p class="book-manufacturer">出版社:<?php echo $result['manufacturer']; ?></p>
                <p class="book-manufacturer">出版日:<?php echo $result['releaseDate']; ?></p>
				<!-- <p><?php echo $result['memo']; ?></p> -->
			 </li> 
			<?php
			}
			?>
		</ul>
		
	</div>
	<ul>
		<li><a href="entry.php">登録する</a></li>
        <li><a href="Logout.php">ログアウト</a></li>
     </ul>
	
</div>
<!--// Works-->
<!--footer-->
<div class="footer">
	<p class="copyrights">copyrights 2017 Tatsuya Kosuge All Rights Reserved.</p>
</div>
<!--// footer-->

</body>
</html>

<?php 
}
?>