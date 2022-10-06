<?php
    session_start();
 
    require 'database.php';

    if (isset($_SESSION['user_id'])) {
        $records = $conn->prepare('SELECT id,email,password FROM users WHERE id=:id');
        $records->bindParam(':id', $_SESSION['user_id']);
        $records->execute();
        $result = $records->fetch(PDO::FETCH_ASSOC);

        $user = null;

        if (count($result)>0) {
            $user = $result;
        }

    }

?>


<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Wellcome to UDG-Friends</title>
</head>
<body>

<?php if(!empty($user)): ?>
    <br>Wellcome. <?= $user['email']?>
    <br>You are Successfully Logged In 
    <a href="logout.php">Logout</a>
<?php else: ?>
    <h1>Please Login or SignUp</h1>
    <a href="login.php">Login</a> or 
    <a href="signup.php">SignUp</a>
<?php endif;?>
</body>
</html>