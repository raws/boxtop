// Placeholder HTML for when search results div is empty.
var nav_command_search_results_placeholder = '';

// Last search query, so we don't search for it more than once in a row.
var nav_command_search_last_query = '';

// Removes whitespace from beginning and end of string.
String.prototype.trim = function() {
	return this.replace(/^\s*/, "").replace(/\s*$/, "");
}

$(function() {
	// Command search input gets placeholder text.
	$("#nav_command_search_query").placeholder();
	
	// Grab command search results placeholder HTML.
	nav_command_search_results_placeholder = $("#nav_command_search_results").html();
	
	// Command search autocomplete show/hide.
	$("#nav_command_search_query").focus(function() {
		$("#nav_command_search_results").fadeIn("fast");
	}).blur(function() {
		$("#nav_command_search_results").fadeOut("fast");
	});
	
	// Command search form submit.
	$("#nav_command_search_form").ajaxify();
	
	// Command search keyboard controls.
	$("#nav_command_search_query").keydown(function(e) {
		console.log(e.keyCode);
		if (e.keyCode == 13) { // Return or enter key.
			// Submit non-ajax search.
			if ($("#nav_command_search_results li.focus").size() > 0) {
				window.location.href = $("#nav_command_search_results li.focus:first > a").attr("href");
			} else {
				window.location.href = $("#nav_command_search_form").attr("action") +
					"/" + $("#nav_command_search_query").val();
			}
		} else if (e.keyCode == 27) { // Escape key.
			// Kill focus on command search.
			$("#nav_command_search_query").val('').blur();
		} else if (e.keyCode == 38 || e.keyCode == 40) { // Up and down arrow keys.
			// Manipulate search results selection.
			currentFocus = $("#nav_command_search_results li.focus:first");
			nextFocus = null;

			// Figure out which result should be selected next.
			if (e.keyCode == 38) { // Up arrow.
				if (currentFocus.length > 0) {
					nextFocus = currentFocus.prev().length > 0 ? currentFocus.prev() : currentFocus;
				} else {
					nextFocus = $("#nav_command_search_results li:last");
				}
			} else if (e.keyCode == 40) { // Down arrow.
				if (currentFocus.length > 0) {
					nextFocus = currentFocus.next().length > 0 ? currentFocus.next() : currentFocus;
				} else {
					nextFocus = $("#nav_command_search_results li:first");
				}
			}

			// Apply focus class to new selection and fill in search input with its value.
			$("#nav_command_search_results li").removeClass("focus");
			$(nextFocus).addClass("focus");
			$("#nav_command_search_query").val($("span.name", nextFocus).text());
		} else {
			return true;
		}
		
		return false;
	});
	
	// Command search on keyup.
	$("#nav_command_search_query").keyup(function(e) {
		if (e.keyCode == 38 || e.keyCode == 40) { return; }
		
		query = $(this).val();
		
		if (query.trim().length > 0 && !query.match(/^\s+$/)) {
			if (query != nav_command_search_last_query) {
				nav_command_search_last_query = query;
				$("#nav_command_search_form").submit();
			}
		} else {
			$("#nav_command_search_results").html(nav_command_search_results_placeholder);
		}
	});
});