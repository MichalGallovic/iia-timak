$(document).ready(function() {


	$('#select_type').change(function(){
		//console.log($('#select_type').val());
		show_select_detail($('#select_type').val())
	})

	function show_select_detail(selected_type){
		var oddelenie = ['oddelenie 1','oddelenie 2'];
		var predmet = ['predmet 1','predmet 2'];
		var ucitel = ['ucitel 1','ucitel 2'];
		var skupina_ucitelov = ['skupina_ucitelov 1','skupina_ucitelov 2'];
		var miestnost = ['miestnost 1','miestnost 2'];
		var den = ['den 1','den 2'];
		var pole;
		switch(selected_type){
			case 'oddelenie':
					pole=oddelenie;
					napln_select($('#select_detail'), pole);
					$('#druhy_select').fadeIn(1000);
				break;
			case 'predmet':
					pole=predmet;
					napln_select($('#select_detail'), pole);
					$('#druhy_select').fadeIn(1000);
				break;
			case 'ucitel':
					pole=ucitel;
					napln_select($('#select_detail'), pole);
					$('#druhy_select').fadeIn(1000);
				break;
			case 'skupina_ucitelov':
					pole=skupina_ucitelov;
					napln_select($('#select_detail'), pole);
					$('#druhy_select').fadeIn(1000);
				break;
			case 'miestnost':
					pole=miestnost;
					napln_select($('#select_detail'), pole);
					$('#druhy_select').fadeIn(1000);
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
			select.append('<option value='+pole[i]+'>'+pole[i]+'</option>');
		};
	}


	




});