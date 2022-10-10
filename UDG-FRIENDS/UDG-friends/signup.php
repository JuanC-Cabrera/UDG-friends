<?php
    require 'database.php';

     $message = '';

    if (!empty($_POST['email']) && !empty($_POST['password'])){
        $sql = "INSERT INTO users (email,password) VALUES (:email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);

        if ($stmt->execute()){
            $message = 'Successfully created new user';
        }else{
            $message = 'Sorry there must have been an issue';
        }

    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>SignUp</title>
</head>
<body> 
    <?php if(!empty($message)): ?>
        <p><?= $message ?></p>
        <?php endif; ?>
        <div style="margin-top:50px" class="container">
        <div style="margin-bottom:50px" class="container">
    <h1 style="color:#052e6c; text-align: center">SignUp</h1>
    <p style="color:#052e6c; text-align: center">or <a href="login.php">Login</a></p>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="signup.php" method="post">
                    <div class="mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Enter your password">
                        </div>
                        <div class="mb-3">
                        <input type="password" class="form-control" name="comfirm_password" placeholder="Confirm your password">
                        </div>
                        <div class="mb-3">
                        <input type="submit" class="btn btn-success"  value="Send">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    
</body>
</html>