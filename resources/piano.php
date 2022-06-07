<!DOCTYPE html>
<html>
	<head>
		<title>Chord Editor</title>
		<?php include('./components/head.php')?>
		<link href="./static/css/piano.css" rel="stylesheet" />
	</head>
	<body>
		<?php include('./components/navigation.php')?>

		<h2><span class="em">Piano</span> Chord Chart</h2>

		<section class="buttons">
			<figure class="keys">
				<ul>
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
			</figure>

			<figure class="min-maj">
				<ul>
					<li><button id="maj" class="btn type selected" type="button">Major</button></li>
					<li><button id="min" class="btn type" type="button">Minor</button></li>
				</ul>
			</figure>
		</section>

		<section class="pianos">
			<section class="piano inv1">
				<section class="piano-keys">
					<ul class="octave first">
						<ul class="whites">
							<li class="white c1"></li>
							<li class="white d1"></li>
							<li class="white e1"></li>
							<li class="white f1"></li>
							<li class="white g1"></li>
							<li class="white a1"></li>
							<li class="white b1"></li>
						</ul>
						<ul class="blacks">
							<li class="black cs1"></li>
							<li class="black ds1"></li>
							<li class="black fs1"></li>
							<li class="black gs1"></li>
							<li class="black as1"></li>
						</ul>
					</ul>
					<ul class="octave second">
						<ul class="whites">
							<li class="white c2"></li>
							<li class="white d2"></li>
							<li class="white e2"></li>
							<li class="white f2"></li>
							<li class="white g2"></li>
							<li class="white a2"></li>
							<li class="white b2"></li>
						</ul>
						<ul class="blacks">
							<li class="black cs2"></li>
							<li class="black ds2"></li>
							<li class="black fs2"></li>
							<li class="black gs2"></li>
							<li class="black as2"></li>
						</ul>
					</ul>
					<ul class="octave third">
						<ul class="whites">
							<li class="white c3"></li>
							<li class="white d3"></li>
							<li class="white e3"></li>
							<li class="white f3"></li>
							<li class="white g3"></li>
							<li class="white a3"></li>
							<li class="white b3"></li>
						</ul>
						<ul class="blacks">
							<li class="black cs3"></li>
							<li class="black ds3"></li>
							<li class="black fs3"></li>
							<li class="black gs3"></li>
							<li class="black as3"></li>
						</ul>
					</ul>
				</section>
				<audio class="audio inv1" controls></audio>
			</section>

			<section class="piano inv2">
				<section class="piano-keys">
					<ul class="octave first">
						<ul class="whites">
							<li class="white c1"></li>
							<li class="white d1"></li>
							<li class="white e1"></li>
							<li class="white f1"></li>
							<li class="white g1"></li>
							<li class="white a1"></li>
							<li class="white b1"></li>
						</ul>
						<ul class="blacks">
							<li class="black cs1"></li>
							<li class="black ds1"></li>
							<li class="black fs1"></li>
							<li class="black gs1"></li>
							<li class="black as1"></li>
						</ul>
					</ul>
					<ul class="octave second">
						<ul class="whites">
							<li class="white c2"></li>
							<li class="white d2"></li>
							<li class="white e2"></li>
							<li class="white f2"></li>
							<li class="white g2"></li>
							<li class="white a2"></li>
							<li class="white b2"></li>
						</ul>
						<ul class="blacks">
							<li class="black cs2"></li>
							<li class="black ds2"></li>
							<li class="black fs2"></li>
							<li class="black gs2"></li>
							<li class="black as2"></li>
						</ul>
					</ul>
					<ul class="octave third">
						<ul class="whites">
							<li class="white c3"></li>
							<li class="white d3"></li>
							<li class="white e3"></li>
							<li class="white f3"></li>
							<li class="white g3"></li>
							<li class="white a3"></li>
							<li class="white b3"></li>
						</ul>
						<ul class="blacks">
							<li class="black cs3"></li>
							<li class="black ds3"></li>
							<li class="black fs3"></li>
							<li class="black gs3"></li>
							<li class="black as3"></li>
						</ul>
					</ul>
				</section>
				<audio class="audio inv2" controls></audio>
			</section>

			<section class="piano inv3">
				<section class="piano-keys">
					<ul class="octave first">
						<ul class="whites">
							<li class="white c1"></li>
							<li class="white d1"></li>
							<li class="white e1"></li>
							<li class="white f1"></li>
							<li class="white g1"></li>
							<li class="white a1"></li>
							<li class="white b1"></li>
						</ul>
						<ul class="blacks">
							<li class="black cs1"></li>
							<li class="black ds1"></li>
							<li class="black fs1"></li>
							<li class="black gs1"></li>
							<li class="black as1"></li>
						</ul>
					</ul>
					<ul class="octave second">
						<ul class="whites">
							<li class="white c2"></li>
							<li class="white d2"></li>
							<li class="white e2"></li>
							<li class="white f2"></li>
							<li class="white g2"></li>
							<li class="white a2"></li>
							<li class="white b2"></li>
						</ul>
						<ul class="blacks">
							<li class="black cs2"></li>
							<li class="black ds2"></li>
							<li class="black fs2"></li>
							<li class="black gs2"></li>
							<li class="black as2"></li>
						</ul>
					</ul>
					<ul class="octave third">
						<ul class="whites">
							<li class="white c3"></li>
							<li class="white d3"></li>
							<li class="white e3"></li>
							<li class="white f3"></li>
							<li class="white g3"></li>
							<li class="white a3"></li>
							<li class="white b3"></li>
						</ul>
						<ul class="blacks">
							<li class="black cs3"></li>
							<li class="black ds3"></li>
							<li class="black fs3"></li>
							<li class="black gs3"></li>
							<li class="black as3"></li>
						</ul>
					</ul>
				</section>
				<audio class="audio inv3" controls></audio>
			</section>
		</section>

		<script src="./static/js/loginStatus.js"></script>
		<script src="./static/js/piano.js"></script>
		<script src="./static/js/navigation.js"></script>
	</body>
</html>
