$(document).ready(function() {
var miestnosti =[];
var prednasajuci = [];
var jazyk = "svk";
	// $('.selectpicker').selectpicker();
	var lang = {
			"eng":{
				"nav":['Add Subject','Check'],
				"logButt":"Logout",
				"hn":"Add Subject",
				"pt":"Select Term:",
				"prd":"Subject:",
			},
			"svk":{
				"nav":['Pridať Predmet','Kontrola'],
				"logButt":"Odhlás",
				"hn":"Pridať Predmet",
				"pt":"Výber semestra:",
				"prd":"Predmet:",
			}
	}
	var template = '<div id="<%= cvId %>" class="<%= prve %> cvTab" ><h2>Cvičenie <%= i %>/<%= max %> </h2><h3>Cvičiaci:</h3><select name="select_instructor_<%= cvId %>" id="select_cviciaciC_admin" class="form-control select_cviciaciC_adminClass"></select><h3>Deň:</h3><select name="select_exc_day_<%= cvId %>" id="select_denC_admin" class="form-control"><option value="pondelok">pondelok</option><option value="utorok">utorok</option><option value="streda">streda</option><option value="stvrtok">stvrtok</option><option value="piatok">piatok</option></select><h3>Čas:</h3><select name="select_exc_time_<%= cvId %>" id="select_casC_admin" class="form-control"><option value="0600">06:00</option><option value="0700">07:00</option><option value="0800">08:00</option><option value="0900">09:00</option><option value="1000">10:00</option><option value="1100">11:00</option><option value="1200">12:00</option><option value="1300">13:00</option><option value="1400">14:00</option><option value="1500">15:00</option><option value="1600">16:00</option><option value="1700">17:00</option><option value="1800">18:00</option><option value="1900">19:00</option><option value="2000">20:00</option></select><h3>Miestnosť:</h3><select name="select_exc_place_<%= cvId %>" id="select_miestnostC_admin" class="form-control select_miestnostC_adminClass"></select></div>';

	var pocitadloCvicenie=0;
	var maxTabCvic;

	$('#eng').click(function(){
		toEng();
	})
	function toEng () {
		jazyk='eng';
		$('#nav-0').html(lang.eng.nav[0]);
		$('#nav-1').html(lang.eng.nav[1]);
		$('#logButt').html(lang.eng.logButt);
		$('#hn').html(lang.eng.hn);
		$('#pt').html(lang.eng.pt);
		var pt = "<option value='skovaj'>type</option><option value='W'>Winter</option><option value='S'>Summer</option>";
		$('#select_term').html(pt);
		$('#prd').html(lang.eng.prd);
		if($("#select_subject option:first").html()){
			$("#select_subject option:first").html('subject');
		}
	}

	$('#svk').click(function(){
		toSvk();
	})
	function toSvk () {
		jazyk='svk';
		$('#nav-0').html(lang.svk.nav[0]);
		$('#nav-1').html(lang.svk.nav[1]);
		$('#logButt').html(lang.svk.logButt);
		$('#hn').html(lang.svk.hn);
		$('#pt').html(lang.svk.pt);
		var pt = "<option value='skovaj'>typ</option><option value='W'>Zimný</option><option value='S'>Letný</option>";
		$('#select_term').html(pt);
		$('#prd').html(lang.svk.prd);
		if($("#select_subject option:first").html()){
			$("#select_subject option:first").html('predmet');
		}
	}

	$('#select_term').change(function(){
		var term = $('#select_term').val();
		//console.log(term);

		show_select_detail(term)
		//if(jazyk=='eng')toEng();
		//else toSvk();
	});

	$('#select_subject').change(function(){

	$.when( 
		$.ajax({
		  type: "GET",
		  url: "/service/users",
		  success: function(resp){
		  	var pole = resp;
		  	prednasajuci=resp;
		  	var select = $('#select_prednasajuciP_admin');
		  	//select.html('<option value="-1">-</option>');
		  	for (var i = 0; i < pole.length; i++) {
		  		select.append('<option value='+pole[i].id+'>'+pole[i].firstname+' '+pole[i].surname+'</option>');
		  	};
		  	  }  
		}),
		$.ajax({
		  type: "GET",
		  url: "/service/rooms",
		  success: function(resp){
		  	var pole = resp;//[{"name":"abe3500","id":9},{"name":"cde300","id":10}];
		  	miestnosti = resp;//[{"name":"abe3500","id":9},{"name":"cde300","id":10}];
		  	var select = $('#select_miestnostP_admin');
		  	//select.html('<option value="-1">-</option>');
		  	for (var i = 0; i < pole.length; i++) {
		  		select.append('<option value='+pole[i].id+'>'+pole[i].name+'</option>');
		  	};
		  	
		  }  
		})
		).then(function( data, textStatus, jqXHR ) {
 

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

			var temp='';
			for(var i= 0;i<miestnosti.length;i++){
				temp+="<option value="+miestnosti[i].id+">"+miestnosti[i].name+"</option>";
			}
			$('.select_miestnostC_adminClass').append(temp)

			var temp='';
			for(var i= 0;i<prednasajuci.length;i++){
				temp+="<option value="+prednasajuci[i].id+">"+prednasajuci[i].firstname+" "+prednasajuci[i].surname+"</option>";
			}
			$('.select_cviciaciC_adminClass').append(temp)


		}
	});

	
	function show_select_detail(select_term){
		
		
		switch(select_term){
			case 'W':
					$.ajax({
					type: "GET",
					url: "/service/subjects",
					data: "term=W",
					success: function(resp){
							var pole=resp;//[{"name":"hovnoZimne","id":1}];	
							napln_select($('#select_subject'), pole);
							$('#druhy_select_admin').fadeIn(1000);					
						  } 
					});
					
				break;
			case 'S':
					$.ajax({
					type: "GET",
					url: "/service/subjects",
					data: "term=S",
					success: function(resp){
							var pole=resp;//[{"name":"hovnoLetne","id":2}];	
							napln_select($('#select_subject'), pole);
							$('#druhy_select_admin').fadeIn(1000);					
						  } 
					});
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
		select.html('<option value="skovaj">predmet</option>');
		for (var i = 0; i < pole.length; i++) {
			select.append('<option value='+pole[i].id+'>'+pole[i].name+'</option>');
		};
	}


	


	



});