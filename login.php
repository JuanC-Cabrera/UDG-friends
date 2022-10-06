<?php

    session_start();

    if(isset($_SESSION['user_id'])){
        header('Location: /UDG-friends');
    }

    require 'database.php';

    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $records = $conn->prepare('SELECT id,email,password FROM users WHERE email=:email');
        $records->bindParam(':email',$_POST['email']);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);

        $message = '';

        if(count($result)>0 && password_verify($_POST['password'], $result['password'])){
            $_SESSION['user_id'] = $result['id'];
            header('Location: /UDG-friends');
        } else {
            $message = 'Sorry, those credentials do not match';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <span>or<a href="signup.php">SignUp</a></span>

    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
        <?php endif; ?>

    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Enter your password">
        <input type="submit" value="Send">
    </form>
</body>
</html>