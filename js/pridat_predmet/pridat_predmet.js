$(document).ready(function() {

	// $('.selectpicker').selectpicker();

	$('#select_term').change(function(){
		//console.log($('#select_term').val());
		show_select_detail($('#select_term').val())
	})

	$('#select_subject').change(function(){
		//console.log($('#select_term').val());
		// $('.selectpicker').selectpicker();
		$('#treti_select_admin').fadeIn(1000);
		$('#add_predmet_wrap').fadeIn(1000);
		$('#prednaska_admin').fadeIn(1000);
		$('#select_exc_count').val(0);
		
		if($('#select_subject').val() =='skovaj'){
			console.log('aa');
			$('#prednaska_admin').fadeOut(1000);
			$('#cvicenie_admin').fadeOut(1000);
			$('#treti_select_admin').fadeOut(1000)
			$('#add_predmet_wrap').fadeOut(1000);

		}
	})

	$('#select_exc_count').change(function(){
		// $('.selectpicker').selectpicker();
		if($('#select_exc_count').val() == 0){
			//$('#prednaska_admin').fadeOut(1000);
			$('#cvicenie_admin').fadeOut(1000);
		}else{
			$('#prednaska_admin').fadeIn(1000);
			$('#cvicenie_admin').fadeIn(1000);
			$('#add_predmet_wrap').fadeIn(1000);
		}
	})

	
	function show_select_detail(select_term){
		var zimny = ['z 1','z 2'];
		var letny = ['l 1','l 2'];
		
		var pole;
		
		switch(select_term){
			case 'zimny':
					pole=zimny;
					napln_select($('#select_subject'), pole);
					$('#druhy_select_admin').fadeIn(1000);
				break;
			case 'letny':
					pole=letny;
					napln_select($('#select_subject'), pole);
					$('#druhy_select_admin').fadeIn(1000);
				break;
			
			case 'skovaj':
					$('#druhy_select_admin').fadeOut(1000);
					$('#treti_select_admin').fadeOut(1000);
					$('#prednaska_admin').fadeOut(1000);
					$('#cvicenie_admin').fadeOut(1000);
					$('#add_predmet_wrap').fadeOut(1000);

				break;
		}

		
	}

	function napln_select(select,pole){
		select.html('<option value="skovaj">vyber Predmet</option>');
		for (var i = 0; i < pole.length; i++) {
			select.append('<option value='+pole[i]+'>'+pole[i]+'</option>');
		};
	}


	


	



});