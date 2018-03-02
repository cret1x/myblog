<?php  
session_start();
if($_SESSION['logged']){
	$id = $_GET['id'];
	$connection = mysqli_connect('127.0.0.1', 'root', '');
	mysqli_select_db($connection, 'blog');
	mysqli_set_charset($connection, 'utf8');
	$sql = "DELETE FROM posts WHERE posts."."id = ".$id;
	mysqli_query($connection, $sql);
	header("Location:/myblog/index.php");
}
else
	header("Location:/myblog/index.php");	
?>