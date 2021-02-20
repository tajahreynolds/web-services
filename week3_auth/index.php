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

    $username = $_SESSION['username'];

                                                                                                                                                                                                       
                                                                                                                 
?>







