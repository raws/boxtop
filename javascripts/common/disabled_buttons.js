$(function() {
	// Disable event handling for disabled buttons.
	$("a.button.disabled").live("click", function() { return false; });
});