<?php

session_start();

if (!isset($_SESSION['uid']))
	$uid = "";
else
	$uid = $_SESSION['uid'];

//is it a form submit?
if (isset($_POST['username']) && isset($_POST['password'] && $_POST['username'] != "" && $_POST['password'] != "")
{
	//yes, check db
	select password from user where user=$_POST['user'] -?> do it ina prepare
	$testpass = md5($_POST['password')
	if $testpass == $storedPass

	//good password -> set session
	//else set error
	
}
html stuff

<?Php
if ($error != "")
	print "<div>$error</div>";

...

<?php
if ($uid != "")
	print button to display.php
else
	display form


/**
 * <?php
 *
 * if ($error != "") {
 *         print "<div>$error</div>";
 *                 die;
 *                 }
 *                 if ($uid != "") {
 *                     //print button to display.php
 *                         print "login success"
 *                         }
 *                         else {
 *                             //display form
 *                                 print "login fail"
 *                                 }
 *                                 ?>
 *                                  */
