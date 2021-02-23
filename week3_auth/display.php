<?php
// start the session
session_start();
if (!isset($_SESSION['username'])){
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display</title>
</head>

<body>
    <header><?php echo $username?></header>
</body>
</html>