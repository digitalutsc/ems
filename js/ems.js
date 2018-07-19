/*
Gets TEI for a song collection.
 */

jQuery(document).ready(function(){
	// Immediately replace to avoid showing the XML
	var viewerDiv = jQuery(".islandora-simple-xml-content").first();
	viewerDiv.empty().append('<div id="ems_viewer">EMS Custom Visuals</div>');

	var object_pid = Drupal.settings.islandora_ems.pid;

	var obj_data = {
		pid: object_pid
	};

	jQuery.ajax({
		url: location.protocol + '//' + location.host + '/ems/get_collation',
		dataType: 'json',
		type: 'GET',
		data: obj_data,
		error: function() {
			alert("Error in getting TEI XML.");
			viewerDiv.empty().append('<div><h2>EMS Custom Visuals</h2> Error in getting Collation XML </div>');
		},
		success: function(data) {
			var xmlDoc = jQuery.parseXML(data);
			var title = xmlDoc.getElementsByTagName("title")[0].textContent;
			var titleInfo = "Title from TEI " + title;

			viewerDiv.empty().append('<div id="ems_viewer">' + titleInfo + '</div>');

			jQuery.loadScript('http://localhost:8000/sites/all/modules/ems/js/bundle.js', function(){
				alert('bundle.js loaded');
			});
		}
	});
});




jQuery.loadScript = function (url, callback) {
	jQuery.ajax({
		url: url,
		dataType: 'script',
		success: callback,
		async: true
	});
}