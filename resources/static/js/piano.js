$(document).ready(function () {
	$(".btn.key").on("click", function () {
		$(".btn.key").removeClass("selected");
		$(this).addClass("selected");
	});

	$(".btn.type").on("click", function () {
		$(".btn.type").removeClass("selected");
		$(this).addClass("selected");
	});
});
