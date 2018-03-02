<?php  
session_start();
if($_SESSION['logged'])
{
	if(isset($_POST['title']) and isset($_POST['text'])){
	$title = $_POST['title'];
	$text = $_POST['text'];
	$connection = mysqli_connect('127.0.0.1', 'root', '');
	mysqli_select_db($connection, 'blog');
	mysqli_set_charset($connection, 'utf8');
	$sql = "INSERT INTO `posts` (`id`, `title`, `text`, `date`, `comments_num`) VALUES (NULL, '".$title."', '".$text."', CURRENT_TIMESTAMP, '')";
	mysqli_query($connection, $sql);
	header("Location:/myblog/index.php");
	}
}
else
	header("Location:/myblog/index.php");
?>


<!DOCTYPE html>
<html>
<head>
	<title>Новая запись</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<meta charset="utf-8">
</head>
<body>
<div class="container">
	<form action="/myblog/scripts/newpost.php" method="POST">
		<div class="form-group">
    		<label for="title">Заголовок</label>
    		<input type="text" class="form-control" id="login" placeholder="Введите заголовок" name="title">
  		</div>
  		<div class="form-group">
  			<label for="text">Текст записи</label>
  			<textarea class="form-control" name="text"></textarea>
  		</div>
		<button type="submit" class="btn btn-primary">Готово</button>
	</form>
	<a href="/myblog/index.php">назад</a>
</div>
</body>
</html>