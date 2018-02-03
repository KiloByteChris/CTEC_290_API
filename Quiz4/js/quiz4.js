$(document).ready(function(){
	var url = "http://ideajam.net/ideajam/p/ij.nsf/jsonGetWhatsHot";
	// GET data from the API
	$.ajax({
	    url: url,
	    method: 'GET',
	}).done(function(data) {
	    console.log(data);
	    // iterate through the data and create a string to display the JSON
	    $.each(data.result, function(key, value){
	    	// display tags
	    	var tagString = "";
	    	$.each (value.tags, function(key, value){
	    		tagString += '<p>'+value+'</p>';
	    	})
	    	var linkedideaidString = "";
	    	// display linkedideaid
	    	$.each (value.linkedideaid, function(key, value){
	    		linkedideaidString += '<p>'+value+'</p>';
	    	})
	    	var commentString = '<h3>Comments:</h3>';
	    	//display comments
	    	$.each(value.comments, function(key, value){
	    		commentString += '<p>'+value.comment+'</p>'+
	    		'<p>'+value.createdby+'</p>'+
	    		'<p>'+value.datecreated+'</p>';
	    	})
	    	var displayString = "";
	    	displayString += "<article>" +
	    	'<h2><a href='+value.ideaurl+'>'+value.idea+'</a></h2>' +
	    	'<h3>'+value.createdby+'</h3>'+
	    	'<h4>'+value.datecreated+'</h4>'+
	    	'<p>'+value.body+'</p>' +
	    	'<p>'+value.idea+'</p>' +
	    	'<p>'+value.ideaid+'</p>' +
	    	'<p>'+value.ideaspace+'</p>' +
	    	'<p>'+value.implementationManager+'</p>' +
	    	'<p>'+value.implementationPlan+'</p>' +
	    	'<p>'+value.status+'</p>' +
	    	'<p>'+value.additionallongtext+'</p>' +
	    	'<p>'+value.additionaltext+'</p>' +
	    	'<p>'+value.votes+'</p>'+
	    	tagString +
	    	linkedideaidString +
	    	commentString +
	    	'</article>';
	    	// display the displayString
	    	$('#articleSection').append(displayString);
	    }) 
	}).fail(function(err) {
	    throw err;
	 });
});