// Placeholder HTML for when search results div is empty.
var nav_command_search_results_placeholder = null;

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
	
	// Command search on keyup.
	$("#nav_command_search_query").keyup(function() {
		if ($(this).val().trim().length > 0) {
			$("#nav_command_search_form").submit();
		} else {
			$("#nav_command_search_results").html(nav_command_search_results_placeholder);
		}
	});
});