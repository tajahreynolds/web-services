<?php
// start the session
session_start();
if (!isset($_SESSION['username']))
    $username = "";
else 
    $username = $_SESSION['username'];

if (isset($_POST['username']) && isset($_POST['password'] && $_POST['username'] != "" && $_POST['password'] != "") {                                                                                                                 
    // yes, check db  
    require_once("passwords.php");
    $mysqli = mysqli_connect($host, $user, $pass, $db);
    if (mysqli_connect_errno($mysqli)) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die;
    }
    // select password from user where user=$_POST['user'] -> do it ina prepare 
    if ($stmt = $mysqli->prepare("select password from users where user=?")) {
        print "failed to prepare " . $mysqli->error;
        return;
    }
    if (!$stmt->bind_param("s",$username)) { 
        print $mysqli->error;
        return;
    }
    if (!$stmt->execute() {
        print $mysqli->error;
        return;
    }
    if (!$stmt->bind_result($storedPass)) {
        print "Failed to bind output";
        return;
    }
    $testpass = md5($_POST['password');
    while ($stmt->fetch()) {
        if ($testpass == $storedPass){
            //good password -> set session  
            $username = $_SESSION['username'];
        }                                                                          
        else {
            $error = "invalid pass";
        }
    }
}                                                                                                                                                                                                              
                                                                                                                 
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





