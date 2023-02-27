<?php
mb_internal_encoding("utf8");

//DB接続
$pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
//prepared statement(プリペアードステートメント)でSQL文の型を作る
$stmt = $pdo->prepare("insert into login_mypage(name,mail,password,picture,comments)value(?,?,?,?,?)");

//bindValueメソッドでパラメータをセット
$stmt->bindValue(1,$_POST['name']);
$stmt->bindValue(2,$_POST['mail']);
$stmt->bindValue(3,$_POST['password']);
$stmt->bindValue(4,$_POST['picture']);
$stmt->bindValue(5,$_POST['comments']);

//executeでクエリを実行。
$stmt->execute();
$pdo = NULL;

header('Location:after_register.html');
?>