<?php
		session_start();
		if ($_SESSION['logged']) {
			$c_delete = " [удалить]";
			$c_edit = " [редактировать]";
		}
		else
		{
			$c_edit = "";
			$c_delete = "";
		}
		if(isset($_GET['id']))
		{
			$id = $_GET['id'];
		}
		$connection = mysqli_connect('127.0.0.1', 'root', '');
		mysqli_select_db($connection, 'blog');
		mysqli_set_charset($connection, 'utf8');
		$query_result = mysqli_query($connection, 'SELECT title FROM posts WHERE id='.$id);
		$posts = mysqli_fetch_all($query_result);
		foreach ($posts as $post) {
			$title = $post[0];
		}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title><?php echo $title ?></title>
	<meta charset="utf-8">
</head>
<body>
	<?php
		# Пихается коммент
		if(isset($_POST['author']) and isset($_POST['text'])){
			$author = $_POST['author'];
			$text = $_POST['text'];
			mysqli_query($connection, "INSERT INTO comments (author, text, post_id) VALUES ('$author', '$text', '$id')");			
		}	
		# вывод поста
		$query_result = mysqli_query($connection, 'SELECT title, text FROM posts WHERE id='.$id);
		$posts = mysqli_fetch_all($query_result);
		foreach ($posts as $post) {						#удаление поста ссылка								редактирование поста
			echo '<h3>'.$post[0].'</h3>'.'<a href="/myblog/scripts/delpost.php?id='.$id.'">'.$c_delete.'</a>'.'<a href="/myblog/scripts/editpost.php?id='.$id.'">'.$c_edit.'</a>'.'<p>'.$post[1].'</p>'.'<br>';
    		echo '<a href=/myblog/>Назад</a>';
		}
		echo '<h4>Комментарии:</h4>';
		# Комменты
 		$query_result = mysqli_query($connection, 'SELECT * FROM comments WHERE post_id='.$id);
		$comments = mysqli_fetch_all($query_result);
		echo '<ul>';
		foreach ($comments as $comment)
		{
    		echo '<li>'.$comment[1].': '.$comment[2].'<a href="/myblog/scripts/delete_comm.php?id='.$id.'&c_id='.$comment[0].'">'.$c_delete.'</a>'.'</li>';
		}
		echo '</ul>';
	?>
	<!--Новый коммент-->
	<form action=<?php echo("/myblog/post.php/?id=".$id) ?> method="post">
			<p>Оставьте комментарий:</p>
			<p>Имя</p>
			<input type="text" name="author">
			<p>Введите текст вашего комментария</p>
			<textarea name="text"></textarea>
			<input type="submit" value="Отправить">
	</form>
</body>
</html>