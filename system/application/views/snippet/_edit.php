<script src="/javascripts/snippet/edit.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript" charset="utf-8">
	$.bbq.pushState("#edit");
</script>

<div id="left_column">
	<h2>Editing "<?=$snippet->name;?>"</h2>
	
	<form id="edit_form" method="post" action="/snippet/save">
		<?php $this->load->view('snippet/_edit_form'); ?>
	</form>
</div>

<div id="right_column">
	<h2 style="margin-bottom: 20px;">Toolbox</h2>
	
	<a id="save_button" class="button save" href="#edit">Save</a>
	<a id="revert_button" class="button revert" href="/snippet/edit/<?=$snippet->id;?>" target="#snippet">Revert</a>
	<a id="delete_button" class="button delete" href="/snippet/delete/<?=$snippet->id;?>" target="#snippet">Delete</a>
	<a id="view_button" class="button done" href="/snippet/<?=$snippet->id;?>">Done</a>
	
	<h3 style="margin-top: 20px;">Created</h3>
	<p>By <b><?=$created_by->username;?></b> on <?=date('F j, Y \a\t g:i a', strtotime($snippet->created_at));?>.</p>
	
	<h3>Updated</h3>
	<p id="updated_at">By <b><?=$updated_by->username;?></b> on <?=date('F j, Y \a\t g:i a', strtotime($snippet->updated_at));?>.</p>
	
	<h2>Tips <a class="button toggle" href="#" target="#tips">Show</a></h2>
	
	<div id="tips" class="contains_code">
		<p>Snippets are like factoids, except written in <a href="http://www.ruby-lang.org/">Ruby</a>.</p>
		
		<h3>Return values</h3>
		<p><span class="class">String</span>s are sent as-is. Each element of an <span class="class">Array</span> is converted to a <span class="class">String</span> and sent. Anything else except for <span class="keyword">nil</span> and <span class="keyword">false</span> is converted to a <span class="class">String</span> and sent.</p>
		
		<h3>Sender and reply_to</h3>
		<p>The snippet has access to the variable <span class="variable">sender</span>, which is a <span class="class">Hash</span> containing <span class="symbol">:nick</span>, <span class="symbol">:user</span> and <span class="symbol">:host</span> keys, which describes the user who sent the command.</p>
		<p>The variable <span class="variable">reply_to</span> is a <span class="class">String</span> containing the channel (or nick, for a private message) the command came from.</p>
		
		<h3>Convenience methods</h3>
		<p>If you need to manually send messages, or need to send an action, you may use the following methods:</p>
		<pre><code># Send a plain message
msg 'Hello world!'

# Send a message addressed to sender
reply 'Success! Enemy vaporized!'

# Send an action
action 'pelvic thrusts'</code></pre>
		<p>Each of these methods accepts an optional second argument which specifies the channel or nick to send to. It defaults to the value of <span class="variable">reply_to</span>.
		
		<h3>Autumn classes</h3>
		<p>The snippet has access to <span class="class">Stem</span> and <span class="class">Leaf</span> objects, representing the IRC connection and snippet plugin (called "Rum"), respectively; as well as the rest of the <a href="http://github.com/raws/autumn">Autumn</a> API.</p>
		<p>More information on these classes may be found in the Autumn <a href="http://github.com/raws/autumn/blob/master/README.textile">readme</a> and <a href="/autumn/api/">API documentation</a>.</p>
		
		<h3>Even more!</h3>
		<p>There are more yet-undocumented goodies which will be written about soon! Expect drool-worthy topics such as user access control and persistent data storage!</p>
	</div>
</div>