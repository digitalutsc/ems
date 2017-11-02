/*
Gets TEI for a song collection.
 */

jQuery(document).ready(function(){
	var object_pid = get_object_pid();

	var obj_data = {
		tei_pid: object_pid
	};

	jQuery.ajax({
		url: location.protocol + '//' + location.host + '/ems/get_tei',
		dataType: 'json',
		type: 'GET',
		data: obj_data,
		error: function() {
			alert("Error in getting TEI XML.")
		},
		success: function(data) {
			alert("xml Content via AJAX " + data)
			var xmlDoc = jQuery.parseXML(data);
			var title = xmlDoc.getElementsByTagName("title")[0].textContent;
			var titleInfo = "Title from TEI " + title;

			jQuery('<div><h2>EMS Custom Visuals</h2>' + titleInfo + '</div>').appendTo(jQuery("#block-system-main"));

		}
	});
});


function get_object_pid() {
	var objectURL = window.location.href;
	var objectPID = objectURL.substr(objectURL.lastIndexOf('/') + 1);
	objectPID = objectPID.replace("%3A", ":").trim();
	return objectPID;
}