<script type="text/javascript" charset="utf-8">
	String.prototype.trim = function() {
		return this.replace(/^\s*/, "").replace(/\s*$/, "");
	}
	
	var currentQuery = "";
	
	$(function() {
		// Up/down key handler for autocomplete
		$("#search_query").keydown(function(e) {
			if (e.keyCode == 38 || e.keyCode == 40) {
				var curSel = $("#autocomplete li.sel:first");
				var nextSel = null;
				
				if (e.keyCode == 38) { // up
					if (curSel.length > 0) {
						nextSel = (curSel.prev().length > 0 ? curSel.prev() : curSel);
					} else {
						nextSel = $("#autocomplete li:last");
					}
				} else if (e.keyCode == 40) { // down
					if (curSel.length > 0) {
						nextSel = (curSel.next().length > 0 ? curSel.next() : curSel);
					} else {
						nextSel = $("#autocomplete li:first");
					}
				}
				
				$("#autocomplete li").removeClass("sel");
				$(nextSel).addClass("sel");
				$("#search_query").val($("#autocomplete li.sel:first").text());
			}
		});
		
		// Autocomplete handler
		$("#search_query").keyup(function(e) {
			if (e.keyCode == 38 || e.keyCode == 40) { return; }
			
			var query = $("#search_query").val();
			if (query.trim().length > 0) {
				if (query != currentQuery) {
					currentQuery = query;
					$.post(
						"<?php echo site_url('infobot/search'); ?>",
						{"query": query},
						function(data, status) {
							if (data.length > 0) {
								var html = "<ul>";
								$.each(data, function(i, val) {
									html += '<li id="autocomplete_' + i + '">' + val + "</li>";
								});
								html += "</ul>";
								$("#autocomplete").html(html).show();
							} else {
								$("#autocomplete").hide();
							}
						}, "json");
				}
			} else {
				$("#autocomplete").hide();
			}
		});
		
		$("#search_query").focus();
	});
</script>

<p>Type a factoid name below in order to modify or create it.</p>

<?php 
$this->load->helper('form');

echo form_open('factoids/search', array('id' => 'search_form'));
echo form_input(array('name' => 'query', 'id' => 'search_query', 'autocomplete' => 'off'));
echo form_submit(array('name' => 'submit', 'id' => 'search_submit', 'value' => 'Search'));
echo form_close();
?>

<div id="autocomplete"></div>
