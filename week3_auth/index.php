<?php
    session_start();
    if (!isset($_SESSION['username'])):
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>

<body>
    <form method="post" action="<?php echo $_SERVER[PHP_SELF]?>">
        Username: <input type="text" name="username">
        <input type="submit">
    </form>
</body>
</html>

<?php 
    endif;
?>


