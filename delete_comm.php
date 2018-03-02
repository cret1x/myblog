<?php 
		$id = $_GET['id'];
		$c_id = $_GET['c_id'];
		session_start();
		if(!$_SESSION['logged'])
		header("Location:/myblog/post.php?id=".$id);
		$connection = mysqli_connect('127.0.0.1', 'root', '');
		mysqli_select_db($connection, 'blog');
		mysqli_set_charset($connection, 'utf8');
		mysqli_query($connection, 'DELETE FROM comments WHERE comments.'.'id='.$c_id);
		header("Location:/myblog/post.php?id=".$id);
 ?>