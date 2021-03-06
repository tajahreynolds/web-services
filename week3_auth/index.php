<?php
// start the session
session_start();
if (!isset($_SESSION['username']) && !isset($_POST['username'])):
    $username = "";

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

<?php elseif (isset($_POST['username'])): ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>

<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        Username: <input type="text" name="username" value="<?php echo $_POST['username']?>"><br>
        Password: <input type="password" name="password"><br>
        <input type="submit">
    </form>
    
</body>
</html>
<?php

endif;

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    error_log("login from session");
    header("Location: display.php");
    exit;
}

if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST['password'] != "") {                                                                                                                 
    // yes, check db  
    require_once("passwords.php");
    $mysqli = mysqli_connect($host, $user, $pass, $db);
    if (mysqli_connect_errno($mysqli)) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die;
    }
    // select password from user where user=$_POST['user'] -> do it ina prepare 
    if ($stmt = $mysqli->prepare("select password from users where name=?")) {
        if (!$stmt->bind_param("s", $_POST['username'])) { 
            print $mysqli->error;
            return;
        }
        if (!$stmt->execute()) {
            print $mysqli->error;
            return;
        }
        if (!$stmt->bind_result($storedPass)) {
            print "Failed to bind output";
            return;
        }
        $testpass = md5($_POST['password']);
        $stmt->fetch();
            if ($testpass == $storedPass) {
                //good password -> set session  
		        $username = htmlspecialchars(trim($_POST['username']));
                $_SESSION['username'] = $username;
                error_log("sucessful login from form");
                // redirect to display.php
                header("Location: display.php");
                exit;
            } else {
                // bad password display error
                $error = "Invalid Password";
                error_log("failed login from form");
                print($error);
            }

    } else {
        print "failed to prepare " . $mysqli->error;
        return;
    }
    
}   
                                                                                                                                                                                             
                                                                                                                 
?>







