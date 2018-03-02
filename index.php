<?php
 session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Мой блог</title>
	<meta charset="utf-8">
</head>
<body>
	<div class="container">
    <div class="row">
        <div class="col-9">
        	<h1>Главная страница</h1>
        </div>
        <div class="col-2.5">
        	<a href="/myblog/login.php">Авторизация</a>
        </div>    
        <?php 
        if(isset($_SESSION['logged'])){
        	if ($_SESSION['logged']) {
        		echo('<div class="col-1">
        				<a href="/myblog/scripts/logout.php"> | Выйти</a>
        			</div>'  );
        	}
        }
        ?>
    	</div>
    	<?php  
    	if(isset($_SESSION['logged'])){
    	if($_SESSION['logged'])
    	{
    		echo ('<a href="/myblog/scripts/newpost.php">Новая запись</a>');
    	}
    	}
    	?>
	<?php
		$connection = mysqli_connect('127.0.0.1', 'root', '');
		mysqli_select_db($connection, 'blog');
		mysqli_set_charset($connection, 'utf8');

		$query_result = mysqli_query($connection, 'SELECT * FROM posts ORDER BY date DESC');
		$posts = mysqli_fetch_all($query_result);
		foreach ($posts as $post)
		{
			$query_result = mysqli_query($connection, 'SELECT COUNT(id) FROM comments WHERE post_id='.$post[0]);
			$cmms = mysqli_fetch_all($query_result);
			foreach ($cmms as $cm) {
				$comments_num = $cm[0];
			}
			mysqli_query($connection, "UPDATE posts SET comments_num =".$comments_num." WHERE id=".$post[0]);
			$title = $post[1];
			$text = substr($post[2], 0, 200);
			$text = substr($text, 0, strrpos($text, ' '));
			$text = $text."… ";
    		echo '<h3>'.$title.'</h3>'.'<p>'.$text.'</p>'.'<br>';
    		echo '<h4>Количество комментариев: '.$post[4].'</h4>';
    		echo '<a href=/myblog/post.php?id='.$post[0].'>Перейти</a>';
    		echo '<hr>';
		}
		?>
	</div>
</body>
</html>
