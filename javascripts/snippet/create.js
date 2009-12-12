// Automatically resize the given input field to fit its value.
function elasticResize() {
	$(this).attr("size", Math.max($(this).val().length + 1, 1));
}

$(function() {
	// Automatically resize fields.
	$("#name_and_args input").keydown(elasticResize).keyup(elasticResize);
	$("#body textarea").elastic();
	
	$("#save_button").click(function() {
		$("#new_snippet_form").submit();
		
		return false;
	});
	
	$("#name_and_args input[name='name']").focus();
	$("#name_and_args input").keydown().keyup();
});