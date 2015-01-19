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
						$('#druhy_select_ucitelia').hide();

					$.ajax({
					  type: "GET",
					  url: "/service/groups",
					  success: function(resp){
					  	napln_select($('#select_detail'), resp);
					  	$('#druhy_select').fadeIn(1000);
					  	$('#bc').fadeIn(1000);
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
					// pole=oddelenie;
					// napln_select($('#select_detail'), pole);
					// $('#druhy_select').fadeIn(1000);
				break;
			case 'predmet':
						$('#druhy_select_ucitelia').hide();

					$.ajax({
					  type: "GET",
					  url: "/service/subjects",
					  success: function(resp){
					  	napln_select($('#select_detail'), resp);
					  	$('#druhy_select').fadeIn(1000);
					  	$('#bc').fadeIn(1000);

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
						$('#druhy_select_ucitelia').hide();

					$.ajax({
					  type: "GET",
					  url: "/service/users",
					  success: function(resp){
					  	napln_select_ucitelov($('#select_detail'), resp);
					  	$('#druhy_select').fadeIn(1000);
					  	$('#bc').fadeIn(1000);

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
			$('#druhy_select_ucitelia').html('<h3>Druhy Select: kone</h3>')
			$('#druhy_select').hide();
					$.ajax({
					  type: "GET",
					  url: "/service/users",
					  success: function(resp){
					  	//console.log(resp);
					  	for(var i = 0;i<resp.length;i++){
					  		$('#druhy_select_ucitelia').append("<input class='chi' type='checkbox'  value="+resp[i].id+"> "+resp[i].title1+' '+resp[i].firstname+' '+resp[i].surname+' '+resp[i].title2+"<br>");

					  	}
					  	//napln_select_ucitelov($('#select_detail'), resp);
					  	$('#druhy_select_ucitelia').fadeIn(1000);
					  	$('#bc').fadeIn(1000);


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
					//pole=skupina_ucitelov;
					//napln_select($('#select_detail'), pole);
					//$('#druhy_select').fadeIn(1000);
				break;
			case 'miestnost':
						$('#druhy_select_ucitelia').hide();

					$.ajax({
					  type: "GET",
					  url: "/service/rooms",
					  success: function(resp){
					  	napln_select($('#select_detail'), resp);
					  	$('#druhy_select').fadeIn(1000);
					  	$('#bc').fadeIn(1000);

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
						$('#druhy_select_ucitelia').hide();

					pole=den;
					napln_select($('#select_detail'), pole);
					$('#druhy_select').fadeIn(1000);
					$('#bc').fadeIn(1000);

				break;
			case 'skovaj':
			$('#druhy_select_ucitelia').hide();
					console.log(selected_type);
					$('#druhy_select').fadeOut(1000);
					$('#bc').fadeOut(1000);

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
			select.append('<option value='+pole[i].id+'>'+pole[i].title1+' '+pole[i].firstname+' '+pole[i].surname+' '+pole[i].title2+'</option>');
		};
	}


	$('#getSch').click(function(){
		//alert($('#select_type').val()+' '+$('#select_detail').val());
		var type= $('#select_type').val();
		switch(type){
			case 'skupina_ucitelov':
				//console.log(type);
				var inputs = [];
				inputs = $('.chi:checked');
				var data = 'type='+type+'?';
				// console.log(data);
				
				for(var i = 0;i<inputs.length;i++){
					data += 'id'+i+'='+inputs[i].value+'&';
				}
				if(data.length==22){alert('Vyber Ucitela');break;}
				data = data.substring(0, data.length - 1);
				$.ajax({
							  type: "GET",
							  url: "/service/schedule",
							  data:data,
							  success: function(resp){
							  	console.log(resp);
							  }  
							})
				break;
			default:
					var id = $('#select_detail').val();

				$.ajax({
							  type: "GET",
							  url: "/service/schedule",
							  data:'type='+type+'&id='+id,
							  success: function(resp){
							  	// // console.log(resp);
							  	// console.log('tu');
							  	var toto = [
							  	{"day":0,"type":"exercise","subjectName":"pice kone cepice kone cecky hovnpice kone cecky hovnpice kone cecky hovnpice kone cecky hovncky hovna","color":"#e5e5e5","userName":"Jakub","userSurName":"Forn\u00e1del","userTitle1":"Bc.","userTitle2":null,"startTime":"10:00:00","endTime":"12:00:00","roomName":"CD300","note":""},
							  	{"day":0,"type":"consultation","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#B69BE0","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"07:00:00","endTime":"09:00:00","roomName":"CD150","note":""},
							  	{"day":0,"type":"consultation","subjectName":"DO PICEEE","color":"#a4a4a4","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"06:00:00","endTime":"14:00:00","roomName":"CD150","note":""},
							  	// {"day":0,"type":"consultation","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#B69BE0","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"06:00:00","endTime":"11:00:00","roomName":"CD150","note":""}
							  	]

							  	zobraz(toto);
							  }  
							})

				break;
		}
		
	})

function zobraz (napln) {
	for(var i = 0;i<napln.length;i++){

		switch(napln[i].day){
			case 0:
				var st = napln[i].startTime.substring(0,2)
				var stI = parseInt(st);
				var et = napln[i].endTime.substring(0,2)
				var etI = parseInt(et);
				var rozdiel = etI - stI;
				//$('#p-'+st).attr('colspan',rozdiel);
				for(var j = 0;j<rozdiel;j++){
					var x = stI+j;
					console.log(x);
					if(j==0)
						$('#p-'+x).prepend('<div style="background:'+napln[i].color+';height:100px;">'+napln[i].subjectName+'</div>');
					else
						$('#p-'+x).prepend('<div style="background:'+napln[i].color+';height:100px;">'+'.'+'</div>');
				}
				//$('#p-'+st).append('<div style="width:200px;height:200px;background:green;"></div>');

				break;
			case 1:
				console.log('ut');
				break;
			case 2:
				console.log('str');
				break;
			case 3:
				break;
			case 4:
				console.log('pia');
				break;
			default:
				console.log('zly den');
				break;
		}


	}
}




});