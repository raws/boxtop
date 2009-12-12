$(function() {
	// Bind event to window.onhashchange.
	$(window).bind("hashchange", function() {
		var url = $.param.fragment();
		
		if (!url) { return; }
		
		switch (url) {
			case "edit":
				$("#edit_button").click();
				break;
		}
	});
	
	// Add functionality to "Edit" button.
	$("#edit_button").ajaxify();
	
	// Add functionality to "Delete" button.
	$("#delete_button").ajaxify({ "confirm": "Are you sure you want to " +
		"permanently delete this snippet? This action cannot be undone." });
	
	// Trigger the hashchange event to handle any hash the page
	// may have loaded with.
	$(window).trigger("hashchange");
});