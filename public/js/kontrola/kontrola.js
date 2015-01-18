$(document).ready(function() {
	$.ajax({
	type: "GET",
	url: "/service/subjects",
	success: function(resp){
		
			for(var i = 0; i < resp.length; i++ ){

				$('#tabulka').append('<tr><td>'+resp[i].name+'</td><td id='+resp[i].id+'></td></tr>')
			}
			rob(resp);	
		  } 
	});

function rob(od){
	for(var i = 0;i<od.length;i++){
		$.ajax({
		type: "GET",
		url: "/service/subjectValid",
		data: 'id='+od[i].id,
		success: function(resp){
		  	var id = this.url.substring(25);
		  	if(resp.valid == "true")$('#'+id).html('Zaradený');
		  	else $('#'+id).html('Nezaradený');

		 } 
		});
	}
}



});