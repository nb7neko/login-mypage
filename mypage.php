<?php

mb_internal_encoding("utf8");
session_start();

if(empty($_SESSION['id'])){

    try{
    //try catch文。DBに接続できなければエラーメッセージを表示
        $pdo = new PDO("mysql:dbname=lesson01;host=localhost;","root","");
    }
    catch(PDOException $e){
        die("<p>申し訳ございません。現在サーバーが混み合っており一時的にアクセスが出来ません。<br>しばらくしてから再度ログインをしてください。</p><a href='http://localhost/login_mypage/login.php'>ログイン画面へ</a>");
    }

    //prepared statement(プリペアードステートメント)でSQL文の型を作る(DBとpostデータを照合させる。 select文とwhere句を使用。）
    $stmt = $pdo->prepare("select * from login_mypage where mail = ? && password = ?");

    //bindValueメソッドでパラメータをセット
    $stmt->bindValue(1,$_POST["mail"]);
    $stmt->bindValue(2,$_POST["password"]);

    //executeでクエリを実行
    $stmt->execute();

    //データベースを切断
    $pdo = NULL;

    //fetch・while文でデータ取得し、sessionに代入
    while($row=$stmt -> fetch()){
        $_SESSION['id']=$row['id'];
        $_SESSION['name']=$row['name'];
        $_SESSION['mail']=$row['mail'];
        $_SESSION['password']=$row['password'];
        $_SESSION['picture']=$row['picture'];
        $_SESSION['comments']=$row['comments'];
    }

    //データ取得ができずに（emptyを使用して判定）sessionがなければ、リダイレクト（エラー画面へ）
    if(empty($_SESSION['id'])){
        header("Location:login_error.php");
    }

    if(!empty($_POST['login_keep'])){
        $_SESSION['login_keep']=$_POST['login_keep'];
    }
}

if(!empty($_SESSION['id']) && !empty($_SESSION['login_keep'])){
    setcookie('mail',$_SESSION['mail'],time()+60*60*24*7);
    setcookie('password',$_SESSION['password'],time()+60*60*24*7);
    setcookie('login_keep',$_SESSION['login_keep'],time()+60*60*24*7);
    }
    else if(empty($_SESSION['login_keep'])){
    setcookie('mail','',time()-1);
    setcookie('password','',time()-1);
    setcookie('login_keep','',time()-1);
}

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>会員情報</title>
        <link rel="stylesheet" type="text/css" href="mypage.css">
    </head>

    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="logout"><a href="logout.php">ログアウト</a></div>
        </header>
        <main>
            <!-- このbodyの中に、マイページとして表示する部分を記述していく（HTMLと代入したsessionを記述）-->
            <div class="user_page">
                <h2>会員情報</h2>
                <p class="comments">こんにちは！<?php echo $_SESSION['name']; ?>さん</P>
                <div class="box">
                    <div class="picture"><img src="<?php echo $_SESSION['picture']; ?>"></div>
                    <div class="user_info">
                        <p>氏名：<?php echo $_SESSION['name']; ?></p>
                        <p>メール：<?php echo $_SESSION['mail']; ?></p>
                        <p>パスワード：<?php echo $_SESSION['password']; ?></p>
                    </div>
                </div>
                <p class="comments"><?php echo $_SESSION['comments']; ?></p>
            
                <form action="mypage_hensyu.php" method="post" class="form_center">
                    <input type="hidden" value="<?php echo rand(1,10); ?>" name="from_mypage">
                    <div class="back">
                        <input type="submit" class="button1" value="編集する">
                    </div>
                </form>

            </div>
        </main>

        <footer>
            © 2018 InterNouse.inc. All rights reserved
        </footer>
    </body>
</html>
