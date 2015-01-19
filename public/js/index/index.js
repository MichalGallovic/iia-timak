$(document).ready(function() {


	$('#tlaciaren').hide();
	$('#tabulka-wrapper').hide();
	
	$('#select_type').change(function(){
		$('#tlaciaren').hide();
		$('#tabulka-wrapper').hide();
		//console.log($('#select_type').val());
		show_select_detail($('#select_type').val())
	})

	$('#select_detail').change(function(){
		$('#tlaciaren').hide();
		$('#tabulka-wrapper').hide();
	})

	function show_select_detail(selected_type){
		var oddelenie = ['oddelenie 1','oddelenie 2'];
		// var predmet = ['predmet 1','predmet 2'];
		var ucitel = ['ucitel 1','ucitel 2'];
		var skupina_ucitelov = [{'id':1,'name':'skupina_ucitelov 1'},{'id':2,'name':'skupina_ucitelov 2'}];
		var miestnost = ['miestnost 1','miestnost 2'];
		var den = [{'id':0,'name':'pondelok'},{'id':1,'name':'utorok'},{'id':2,'name':'streda'},{'id':3,'name':'stvrtok'},{'id':4,'name':'piatok'}];
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
		$('#tlaciaren').show();
	$('#tabulka-wrapper').show();
		//alert($('#select_type').val()+' '+$('#select_detail').val());
		$('#tabulka-wrapper').html("<table class='table'> <colgroup> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> </colgroup> <thead> <tr> <th>Deň</th> <th>6:00</th> <th>7:00</th> <th>8:00</th> <th>9:00</th> <th>10:00</th> <th>11:00</th> <th>12:00</th> <th>13:00</th> <th>14:00</th> <th>15:00</th> <th>16:00</th> <th>17:00</th> <th>18:00</th> <th>19:00</th> </tr> </thead> <tbody> <tr> <td class='den' >Pondelok</td> <td id='p-6' class='np'></td> <td id='p-7' class='np'></td> <td id='p-8' class='np'></td> <td id='p-9' class='np'></td> <td id='p-10' class='np'></td> <td id='p-11' class='np'></td> <td id='p-12' class='np'></td> <td id='p-13' class='np'></td> <td id='p-14' class='np'></td> <td id='p-15' class='np'></td> <td id='p-16' class='np'></td> <td id='p-17' class='np'></td> <td id='p-18' class='np'></td> <td id='p-19' class='np'></td> </tr> <tr> <td class='den' >Utorok</td> <td class='np' id='u-6'></td> <td class='np' id='u-7'></td> <td class='np' id='u-8'></td> <td class='np' id='u-9'></td> <td class='np' id='u-10'></td> <td class='np' id='u-11'></td> <td class='np' id='u-12'></td> <td class='np' id='u-13'></td> <td class='np' id='u-14'></td> <td class='np' id='u-15'></td> <td class='np' id='u-16'></td> <td class='np' id='u-17'></td> <td class='np' id='u-18'></td> <td class='np' id='u-19'></td> </tr> <tr> <td class='den' >Streda</td> <td class='np' id='s-6'></td> <td class='np' id='s-7'></td> <td class='np' id='s-8'></td> <td class='np' id='s-9'></td> <td class='np' id='s-10'></td> <td class='np' id='s-11'></td> <td class='np' id='s-12'></td> <td class='np' id='s-13'></td> <td class='np' id='s-14'></td> <td class='np' id='s-15'></td> <td class='np' id='s-16'></td> <td class='np' id='s-17'></td> <td class='np' id='s-18'></td> <td class='np' id='s-19'></td> </tr> <tr> <td class='den' >Štvrtok</td> <td class='np' id='st-6'></td> <td class='np' id='st-7'></td> <td class='np' id='st-8'></td> <td class='np' id='st-9'></td> <td class='np' id='st-10'></td> <td class='np' id='st-11'></td> <td class='np' id='st-12'></td> <td class='np' id='st-13'></td> <td class='np' id='st-14'></td> <td class='np' id='st-15'></td> <td class='np' id='st-16'></td> <td class='np' id='st-17'></td> <td class='np' id='st-18'></td> <td class='np' id='st-19'></td> </tr> <tr> <td class='den' >Piatok</td> <td class='np' id='pi-6'></td> <td class='np' id='pi-7'></td> <td class='np' id='pi-8'></td> <td class='np' id='pi-9'></td> <td class='np' id='pi-10'></td> <td class='np' id='pi-11'></td> <td class='np' id='pi-12'></td> <td class='np' id='pi-13'></td> <td class='np' id='pi-14'></td> <td class='np' id='pi-15'></td> <td class='np' id='pi-16'></td> <td class='np' id='pi-17'></td> <td class='np' id='pi-18'></td> <td class='np' id='pi-19'></td> </tr> </tbody> </table>");
		var type= $('#select_type').val();
		switch(type){
			case 'skupina_ucitelov':
				//console.log(type);
				var inputs = [];
				inputs = $('.chi:checked');
				var data = 'type='+type+'&';
				// console.log(data);
				
				for(var i = 0;i<inputs.length;i++){
					data += 'id'+i+'='+inputs[i].value+'&';
				}
				if(data.length==22){alert('Vyber Ucitela');break;}
				data = data.substring(0, data.length - 1);
				console.log(data);

				$('#kone').val('/print?'+data);

                                
				// $('#tlaciaren').attr('href','/print?'+data);

				$.ajax({
							  type: "GET",
							  url: "/service/schedule",
							  data:data,
							  success: function(resp){
							  	console.log(resp);
							  	for(var g=0;g<resp.length;g++){
									resp[g].day=parseInt(resp[g].day);
								}
							  	zobraz(resp);
							  	$('#tlaciaren').val($('#tabulka-wrapper').html());

							  }  
							})
				break;
			default:
					var id = $('#select_detail').val();
					var data = 'type='+type+'&id='+id;
					console.log(data);
					$('#kone').val('/print?'+data);
					//$('#tlaciaren').attr('href','/print?'+data);

				$.ajax({
							  type: "GET",
							  url: "/service/schedule",
							  data:data,
							  success: function(resp){
							  	// // console.log(resp);
							  	// console.log('tu');
// 							  	var toto = [
// 							  	{"subjectAcronym": "IIA","day":0,"type":"exercise","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#B69BE0","userName":"Jakub","userSurName":"Forn\u00e1del","userTitle1":"Bc.","userTitle2":null,"startTime":"10:00:00","endTime":"12:00:00","roomName":"CD300","note":""},
// 							  {"subjectAcronym": "IIA","day":0,"type":"consultation","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#B69BE0","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"06:00:00","endTime":"09:00:00","roomName":"CD150","note":""},
// 							  	{"subjectAcronym": "IIA","day":0,"type":"lecture","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#B69BE0","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"06:00:00","endTime":"14:00:00","roomName":"CD150","note":""},
// 							  	 {"subjectAcronym": "IIA","day":0,"type":"lecture","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#B69BE0","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"16:00:00","endTime":"17:00:00","roomName":"CD150","note":""},
// 							  	// 
// 							  {"subjectAcronym": "IIA","day":1,"type":"exercise","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#2f2f2f","userName":"Jakub","userSurName":"Forn\u00e1del","userTitle1":"Bc.","userTitle2":null,"startTime":"10:00:00","endTime":"12:00:00","roomName":"CD300","note":""},
// 							  	{"subjectAcronym": "IIA","day":1,"type":"consultation","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#2f2f2f","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"06:00:00","endTime":"09:00:00","roomName":"CD150","note":""},
// 							  	{"subjectAcronym": "IIA","day":1,"type":"lecture","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#2f2f2f","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"06:00:00","endTime":"14:00:00","roomName":"CD150","note":""},
// 							  	{"subjectAcronym": "IIA","day":1,"type":"lecture","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#2f2f2f","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"16:00:00","endTime":"17:00:00","roomName":"CD150","note":""},
// 							  	// 
// 							  	{"subjectAcronym": "IIA","day":2,"type":"exercise","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#a3a3a3","userName":"Jakub","userSurName":"Forn\u00e1del","userTitle1":"Bc.","userTitle2":null,"startTime":"10:00:00","endTime":"12:00:00","roomName":"CD300","note":""},
// 							  	 {"subjectAcronym": "IIA","day":2,"type":"consultation","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#a3a3a3","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"06:00:00","endTime":"09:00:00","roomName":"CD150","note":""},
// 							   {"subjectAcronym": "IIA","day":2,"type":"lecture","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#a3a3a3","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"06:00:00","endTime":"14:00:00","roomName":"CD150","note":""},
// 							  	 {"subjectAcronym": "IIA","day":2,"type":"lecture","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#a3a3a3","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"16:00:00","endTime":"17:00:00","roomName":"CD150","note":""},
// // 
// 							  	{"subjectAcronym": "IIA","day":3,"type":"exercise","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#aaafff","userName":"Jakub","userSurName":"Forn\u00e1del","userTitle1":"Bc.","userTitle2":null,"startTime":"10:00:00","endTime":"11:00:00","roomName":"CD300","note":""},
// 							  	 {"subjectAcronym": "IIA","day":3,"type":"consultation","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#aaafff","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"06:00:00","endTime":"09:00:00","roomName":"CD150","note":""},
// 							  	 {"subjectAcronym": "IIA","day":3,"type":"lecture","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#aaafff","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"06:00:00","endTime":"7:00:00","roomName":"CD150","note":""},
// 							  	 {"subjectAcronym": "IIA","day":3,"type":"lecture","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#aaafff","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"13:00:00","endTime":"15:00:00","roomName":"CD150","note":""},
// 							  	// 
// 							  	{"subjectAcronym": "IIA","day":4,"type":"exercise","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#e5e5e5","userName":"Jakub","userSurName":"Forn\u00e1del","userTitle1":"Bc.","userTitle2":null,"startTime":"10:00:00","endTime":"12:00:00","roomName":"CD300","note":""},
// 							  	 {"subjectAcronym": "IIA","day":4,"type":"consultation","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#e5e5e5","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"06:00:00","endTime":"09:00:00","roomName":"CD150","note":""},
// 							  	 {"subjectAcronym": "IIA","day":4,"type":"lecture","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#e5e5e5","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"07:00:00","endTime":"8:00:00","roomName":"CD150","note":""},
// 							  	 {"subjectAcronym": "IIA","day":4,"type":"lecture","subjectName":"Internetov\u00e9 a intranetov\u00e9 aplik\u00e1cie","color":"#e5e5e5","userName":"Katar\u00edna","userSurName":"\u017d\u00e1kov\u00e1","userTitle1":"Doc. Ing.","userTitle2":"PhD.","startTime":"15:00:00","endTime":"19:00:00","roomName":"CD150","note":""}
// 							  	]
								for(var g=0;g<resp.length;g++){
									resp[g].day=parseInt(resp[g].day);
								}
							  	zobraz(resp);
							  }  
							})

				break;
		}
		
	})

function zobraz (napln) {
	for(var i = 0;i<napln.length;i++){

		switch(napln[i].day){
			case 0:
				olee(napln[i],'p');
				break;
			case 1:
				olee(napln[i],'u');
				break;
			case 2:
				olee(napln[i],'s');
				break;
			case 3:
				olee(napln[i],'st');
				break;
			case 4:
				olee(napln[i],'pi');
				break;
			default:
				console.log('zly den');
				break;
		}


	}
}
//http://www.sitepoint.com/javascript-generate-lighter-darker-color/
function ColorLuminance(hex, lum) {

	// validate hex string
	hex = String(hex).replace(/[^0-9a-f]/gi, '');
	if (hex.length < 6) {
		hex = hex[0]+hex[0]+hex[1]+hex[1]+hex[2]+hex[2];
	}
	lum = lum || 0;

	// convert to decimal and change luminosity
	var rgb = "#", c, i;
	for (i = 0; i < 3; i++) {
		c = parseInt(hex.substr(i*2,2), 16);
		c = Math.round(Math.min(Math.max(0, c + (c * lum)), 255)).toString(16);
		rgb += ("00"+c).substr(c.length);
	}

	return rgb;
}


    // $('#select_type').change(function() {
    //     //console.log($('#select_type').val());
    //     show_select_detail($('#select_type').val())
    // })

    // function show_select_detail(selected_type) {
    //     var oddelenie = ['oddelenie 1', 'oddelenie 2'];
    //     // var predmet = ['predmet 1','predmet 2'];
    //     var ucitel = ['ucitel 1', 'ucitel 2'];
    //     var skupina_ucitelov = [{'id': 1, 'name': 'skupina_ucitelov 1'}, {'id': 2, 'name': 'skupina_ucitelov 2'}];
    //     var miestnost = ['miestnost 1', 'miestnost 2'];
    //     var den = [{'id': 'pondelok', 'name': 'pondelok'}, {'id': 'utorok', 'name': 'utorok'}, {'id': 'streda', 'name': 'streda'}, {'id': 'stvrtok', 'name': 'stvrtok'}, {'id': 'piatok', 'name': 'piatok'}];
    //     var pole;
    //     switch (selected_type) {
    //         case 'oddelenie':
    //             $('#druhy_select_ucitelia').hide();

    //             $.ajax({
    //                 type: "GET",
    //                 url: "/service/groups",
    //                 success: function(resp) {
    //                     napln_select($('#select_detail'), resp);
    //                     $('#druhy_select').fadeIn(1000);
    //                     $('#bc').fadeIn(1000);
    //                     //console.log(resp);
    //                     // var pole = resp;
    //                     // prednasajuci=resp;
    //                     // var select = $('#select_prednasajuciP_admin');
    //                     // //select.html('<option value="-1">-</option>');
    //                     // for (var i = 0; i < pole.length; i++) {
    //                     // 	select.append('<option value='+pole[i].id+'>'+pole[i].firstname+' '+pole[i].surname+'</option>');
    //                     // };
    //                 }
    //             })
    //             // pole=oddelenie;
    //             // napln_select($('#select_detail'), pole);
    //             // $('#druhy_select').fadeIn(1000);
    //             break;
    //         case 'predmet':
    //             $('#druhy_select_ucitelia').hide();

    //             $.ajax({
    //                 type: "GET",
    //                 url: "/service/subjects",
    //                 success: function(resp) {
    //                     napln_select($('#select_detail'), resp);
    //                     $('#druhy_select').fadeIn(1000);
    //                     $('#bc').fadeIn(1000);

    //                     //console.log(resp);
    //                     // var pole = resp;
    //                     // prednasajuci=resp;
    //                     // var select = $('#select_prednasajuciP_admin');
    //                     // //select.html('<option value="-1">-</option>');
    //                     // for (var i = 0; i < pole.length; i++) {
    //                     // 	select.append('<option value='+pole[i].id+'>'+pole[i].firstname+' '+pole[i].surname+'</option>');
    //                     // };
    //                 }
    //             })
    //             //pole=predmet;
    //             // napln_select($('#select_detail'), pole);
    //             // $('#druhy_select').fadeIn(1000);
    //             break;
    //         case 'ucitel':
    //             $('#druhy_select_ucitelia').hide();

    //             $.ajax({
    //                 type: "GET",
    //                 url: "/service/users",
    //                 success: function(resp) {
    //                     napln_select_ucitelov($('#select_detail'), resp);
    //                     $('#druhy_select').fadeIn(1000);
    //                     $('#bc').fadeIn(1000);

    //                     //console.log(resp);
    //                     // var pole = resp;
    //                     // prednasajuci=resp;
    //                     // var select = $('#select_prednasajuciP_admin');
    //                     // //select.html('<option value="-1">-</option>');
    //                     // for (var i = 0; i < pole.length; i++) {
    //                     // 	select.append('<option value='+pole[i].id+'>'+pole[i].firstname+' '+pole[i].surname+'</option>');
    //                     // };
    //                 }
    //             })
    //             // pole=ucitel;
    //             // napln_select($('#select_detail'), pole);
    //             // $('#druhy_select').fadeIn(1000);
    //             break;
    //         case 'skupina_ucitelov':
    //             $('#druhy_select_ucitelia').html('<h3>Druhy Select: kone</h3>')
    //             $('#druhy_select').hide();
    //             $.ajax({
    //                 type: "GET",
    //                 url: "/service/users",
    //                 success: function(resp) {
    //                     //console.log(resp);
    //                     for (var i = 0; i < resp.length; i++) {
    //                         $('#druhy_select_ucitelia').append("<input class='chi' type='checkbox'  value=" + resp[i].id + "> " + resp[i].title1 + ' ' + resp[i].firstname + ' ' + resp[i].surname + ' ' + resp[i].title2 + "<br>");

    //                     }
    //                     //napln_select_ucitelov($('#select_detail'), resp);
    //                     $('#druhy_select_ucitelia').fadeIn(1000);
    //                     $('#bc').fadeIn(1000);


    //                     //console.log(resp);
    //                     // var pole = resp;
    //                     // prednasajuci=resp;
    //                     // var select = $('#select_prednasajuciP_admin');
    //                     // //select.html('<option value="-1">-</option>');
    //                     // for (var i = 0; i < pole.length; i++) {
    //                     // 	select.append('<option value='+pole[i].id+'>'+pole[i].firstname+' '+pole[i].surname+'</option>');
    //                     // };
    //                 }
    //             })
    //             //pole=skupina_ucitelov;
    //             //napln_select($('#select_detail'), pole);
    //             //$('#druhy_select').fadeIn(1000);
    //             break;
    //         case 'miestnost':
    //             $('#druhy_select_ucitelia').hide();

    //             $.ajax({
    //                 type: "GET",
    //                 url: "/service/rooms",
    //                 success: function(resp) {
    //                     napln_select($('#select_detail'), resp);
    //                     $('#druhy_select').fadeIn(1000);
    //                     $('#bc').fadeIn(1000);

    //                     //console.log(resp);
    //                     // var pole = resp;
    //                     // prednasajuci=resp;
    //                     // var select = $('#select_prednasajuciP_admin');
    //                     // //select.html('<option value="-1">-</option>');
    //                     // for (var i = 0; i < pole.length; i++) {
    //                     // 	select.append('<option value='+pole[i].id+'>'+pole[i].firstname+' '+pole[i].surname+'</option>');
    //                     // };
    //                 }
    //             })
    //             // pole=miestnost;
    //             // napln_select($('#select_detail'), pole);
    //             // $('#druhy_select').fadeIn(1000);
    //             break;
    //         case 'den':
    //             $('#druhy_select_ucitelia').hide();

    //             pole = den;
    //             napln_select($('#select_detail'), pole);
    //             $('#druhy_select').fadeIn(1000);
    //             $('#bc').fadeIn(1000);

    //             break;
    //         case 'skovaj':
    //             $('#druhy_select_ucitelia').hide();
    //             console.log(selected_type);
    //             $('#druhy_select').fadeOut(1000);
    //             $('#bc').fadeOut(1000);

    //             break;
    //     }


    // }

    // function napln_select(select, pole) {
    //     select.html('');
    //     for (var i = 0; i < pole.length; i++) {
    //         select.append('<option value=' + pole[i].id + '>' + pole[i].name + '</option>');
    //     }
    //     ;
    // }
    // function napln_select_ucitelov(select, pole) {
    //     select.html('');
    //     for (var i = 0; i < pole.length; i++) {
    //         select.append('<option value=' + pole[i].id + '>' + pole[i].title1 + ' ' + pole[i].firstname + ' ' + pole[i].surname + ' ' + pole[i].title2 + '</option>');
    //     }
    //     ;
    // }


    // $('#getSch').click(function() {
    //     //alert($('#select_type').val()+' '+$('#select_detail').val());
    //     var type = $('#select_type').val();
    //     switch (type) {
    //         case 'skupina_ucitelov':
    //             //console.log(type);
    //             var inputs = [];
    //             inputs = $('.chi:checked');
    //             var data = 'type=' + type + '?';
    //             // console.log(data);

    //             for (var i = 0; i < inputs.length; i++) {
    //                 data += 'id' + i + '=' + inputs[i].value + '&';
    //             }
    //             if (data.length == 22) {
    //                 alert('Vyber Ucitela');
    //                 break;
    //             }
    //             data = data.substring(0, data.length - 1);
    //             console.log(data);
    //             $.ajax({
    //                 type: "GET",
    //                 url: "/service/schedule",
    //                 data: data,
    //                 success: function(resp) {
    //                     console.log(resp);
    //                 }
    //             })
    //             break;
    //         default:
    //             var id = $('#select_detail').val();
    //             var data='type=' + type + '&id=' + id;
    //             console.log(data);
    //             $.ajax({
    //                 type: "GET",
    //                 url: "/service/schedule",
    //                 data: data,
    //                 success: function(resp) {
    //                     console.log(resp);
    //                 }
    //             })

    //             break;
    //     }

    // })


function olee(vec,s){
	var color = vec.color;
				switch(vec.type){
					case "exercise":
							color=color;
						break;
					case "consultation":
							// console.log(ColorLuminance(color, 0.2));
							color=ColorLuminance(color, 0.4);
						break;
					case "lecture":
							color=ColorLuminance(color, -0.4);
						break;

				}
				var st = vec.startTime.substring(0,2)
				var stI = parseInt(st);
				var et = vec.endTime.substring(0,2)
				var etI = parseInt(et);
				var rozdiel = etI - stI;
				//$('#p-'+st).attr('colspan',rozdiel);
				// for(var j = 0;j<rozdiel;j++){
				// 	var x = stI+j;
				// 	if(j==0)
				// 		$('#p-'+x).append('<div style="background:'+color+';height:100px;padding:5px;"><p>'+napln[i].subjectAcronym+'</p><p>'+napln[i].roomName+'</p></div>');
				// 	// else if(j==1)
				// 		// $('#p-'+x).prepend('<div style="background:'+napln[i].color+';height:100px;">'+napln[i].roomName+'</div>');
				// 	else
				// 		$('#p-'+x).append('<div style="background:'+color+';height:100px;">'+'&nbsp;'+'</div>');
				// }
				for(var k = 6;k<20;k++){
					// console.log(k);
					 // console.log($('#p-'+k).html());
					if(k >= stI && k<etI){
						if(k==stI)
							$('#'+s+'-'+k).append('<div style="background:'+color+';height:55px;padding:5px;"><p>'+vec.subjectAcronym+'</p><p>'+vec.roomName+'</p></div>');
						else
							$('#'+s+'-'+k).append('<div style="background:'+color+';height:55px;padding:5px;"><p>&nbsp;</div>');

					}else{
					// if($('#p-'+k).html()=='')
						 $('#'+s+'-'+k).append('<div style="background:white;height:55px;">'+'&nbsp;'+'</div>');
					}
				}
}

});