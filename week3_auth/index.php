<?php
// start the session
session_start();
if (!isset($_SESSION['username'])):
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
<?php

endif;

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
        print('bind');
        if (!$stmt->bind_param("s",$username)) { 
            print $mysqli->error;
            return;
        }
        print('exec');
        if (!$stmt->execute()) {
            print $mysqli->error;
            return;
        }
        print('bind');
        if (!$stmt->bind_result($storedPass)) {
            print "Failed to bind output";
            return;
        }
        print('validate');
        $testpass = md5($_POST['password']);
        $stmt->fetch();
            if ($testpass == $storedPass):
                //good password -> set session  
		        $username = $_POST['username'];
                print($username);
                // redirect to display.php
                header("Location: display.php");
                exit;
            else:
                // bad password display error
                $error = "invalid password";
                print($error);
                //show form and populate username
?>

<body>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
        Username: <input type="text" name="username" value=<?php echo $_POST['username'];?>><br>
        Password: <input type="password" name="password"><br>
        <input type="submit">
    </form>
    
</body>
</html>
                
<?php       endif;

    } else {
        print "failed to prepare " . $mysqli->error;
        return;
    }
    
}   
                                                                                                                                                                                             
                                                                                                                 
?>







