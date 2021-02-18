<?php
session_start();
if (!isset($_SESSION['username'])):
    $_SESSION['username'] = "";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>

<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit">
    </form>
</body>
</html>

<?php
endif;

if (isset($_REQUEST['username']) && isset($_REQUEST['password'])) {
    $username = htmlspecialchars($_REQUEST['username']);
    $password = hash('sha256',$_REQUEST['password']);
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
}
require_once("passwords.php");
$mysqli = mysqli_connect($host, $user, $pass, $db);
if (mysqli_connect_errno($mysqli)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die;
}
?>



