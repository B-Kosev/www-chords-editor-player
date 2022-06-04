<!DOCTYPE html>
<html>
	<head>
		<title>Chord Editor</title>
		<?php include('./components/head.php')?>
		<link href="./static/css/songlist.css" rel="stylesheet" />
	</head>
	<body>
		<?php include('./components/navigation.php')?>

		<section class="newSong">
			<h2>Song List</h2>
			<a href="addsong.php" class="link" href="addsong.html" id="new-song-btn">New Song</a>
		</section>

		<section class="cards"></section>

		<script src="./static/js/loginStatus.js"></script>
		<script src="./static/js/songlist.js"></script>
		<script src="./static/js/navigation.js"></script>
	</body>
</html>
