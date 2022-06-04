<!DOCTYPE html>
<html>
	<head>
		<title>Chord Editor</title>
		<?php include('./components/head.php')?>
		<link href="./static/css/instruments.css" rel="stylesheet" />
	</head>
	<body>
		<?php include('./components/navigation.php')?>

		<h2>Instruments</h2>

		<section class="cards">
			<section class="card">
				<a href="piano.php?chordId=c&chordType=maj">
					<figure class="fig">
						<img src="./static/images/piano.jpg" />
						<figcaption>Piano</figcaption>
					</figure>
				</a>
			</section>
		</section>

		<script src="./static/js/loginStatus.js"></script>
		<script src="./static/js/navigation.js"></script>
	</body>
</html>
