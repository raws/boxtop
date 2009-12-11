// The last definition which had focus.
var lastFocusedDefinition = null;

// Set up focus and blur event handlers for definition textareas.
function setupDefinitionTextareas() {
	$("#definitions .content textarea").focus(function() {
		$("ul.definitions > li").removeClass("focus");
		$(this).closest("li").addClass("focus");
		$(this).setCaretPos(-1);
		
		lastFocusedDefinition = $(this).closest("li");
	}).blur(function() {
		$(this).closest("li").removeClass("focus");
	}).elastic();
}

// Assign unique numeric IDs to all currently-existing definitions.
function setupDefinitionNames() {
	$("#definitions > li > .definition").each(function(i, e) {
		$(e).attr("name", "definitions[" + i + "]");
	});
}

// Update definition count in toolbox.
function updateDefinitionCount() {
	var count = $("#definitions > li:not(#proto_definition)").size();
	$("#definition_count").html(
		"<b>" + count + "</b> definition" +
		(count == 1 ? '' : 's') + ".")
		.effect("highlight", {}, "slow");
}

$(function() {
	// Make definitions sortable.
	$("#definitions").sortable({
		"handle": ".handle",
		"update": function(event, ui) {
			$(".content textarea", ui.item).focus();
		}
	});
	
	// Add functionality to individual definition delete buttons.
	$("#definitions .title a.delete").live("click", function() {
		var deleted = $(this).closest("li");
		var sibling = deleted.prev("li:not(#proto_definition)").length > 0 ?
			deleted.prev("li:not(#proto_definition)") : deleted.next();
		
		deleted.remove();
		setupDefinitionNames();
		updateDefinitionCount();
		$(".content textarea", sibling).focus();
		
		return false;
	});
	
	// Add functionality to "Save" button.
	$("#save_button").click(function() {
		$("#right_column a.button").addClass("disabled");
		
		var form = $("#edit_form");
		$.post(form.attr("action"), form.serialize(), function(data) {
			$("#factoid").html(data);
			$("#factoid").effect("highlight", {}, "slow");
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
		"permanently delete this factoid and all of its associated " +
		"definitions? This action cannot be undone." });
	
	// Add functionality to "Add Definition" button.
	$("#add_definition_button").click(function() {
		var definition = $("#proto_definition").clone().removeAttr("id");
		
		if ($("#definitions > li:not(#proto_definition)").size() > 0) {
			var sibling = lastFocusedDefinition || $("#definitions > li:last");
			sibling.after(definition);
		} else {
			$("#definitions").append(definition);
		}
		
		setupDefinitionTextareas();
		setupDefinitionNames();
		updateDefinitionCount();
		$(".content textarea", definition).elastic().focus();
		
		return false;
	});
	
	// Add functionality to "Clear All" button.
	$("#clear_definitions_button").click(function() {
		if (confirm("Are you sure you want to erase all of this factoid's definitions?")) {
			$("#definitions > li:not(#proto_definition)").remove();
			var definition = $("#proto_definition").clone().removeAttr("id");
			$("#definitions").append(definition);
			setupDefinitionTextareas();
			setupDefinitionNames();
			updateDefinitionCount();
			$(".content textarea", definition).elastic().focus();
		} else {
			$(".content textarea", lastFocusedDefinition).focus();
		}
		
		return false;
	});
	
	// Set up definitions.
	setupDefinitionTextareas();
	setupDefinitionNames();
	
	// Select first definition textarea by default.
	$("#definitions li:not(#proto_definition) .content textarea:first").focus();
});