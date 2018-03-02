<?php
 session_start();
 if (isset($_POST['login']) and isset($_POST['password'])){
 	if ($_POST['login'] == 'login' and $_POST['password'] == 'password'){
 		$_SESSION['logged'] = true;
 		header('Location:/myblog/index.php');
 	}
 	else{
 		$_SESSION['logged'] = false;
 		echo "Incorrect password!";
 	}
 }
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<title>Авторизация</title>
	<meta charset="utf-8">
</head>
<body>
	<div class="container">
		<div class="row">
		<form action="/myblog/login.php" method="post">
  				<div class="form-group">
    				<label for="login">Login</label>
    				<input type="text" class="form-control" id="login" placeholder="Enter login" name="login">
  				</div>
  				<div class="form-group">
    				<label for="password">Password</label>
    				<input type="password" class="form-control" id="password" placeholder="Password" name="password">
  				</div>
  				<button type="submit" class="btn btn-primary">Вход</button>
			</form>
		</div>
	</div>
</body>
</html>