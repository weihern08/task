<?php
$dbHost = 'localhost';
$dbUser = 'root';
$dbPass = '081101';
$dbName = 'task_db';
$message = '';

$conn = mysqli_connect($dbHost, $dbUser, $dbPass);
if (!$conn) {
    die('Database connection failed.');
}

mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS $dbName");
mysqli_select_db($conn, $dbName);

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
)");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === '' || $password === '') {
        $message = 'Please enter username and password.';
    } else {
        $sql = "SELECT password FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])) {
                header('Location: task1.html');
                exit;
            } else {
                $message = 'Username or password is incorrect.';
            }
        } else {
            $message = 'Username or password is incorrect.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
</head>
<body>
  <h2>Login</h2>
  <form method="post">
    <p>
      <label>Username:</label><br />
      <input type="text" name="username" required />
    </p>
    <p>
      <label>Password:</label><br />
      <input type="password" name="password" required />
    </p>
    <p>
      <button type="submit">Login</button>
    </p>
  </form>

  <p><a href="register.php">Go to Register</a></p>

  <?php if ($message !== ''): ?>
    <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
  <?php endif; ?>
</body>
</html>
