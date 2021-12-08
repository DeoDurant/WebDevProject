
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Professor Oak's Pokedex - Login</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;400&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="loginstyles.css">
</head>

<body>
	<div class="container">
		<form action="processLogin.php" method="POST" class="login-email">
			<p class="login-text" style="font-size: 2rem; font-weight: 800;">Login</p>
			<div class="input-group">
				<input type="text" placeholder="Username" name="username" required>
			</div>
			<div class="input-group">
				<input type="password" placeholder="Password" name="password" required>
			</div>
			<div class="input-group">
				<button name="submit" value="login" class="btn">Login</button>
			</div>
			<?php if (isset($_GET['error'])) : ?>
				<div class="input-group error"><?php echo $_GET['error'] ?></div>
			<?php endif ?>
			<p class="login-register-text">Don't have an account? <a href="register.php">Register Here</a>.</p>
			<p class="login-register-text">Want to sign in as a guest? <a href="guestlogin.php">Guest Login</a></p>
		</form>
	</div>
</body>

</html>