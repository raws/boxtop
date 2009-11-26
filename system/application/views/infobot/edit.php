<?php $this->load->view('application/header'); ?>

<h1>Factoids</h1>

<?php $this->load->view('infobot/_search_form'); ?>

<script src="/javascripts/jquery.elastic.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
	$(function() {
		$("#definitions .definition").mouseenter(function() {
			$("a.button.delete", this).fadeIn("fast");
		}).mouseleave(function() {
			$("a.button.delete", this).fadeOut("fast");
		});
		
		$("#definitions textarea").focus(function() {
			$(this).parent().addClass("focus");
		}).blur(function() {
			$(this).parent().removeClass("focus");
		});
		
		$(".definition a.button.delete").live("click", function() {
			$(this).parent().remove();
			return false;
		});
		
		$("#add_button").click(function() {
			if ($(this).hasClass("disabled")) { return false; }
			
			definitionCount = $("#definitions .definition").size();
			$("#definitions").append('<div class="definition"><a class="button delete" href="#">' +
				'<span class="label">Delete</span> <span class="delete">&#x2718;</span></a>' +
				'<textarea name="definitions[' + (definitionCount+1) + ']"></textarea></div>');
			$("#definitions textarea:last").focus(function() {
				$(this).parent().addClass("focus");
			}).blur(function() {
				$(this).parent().removeClass("focus");
			});
			$("#definitions .definition:last").mouseenter(function() {
				$("a.button.delete", this).fadeIn("fast");
			}).mouseleave(function() {
				$("a.button.delete", this).fadeOut("fast");
			});
			$("#definitions textarea:last").focus();
			
			return false;
		});
		
		$("#save_button").click(function() {
			if ($(this).hasClass("disabled")) { return false; }
			
			$("#edit_form").submit();
			return false;
		});
		
		$("#show_hide_tips_button").click(function() {
			if ($("#tips").css("display") == "none") {
				$("#tips").show();
				$(this).text("Hide");
			} else {
				$("#tips").hide();
				$(this).text("Show");
			}
			
			return false;
		});
		
		$("#edit_form").submit(function() {
			$("#add_button").addClass("disabled");
			$("#save_button").addClass("disabled");
			$("#definitions textarea").attr("disabled", "disabled");
			$("#saved_notice").text("Saving...").show();
			
			var data = { "id": $("input[name=id]").val() };
			$("#definitions textarea").each(function(i) {
				data["definitions["+i+"]"] = $(this).val();
			});
			
			$.post($(this).attr("action"), data, function(data, status) {
				$("#save_button span.label").text("Save");
				$("#definitions textarea").removeAttr("disabled");
				$("#save_button").removeClass("disabled");
				$("#add_button").removeClass("disabled");
				
				$("#saved_notice").text("Saved!");
				setTimeout('$("#saved_notice").fadeOut("slow");', 2000);
			}, "json");
			
			return false;
		});
		
		$("#definitions textarea").elastic();
		$("#definitions textarea:first").focus();
	});
</script>

<h2>Editing "<?php echo $factoid['name']; ?>"</h2>

<p style="margin-bottom: 25px;">
	<span id="definition_count"><?php echo sizeof($factoid['definitions']); ?> definition<?php if (sizeof($factoid['definitions']) != 1): ?>s<?php endif; ?></span>.
	<a id="add_button" class="button" href="#" title="Add a new definition"><span class="label">Add Definition</span> <span class="add">&#x271A;</span></a>
	<a id="revert_button" class="button" href="<?php echo site_url('factoids/edit/'.$factoid['id']); ?>" title="Revert unsaved changes"><span class="label">Revert</span> <span class="revert">&#x2B05;</span></a>
	<a id="save_button" class="button" href="#" title="Save changes"><span class="label">Save</span> <span class="save">&#x2714;</span></a>
	<span id="saved_notice"></span>
</p>

<?php
$this->load->helper('form');

echo form_open('factoids/update', array('id' => 'edit_form')) .
	form_hidden('id', $factoid['id']);
?>

<div id="definitions">
<?php $i = 1; foreach ($factoid['definitions'] as $definition): ?>
	<div class="definition">
		<a class="button delete" href="#"><span class="label">Delete</span> <span class="delete">&#x2718;</span></a>
		<textarea name="definitions[<?php echo $i; ?>]"><?php echo $definition->body; ?></textarea>
	</div>
<?php $i++; endforeach; ?>
</div>

<?php
echo form_close();
?>

<h2>Tips <a id="show_hide_tips_button" class="button" href="#">Show</a></h2>

<div id="tips" style="display: none;">
	<ul>
		<li>There is no limit to how long a definition may be. Each individual line sent via IRC is limited to a bit less than 512 characters, but you may send as many lines as you like.</li>
		<li>There is no need to type "\n" to insert new lines, as in IRC. Simply type on an actual new line!</li>
		<li>You may use a few special terms:
			<ul>
				<li><b>&lt;action&gt;</b> &mdash; Send the line as an action. Example:<br />
					<code>&lt;action&gt;poops in his hand.</code></li>
				<li><b>&lt;reply&gt;</b> &mdash; Send the line as a plain message, instead of including it as a "normal" definition. Example:<br />
					<code>&lt;reply&gt;I am a salty herring. Pickle me good!</code></li>
			</ul>
		</li>
	</ul>
</div>

<?php $this->load->view('application/footer'); ?>
