<?php
session_start();
//login
if(isset($_POST['login']) && isset($_POST['password'])){
    $log='log';
    $pass='pass';
    if($_POST['login']==$log && $_POST['password']== $pass){
        $_SESSION['login']=$log;
        $_SESSION['password']=$pass;
        header('location:index.php');
        exit;
    }
}




?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Control panel</title>
        <link rel="stylesheet" href="css/main.css">
    </head>
    <body>
        <div id="admin" class="white">
            <h3>Ադմինիստրացիոն համակարգ</h3>
            <form action="admin.php" method="post">
                <p><input type="text" name="login" placeholder="login"></p>
                <p><input type="password" name="password" placeholder="password"></p>
                <p><button type="submit">Մուտք</button></p>
            </form>
            <p>login: log</p>
            <p>password: pass</p>
        </div>
    </body>
</html>