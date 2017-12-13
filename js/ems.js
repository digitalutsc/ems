/*
Gets TEI for a song collection.
 */

jQuery(document).ready(function(){
	// Immediately replace to avoid showing the XML
	var viewerDiv = jQuery(".islandora-simple-xml-content").first();
	viewerDiv.empty().append('<div><h2>EMS Custom Visuals</h2></div>');

	var object_pid = get_object_pid();

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

			viewerDiv.empty().append('<div><h2>EMS Custom Visuals</h2>' + titleInfo + '</div>');

		}
	});
});


function get_object_pid() {
	var objectURL = document.location.pathname;
	var objectPID = objectURL.substr(objectURL.lastIndexOf('/') + 1);
	objectPID = objectPID.replace("%3A", ":").trim();
	return objectPID;
}