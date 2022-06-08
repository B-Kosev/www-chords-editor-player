<!DOCTYPE html>
<html>
	<head>
		<title>Chord Editor</title>
		<?php include('./components/head.php')?>
		<link href="./static/css/song.css" rel="stylesheet" />
	</head>
	<body>
		<?php include('./components/navigation.php')?>

		<section class="song-info">
			<section class="song-meta">
				<ul class="song-meta-text">
					<h2 class="song-title"><span class="em"></span></h2>
					<h4 class="song-author"></h4>
					<h4 class="song-key"></h4>
					<h4 class="song-year"></h4>
					<h4 class="song-duration"></h4>
					<h4 class="song-tempo"></h4>
					<h4 class="song-signature"></h4>
				</ul>
				<iframe
					class="video"
					width="560"
					height="315"
					title="YouTube video player"
					frameborder="0"
					allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
					allowfullscreen
				></iframe>
			</section>

			<section class="buttons">
				<label class="switch">
					<h4 class="switch-title">Display Chords:</h4>
					<input type="checkbox" class="checkbox" id="checkbox" checked />
					<span class="slider"></span>
				</label>
	
				<ul class="keys" id="keys">
					<h4 class="transpose">Transpose:</h4>
					<li><button id="c" class="btn key selected" type="button">C</button></li>
					<li><button id="cs" class="btn key" type="button">C#</button></li>
					<li><button id="d" class="btn key" type="button">D</button></li>
					<li><button id="ds" class="btn key" type="button">D#</button></li>
					<li><button id="e" class="btn key" type="button">E</button></li>
					<li><button id="f" class="btn key" type="button">F</button></li>
					<li><button id="fs" class="btn key" type="button">F#</button></li>
					<li><button id="g" class="btn key" type="button">G</button></li>
					<li><button id="gs" class="btn key" type="button">G#</button></li>
					<li><button id="a" class="btn key" type="button">A</button></li>
					<li><button id="as" class="btn key" type="button">A#</button></li>
					<li><button id="b" class="btn key" type="button">B</button></li>
				</ul>

				<ul class="song-chords" id="song-chords">
					<h4 class="song-chords-title">Learn chords from the song:</h4>
				</ul>
			</section>

			<pre class="song-data" id="song-data"></pre>
		</section>

		<script src="./static/js/loginStatus.js"></script>
		<script src="./static/js/song.js"></script>
		<script src="./static/js/navigation.js"></script>
	</body>
</html>
