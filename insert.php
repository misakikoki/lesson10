<?php
mb_internal_encoding("utf8");
session_start();
$password = password_hash($_POST["password"],PASSWORD_DEFAULT);
try {
    $pdo = new PDO("mysql:dbname=php_practice;host=localhost;", "root", "");  //DBに接続
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  //エラーモードを「例外」に設定

    $stmt = $pdo->prepare("INSERT INTO user(name, mail, age, password, comments) VALUES(?,?,?,?,?)");
    $stmt->execute(array($_POST["name"], $_POST["mail"], $_POST["age"], $password, $_POST["comments"]));
} catch (PDOException $e) {
    $e->getMessage();
}

$pdo = null;


$_SESSION = array();

if (isset($_COOKIE["session_name()"])) {
    setcookie("session_name()", "", time() - 1800, "/");  //sessionIDの削除
}

session_destroy();

?>
<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>フォームを作る</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>
    <h1>登録完了</h1>
    <div class="confirm">
        <p>登録有難うございました。</p>
        <form action="index.php">
            <input type="submit" class="button1" value="TOPに戻る">
        </form>
    </div>
</body>

</html>