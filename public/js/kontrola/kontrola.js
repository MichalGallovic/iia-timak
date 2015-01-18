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
			console.log(resp);
		  	var id = this.url.substring(this.url.length-1,this.url.length);
		  	$('#'+id).html('kone '+id)
		 } 
		});
	}
}



});