# dev9-7thwork


1、awsのフォルダ<br> 
・amazon advertising apiを用いてアマゾンの商品検索を行い、検索結果をDBに格納、表示できる仕様。<br> 
  ※amazon advertising apiのkeyが1日経つと消えてしまうため更新しないと動作しない。<br> 
・Auth機能を実装。<br>
　└DBにユーザー情報(ユーザー名、メールアドレス、パスワード)を保存。<br> 
　└パスワードはハッシュ化した値を保存している。<br> 
　└ログインの際にはハッシュ化したパスワードと入力した平文を比較している。<br> 
・HttpSettionを実装。<br> <br>

・画面説明<br>
　　ログイン：login.php<br>
　　ログアウト：logout.php<br>
  　検索：search_entry.php<br>
　　検索結果・お気に入り登録：aws_search.php<br>
　　お気に入り一覧：index.php<br> <br>

2、nomalのフォルダ<br>
・Auth機能を実装。<br> <br>
　└DBにユーザー情報(ユーザー名、メールアドレス、パスワード)を保存。<br>
  └パスワードはハッシュ化した値を保存している。<br>
  └ログインの際にはハッシュ化したパスワードと入力した平文を比較している。<br>
・HttpSettionを実装。<br>
・手入力した本の情報をDBに登録、一覧表示が可能。<br>

・画面説明<br>
　　ログイン：login.php<br>
  　ログアウト：logout.php<br>
　　登録：entry.php<br>
　　登録一覧：index.php<br>
