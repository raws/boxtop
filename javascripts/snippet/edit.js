// Automatically resize the given input field to fit its value.
function elasticResize() {
	$(this).attr("size", Math.max($(this).val().length + 1, 1));
}

$(function() {
	// Automatically resize fields.
	$("#name_and_args input").keydown(elasticResize).keyup(elasticResize);
	$("#body textarea").elastic();
	
	// Add functionality to "Save" button.
	$("#save_button").click(function() {
		$("#right_column a.button").addClass("disabled");
		
		var form = $("#edit_form");
		$.post(form.attr("action"), form.serialize(), function(data) {
			$("#snippet").html(data);
			$("#updated_at").effect("highlight", {}, "slow");
			$("#right_column a.button").removeClass("disabled");
		});
		
		return false;
	});
	
	// Add functionality to "Revert" button.
	$("#revert_button").click(function() {
		$("#right_column a.button").addClass("disabled");
	}).ajaxify();
	
	// Add functionality to "Delete" button.
	$("#delete_button").ajaxify({ "confirm": "Are you sure you want to " +
		"permanently delete this snippet? This action cannot be undone." });
	
	// Focus on first input.
	$("#name_and_args input:first").focus();
	$("#name_and_args input").keyup().keydown();
});