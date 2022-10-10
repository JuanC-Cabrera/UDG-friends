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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <title>Wellcome to UDG-Friends</title>
</head>
<body>

<?php if(!empty($user)): ?>
    <div style="margin-top:100px" class="container">
        <div class="card">
            <div class="card-body">
                <h1>Wellcome <?= $user['email']?></h1>
                <p>
                    <br>You are Successfully Logged In 
                    <a href="logout.php">Logout</a>
                </p>
            </div>
        </div>
    </div>
<?php else: ?>
    <div style="margin-top:100px" class="container">
        <div class="card">
            <div class="card-body">
                <h1>Please Login or SignUp</h1>
                <a href="login.php">Login</a> or 
                <a href="signup.php">SignUp</a>
            </div>
        </div>
    </div>
<?php endif;?>
</body>
</html>