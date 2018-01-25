# dev9-7thwork


1、awsのフォルダ
・amazon advertising apiを用いてアマゾンの商品検索を行い、検索結果をDBに格納、表示できる仕様。
  ※amazon advertising apiのkeyが1日経つと消えてしまうため更新しないと動作しない。
・Auth機能を実装。
　└DBにユーザー情報(ユーザー名、メールアドレス、パスワード)を保存。
  └パスワードはハッシュ化した値を保存している。
  └ログインの際にはハッシュ化したパスワードと入力した平文を比較している。
・HttpSettionを実装。

・画面説明
　　ログイン：login.php　
　　ログイン：logout.php
　　検索：search_entry.php
　　検索結果・お気に入り登録：aws_search.php
　　お気に入り一覧：index.php


2、nomalのフォルダ
・Auth機能を実装。
　└DBにユーザー情報(ユーザー名、メールアドレス、パスワード)を保存。
  └パスワードはハッシュ化した値を保存している。
  └ログインの際にはハッシュ化したパスワードと入力した平文を比較している。
・HttpSettionを実装。
・手入力した本の情報をDBに登録、一覧表示が可能。

・画面説明
　　ログイン：login.php　
　　ログイン：logout.php
　　登録：entry.php
　　登録一覧：index.php
