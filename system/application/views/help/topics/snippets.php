<p>Snippets are like factoids, except written in <a href="http://www.ruby-lang.org/">Ruby</a>. This means they can do more than just repeat predefined text!</p>

<h3>Return values</h3>
<p>Just like in any Ruby method, the return value of a snippet is considered to be the last evaluated statement.</p>
<p>If the return value is a <b>string</b>, it will be sent as an IRC message to the originating channel. If it is an <b>array</b>, each element of the array will be converted to a string and sent. Otherwise, the return value is converted to a string and sent.</p>