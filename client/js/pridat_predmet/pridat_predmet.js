$(document).ready(function() {

	// $('.selectpicker').selectpicker();
	var lang = {
		header:'cvicsenie ',
		instructor:'cvicciaci',
		day:'dean',
		time:'cvas',
		place:'miestdnost',
		
	}
	var template = '<div id="<%= cvId %>" class="<%= prve %> cvTab" ><h2>'+lang.header+'<%= i %>/<%= max %> </h2><h3>'+lang.instructor+':</h3><select name="select_instructor_<%= cvId %>" id="select_cviciaciC_admin" class="form-control"><option value="defCvic">def cvic</option></select><h3>'+lang.day+':</h3><select name="select_exc_day_<%= cvId %>" id="select_denC_admin" class="form-control"><option value="defCvicden">def cvic den</option></select><h3>'+lang.time+':</h3><select name="select_exc_time_<%= cvId %>" id="select_casC_admin" class="form-control"><option value="defCvicTime">def cvic time</option></select><h3>'+lang.place+':</h3><select name="select_exc_place_<%= cvId %>" id="select_miestnostC_admin" class="form-control"><option value="defCvicPlace">def cvic place</option></select></div>';

	var pocitadloCvicenie=0;
	var maxTabCvic;

	$('#select_term').change(function(){
		//console.log($('#select_term').val());
		show_select_detail($('#select_term').val())
	});

	$('#select_subject').change(function(){
		//console.log($('#select_term').val());
		// $('.selectpicker').selectpicker();
		$('#treti_select_admin').fadeIn(1000);
		$('#add_predmet_wrap').fadeIn(1000);
		$('#prednaska_admin').fadeIn(1000);
		$('#select_exc_count').val(0);
		
		if($('#select_subject').val() =='skovaj'){
			$('#prednaska_admin').fadeOut(1000);
			$('#cvicenie_admin').fadeOut(1000);
			$('#treti_select_admin').fadeOut(1000)
			$('#add_predmet_wrap').fadeOut(1000);

		}
	});
	
	$('#doLava').click(function(e){
		e.preventDefault();
		if(pocitadloCvicenie == 0)return
		else{
			pocitadloCvicenie--;
			$('.cvTab').hide();
			$('#cv_'+pocitadloCvicenie).show();
		}
	});

	$('#doPrava').click(function(e){
		e.preventDefault();

		if(pocitadloCvicenie == maxTabCvic-1)return
		else{
			pocitadloCvicenie++;
			$('.cvTab').hide();
			$('#cv_'+pocitadloCvicenie).show();
		}
	});

	$('#select_exc_count').change(function(){
		// $('.selectpicker').selectpicker();
		if($('#select_exc_count').val() == 0){
			//$('#prednaska_admin').fadeOut(1000);
			$('#cvicenie_admin').fadeOut(1000);
			$('#cvicenie_admin_cont').html('');
		}else{
			$('#prednaska_admin').fadeIn(1000);
			$('#cvicenie_admin').fadeIn(1000);
			$('#add_predmet_wrap').fadeIn(1000);
			
			$('#cvicenie_admin_cont').html('');
			//pocet cviceni
			var pocet = $('#select_exc_count').val();
			maxTabCvic = pocet;
			//tu budem naplnat
			var t = _.template(template);
			for(var i = 0;i<pocet;i++){
				if(i==0)
					$('#cvicenie_admin_cont').append(t({prve:'prve',cvId:'cv_'+i,i:i+1,max:maxTabCvic}));
				else
					$('#cvicenie_admin_cont').append(t({prve:'niePrve',cvId:'cv_'+i,i:i+1,max:maxTabCvic}));
			}
		}
	});

	
	function show_select_detail(select_term){
		var zimny = [{meno:'z1',id:'1'},{meno:'z2',id:'2'}];
		var letny = [{meno:'l1',id:'1'},{meno:'l2',id:'2'}];
		
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
			select.append('<option value='+pole[i].id+'>'+pole[i].meno+'</option>');
		};
	}


	


	



});