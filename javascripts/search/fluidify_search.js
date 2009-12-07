/* Smart columns fluid resizing code courtesy of Sohtanaka:
 * http://www.sohtanaka.com/web-design/smart-columns-w-css-jquery/
 */

function fluidifySearchResults() {
	$("#search_results > ol").css("width", "100%");
	
	rowWidth = $("#search_results > ol").width();
	columns = Math.floor(rowWidth / 250);
	columnWidth = Math.floor(rowWidth / columns);
	
	$("#search_results > ol").css("width", rowWidth);
	$("#search_results > ol > li").css("width", columnWidth);
}

$(fluidifySearchResults);

$(window).resize(function() { fluidifySearchResults(); });