$(function() {
	$("a.button.toggle").live("click", function() {
		var target = $($(this).attr("target"));
		
		target.toggle();
		if (target.is(":visible")) {
			$(this).text("Hide");
		} else {
			$(this).text("Show");
		}
		
		return false;
	});
});