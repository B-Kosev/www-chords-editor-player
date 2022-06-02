<!DOCTYPE html>
<html>
	<head>
		<title>Chord Editor</title>
		<?php include('./components/head.php')?>
	</head>
	<body>
		<?php include('./components/navigation.php')?>

		<section class="cards">
			<section class="card">
				<a href="instruments.php">
					<figure class="fig">
						<img src="./static/images/chordCharts2.png" />
						<figcaption>Chord Charts</figcaption>
					</figure>
				</a>
			</section>

			<section class="card">
				<a href="songlist.php?chords=true">
					<figure class="fig">
						<img src="./static/images/lyrics2.png" />
						<figcaption>Lyrics With Chords</figcaption>
					</figure>
				</a>
			</section>

			<!-- TODO: Change image, add support for query params -->
			<section class="card">
				<a href="songlist.php?chords=false">
					<figure class="fig">
						<img src="./static/images/lyrics2.png" />
						<figcaption>Lyrics</figcaption>
					</figure>
				</a>
			</section>
		</section>

		<script src="./static/js/loginStatus.js"></script>
	</body>
</html>
