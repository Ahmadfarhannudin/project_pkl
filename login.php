<?php
session_start();

//session
if(isset($_SESSION["log"])){
    header("Location: index.php");
    exit;
}
require 'functions.php';
//login
if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");
    if(mysqli_num_rows($result) ===1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            $_SESSION['log'] = true;
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>TAMPILAN LOGIN</title>
</head>
<body>
<?php if(isset($error)): ?>
        <script>
            alert('username / password salah');
        </script>
    <?php endif; ?>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form action="" method="post">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="person-outline"></ion-icon>
                        <input type="text" name="username" required>
                        <label for="username">username</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" name="password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="forget">
                        <label for=""><input type="checkbox" name="remember">Remember Me</label>
                    </div>
                    <button type="submit" name="login">Log in</button>
                    <!-- <div class="register">
                        <p>Don't have a account <a href="register.php">Register</a></p>
                    </div> -->
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>