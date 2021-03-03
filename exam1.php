<?php 
session_start();
if (isset($_POST['hazel']) && $_POST['hazel'] != '')
{
	$hazel = $_POST['hazel'];
	if ($hazel%2 == 0) 
	{
		print "even";
	} else
	{
		for ($i = 0; $i < $hazel; $i++) {
			print "random";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>exam1-1</title>
</head>
<body>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
Number: <input type="number" name="hazel"><br>
<input type="submit">
</form>
</body>
</html>


