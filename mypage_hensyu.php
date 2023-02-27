<?php

mb_internal_encoding("utf8");
//セッションスタート
session_start();

//mypage.phpからの導線以外は、login_error.phpへリダイレクト
$num = null;
$num = $_POST['from_mypage'];

if(empty($num)){
    header("Location:login_error.php");
}

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>マイページ登録</title>
        <link rel="stylesheet" type="text/css" href="mypage_hensyu.css">
    </head>

    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="logout"><a href="logout.php">ログアウト</a></div>
        </header>

        <main>
            <!-- このbodyの中に、マイページとして表示する部分を記述していく
            （HTMLとsessionを記述。編集できるように、sessionはvalueに入れる。） -->
            <div class="mypage_hensyu">
                <h2>会員情報</h2>
                <p class="comments">こんにちは！<?php echo $_SESSION['name']; ?>さん</P>

                <form class="back" action="mypage_update.php" method="post">
                    <div class="box">
                        <div class="picture"><img src="<?php echo $_SESSION['picture']; ?>"></div>
                        <div class="user_info">
                            <p>氏名：<input type="text" size="30" value="<?php echo $_SESSION['name']; ?>" name="name" required></p>
                            <p>メール：<input type="text" size="30" value="<?php echo $_SESSION['mail']; ?>" name="mail" required></p>
                            <p>パスワード：<input type="text" size="30" value="<?php echo $_SESSION['password']; ?>" name="password" required></p>
                        </div>
                    </div>
                    <div class="comento">
                        <textarea rows="10" cols="70" name="comments"><?php echo $_SESSION['comments']; ?></textarea>
                    </div>
                    <div class="botan">
                        <input type="submit" class="button1" value="この内容に変更する">
                    </div>
                </form>
            </div>
        </main>

        <footer>
            © 2018 InterNouse.inc. All rights reserved
        </footer>
    </body>
</html>
