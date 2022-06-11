<!DOCTYPE html>
<html>
	<head>
		<title>Chord Editor</title>
		<?php include('./components/head.php')?>
		<link href="./static/css/songlist.css" rel="stylesheet" />
	</head>
	<body>
		<?php include('./components/navigation.php')?>

		<section class="wrapper">
			<section class="newSong">
				<a href="addsong.php" class="link" href="addsong.html" id="new-song-btn">New Song</a>
			</section>

			<h2><span class="em">Song</span> List</h2>

			<section class="cards"></section>
		</section>

		<?php include('./components/footer.php')?>

		<script src="./static/js/loginStatus.js"></script>
		<script src="./static/js/songlist.js"></script>
		<script src="./static/js/navigation.js"></script>
	</body>
</html>
