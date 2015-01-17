$(document).ready(function() {


	$('#select_type').change(function(){
		//console.log($('#select_type').val());
		show_select_detail($('#select_type').val())
	})

	function show_select_detail(selected_type){
		var oddelenie = ['oddelenie 1','oddelenie 2'];
		// var predmet = ['predmet 1','predmet 2'];
		var ucitel = ['ucitel 1','ucitel 2'];
		var skupina_ucitelov = [{'id':1,'name':'skupina_ucitelov 1'},{'id':2,'name':'skupina_ucitelov 2'}];
		var miestnost = ['miestnost 1','miestnost 2'];
		var den = [{'id':'pondelok','name':'pondelok'},{'id':'utorok','name':'utorok'},{'id':'streda','name':'streda'},{'id':'stvrtok','name':'stvrtok'},{'id':'piatok','name':'piatok'}];
		var pole;
		switch(selected_type){
			case 'oddelenie':
					pole=oddelenie;
					napln_select($('#select_detail'), pole);
					$('#druhy_select').fadeIn(1000);
				break;
			case 'predmet':
					$.ajax({
					  type: "GET",
					  url: "/service/subjects",
					  success: function(resp){
					  	napln_select($('#select_detail'), resp);
					  	$('#druhy_select').fadeIn(1000);
					  	//console.log(resp);
					  	// var pole = resp;
					  	// prednasajuci=resp;
					  	// var select = $('#select_prednasajuciP_admin');
					  	// //select.html('<option value="-1">-</option>');
					  	// for (var i = 0; i < pole.length; i++) {
					  	// 	select.append('<option value='+pole[i].id+'>'+pole[i].firstname+' '+pole[i].surname+'</option>');
					  	// };
					  }  
					})
					//pole=predmet;
					// napln_select($('#select_detail'), pole);
					// $('#druhy_select').fadeIn(1000);
				break;
			case 'ucitel':
					$.ajax({
					  type: "GET",
					  url: "/service/users",
					  success: function(resp){
					  	napln_select_ucitelov($('#select_detail'), resp);
					  	$('#druhy_select').fadeIn(1000);
					  	//console.log(resp);
					  	// var pole = resp;
					  	// prednasajuci=resp;
					  	// var select = $('#select_prednasajuciP_admin');
					  	// //select.html('<option value="-1">-</option>');
					  	// for (var i = 0; i < pole.length; i++) {
					  	// 	select.append('<option value='+pole[i].id+'>'+pole[i].firstname+' '+pole[i].surname+'</option>');
					  	// };
					  }  
					})
					// pole=ucitel;
					// napln_select($('#select_detail'), pole);
					// $('#druhy_select').fadeIn(1000);
				break;
			case 'skupina_ucitelov':
					pole=skupina_ucitelov;
					napln_select($('#select_detail'), pole);
					$('#druhy_select').fadeIn(1000);
				break;
			case 'miestnost':
					$.ajax({
					  type: "GET",
					  url: "/service/rooms",
					  success: function(resp){
					  	napln_select($('#select_detail'), resp);
					  	$('#druhy_select').fadeIn(1000);
					  	//console.log(resp);
					  	// var pole = resp;
					  	// prednasajuci=resp;
					  	// var select = $('#select_prednasajuciP_admin');
					  	// //select.html('<option value="-1">-</option>');
					  	// for (var i = 0; i < pole.length; i++) {
					  	// 	select.append('<option value='+pole[i].id+'>'+pole[i].firstname+' '+pole[i].surname+'</option>');
					  	// };
					  }  
					})
					// pole=miestnost;
					// napln_select($('#select_detail'), pole);
					// $('#druhy_select').fadeIn(1000);
				break;
			case 'den':
					pole=den;
					napln_select($('#select_detail'), pole);
					$('#druhy_select').fadeIn(1000);
				break;
			case 'skovaj':
					console.log(selected_type);
					$('#druhy_select').fadeOut(1000);
				break;
		}

		
	}

	function napln_select(select,pole){
		select.html('');
		for (var i = 0; i < pole.length; i++) {
			select.append('<option value='+pole[i].id+'>'+pole[i].name+'</option>');
		};
	}
	function napln_select_ucitelov(select,pole){
		select.html('');
		for (var i = 0; i < pole.length; i++) {
			select.append('<option value='+pole[i].id+'>'+pole[i].firstname+' '+pole[i].surname+'</option>');
		};
	}


	




});