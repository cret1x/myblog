<?php 
session_start();
if ($_SESSION['logged']) {
	$_SESSION['logged'] = false;
	header("Location:/myblog/index.php");
}
?>