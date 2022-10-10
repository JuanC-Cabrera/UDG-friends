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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<div style="margin-top:50px" class="container">   
<div style="margin-bottom:50px" class="container">
    <h1 style="color:#052e6c; text-align: center" >Login</h1>
    </div>
    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
        <?php endif; ?>
        <div class="container">
             <div class="card">
                <div class="card-body">
                    <form action="login.php" method="post">
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input type="text" class="form-control" name="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                        <input type="submit" class="btn btn-success" value="Send">
                        <a style="margin-left:20px" href="signup.php">Registrarse</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
</body>
</html>