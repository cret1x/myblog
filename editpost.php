<?php  
session_start();
$id = $_GET['id'];
if(!$_SESSION['logged'])
	header("Location:/myblog/post.php?id=".$id);
else{
	if(isset($_POST['title']) and isset($_POST['text']))
	{
		$title = $_POST['title'];
		$text = $_POST['text'];
		$connection = mysqli_connect('127.0.0.1', 'root', '');
		mysqli_select_db($connection, 'blog');
		mysqli_set_charset($connection, 'utf8');
		$sql = "INSERT INTO posts (`id`, `title`, `text`, `date`, `comments_num`) VALUES (NULL, '".$title."', '".$text."', CURRENT_TIMESTAMP, '')";
		mysqli_query($connection, $sql);
		header("Location:/myblog/index.php");
	}
	else
	{
		$connection = mysqli_connect('127.0.0.1', 'root', '');
		mysqli_select_db($connection, 'blog');
		mysqli_set_charset($connection, 'utf8');
		$query_result = mysqli_query($connection, 'SELECT title, text FROM posts WHERE id='.$id);
		$posts = mysqli_fetch_all($query_result);
		foreach ($posts as $post) {
			$title = $post[0];
			$text = $post[1];
		}
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Редактирование</title>
	<meta charset="utf-8">
</head>
<body>
	<div class="container">
		<?php echo('<a href="/myblog/post.php?id='.$id.'">назад</a>')?>
		<?php 
			echo ('<form class="form-group" action="/myblog/scripts/editpost.php?id='.$id.'" method="POST">');
		 ?>
			<div class="form-group">
    			<label for="title">Заголовок</label>
    			<textarea name="title" class="form-control"><?php echo $title; ?></textarea>
  			</div>
  			<div class="form-group">
  				<label for="text">Текст записи</label>
  				<textarea name="text" class="form-control"><?php echo $text; ?></textarea>
  			</div>
			<button type="submit" class="btn btn-primary">Готово</button>
		</form>
	</div>
</body>
</html>