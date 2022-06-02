<!DOCTYPE html>
<html>
	<head>
		<title>Chord Editor</title>
		<?php include('./components/head.php')?>
		<link href="./static/css/auth.css" rel="stylesheet" />
	</head>
	<body>
		<?php include('./components/navigation.php')?>

		<section>
			<form class="form" id="song-form">
				<label>Add song</label>
				<input class="field" type="text" placeholder="Title" name="title" id="title" required />
				<span class="errorMsg" id="title-err"></span>
				<input class="field" type="text" placeholder="Author" name="author" id="author" required />
				<span class="errorMsg" id="author-err"></span>
				<input class="field" type="text" placeholder="Key" name="key" id="key" required />
				<span class="errorMsg" id="key-err"></span>
				<input class="field" type="number" placeholder="Year" name="year" id="year" required />
				<span class="errorMsg" id="year-err"></span>
				<input class="field" type="text" placeholder="Duration" name="duration" id="duration" required />
				<span class="errorMsg" id="duration-err"></span>
				<input class="field" type="number" placeholder="Tempo" name="tempo" id="tempo" required />
				<span class="errorMsg" id="tempo-err"></span>
				<input class="field" type="text" placeholder="Time Signature" name="signature" id="signature" required />
				<span class="errorMsg" id="signature-err"></span>
				<input class="field" type="text" placeholder="Youtube link" name="ytlink" id="ytlink" required />
				<span class="errorMsg" id="ytlink-err"></span>
				<textarea class="field" placeholder="Song lyrics" name="text" id="text" required></textarea>
				<span class="errorMsg" id="text-err"></span>
				<input class="btn" type="submit" value="Add Song" name="add-song" id="submit-btn" />
			</form>
		</section>

		<script src="./static/js/loginStatus.js"></script>
		<script src="./static/js/addSong.js"></script>
	</body>
</html>
