<?php

session_start();
if(isset($_SESSION['id'])){
    header("Location:mypage.php");
}

?>

<!DOCTYPE HTML>
<html lang="ja">
    <head>
        <title>ログインエラー</title>
        <link rel="stylesheet" type="text/css" href="login_error.css">
    </head>

    <body>
        <header>
            <img src="4eachblog_logo.jpg">
            <div class="login"><a href="login.php">ログイン</a></div>
        </header>

        <main>
            <form action="mypage.php" method="post">
                <div class="login_contents">
                    <div class="error">
                        <span>メールアドレスまたはパスワードが間違っています。</span>
                    </div>
                    <div class="mail">
                        <label>メールアドレス</label><br>
                        <input type="text" class="formbox" size="40" 
                        value="<?php if(isset($_COOKIE['login_keep'])){
                            echo $_COOKIE['mail'];
                        } ?>" name="mail" required>
                    </div>
                    <div class="password">
                        <label>パスワード</label><br>
                        <input type="password" class="formbox" size="40" 
                        value="<?php if(isset($_COOKIE['login_keep'])){
                            echo $_COOKIE['password'];
                        } ?>" name="password" required>
                    </div>
                    <div class="checkbox">
                        <input type="checkbox" class="checkbox2" name="login_keep" value="login_keep" 
                        <?php 
                        if(isset($_COOKIE['login_keep'])){
                            echo "checked='checked'";
                        }
                        ?>>
                    <label>ログイン状態を保持する</label></div>
                    <div class="login2">
                        <input type="submit" class="login_button" size="35" value="ログイン">
                    </div>
                </div>
            </form>
        </main>
        <footer>
            © 2018 InterNouse.inc. All rights reserved
        </footer>

    </body>
</html>