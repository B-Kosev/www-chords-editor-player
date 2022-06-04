<!DOCTYPE html>
<html>
	<head>
		<title>Chord Editor</title>
		<?php include('./components/head.php')?>
		<link href="./static/css/auth.css" rel="stylesheet" />
		<!-- <script src="./static/js/loginStatus.js"></script> -->
	</head>
	<body>
		<?php include('./components/navigation.php')?>

		<section>
			<!-- action="../php/web/UserController.php" method="post"  -->
			<form class="form" id="register-form">
				<label>Register</label>
				<input type="text" class="field" placeholder="Username" name="username" id="username" required />
				<span class="errorMsg" id="username-err"></span>
				<input type="email" class="field" placeholder="E-mail" name="email" id="email" required />
				<span class="errorMsg" id="email-err"></span>
				<input type="password" class="field" placeholder="Password" name="password" id="password" required />
				<span class="errorMsg" id="password-err"></span>
				<input
					type="password"
					class="field"
					placeholder="Confirm Password"
					name="confirm_password"
					id="confirm-password"
					required
				/>
				<span class="errorMsg" id="confirm-password-err"></span>
				<input type="submit" value="Sign up" class="btn" name="register" />
			</form>
		</section>

		<script src="./static/js/loginStatus.js"></script>
		<script src="./static/js/register.js"></script>
		<script src="./static/js/navigation.js"></script>
	</body>
</html>
