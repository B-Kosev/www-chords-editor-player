<!DOCTYPE html>
<html>
	<head>
		<title>Chord Editor</title>
		<?php include('./components/head.php')?>
		<link href="./static/css/auth.css" rel="stylesheet" />
	</head>
	<body>
		<?php include('./components/navigation.php')?>

		<section class="wrapper">
			<section>
				<form class="form" id="login-form">
					<label>Log in</label>
					<input class="field" type="text" placeholder="Username" name="username" id="username" required />
					<span class="errorMsg" id="username-err"></span>
					<input class="field" type="password" placeholder="Password" name="password" id="password" required />
					<span class="errorMsg" id="password-err"></span>
					<span class="errorMsg" id="credentials-err"></span>
					<input class="btn" type="submit" value="Sign in" name="login" />
				</form>
			</section>
		</section>
		
		<?php include('./components/footer.php')?>

		<footer></footer>
		<script src="./static/js/loginStatus.js"></script>
		<script src="./static/js/login.js"></script>
		<script src="./static/js/navigation.js"></script>
	</body>
</html>
