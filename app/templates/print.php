<?php



?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<script src="/js/libs/jquery.min.js"></script>
	    <link rel="stylesheet" type="text/css" href='/style/admin.css'>
	        <link rel="stylesheet" type="text/css" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">


</head>
<body>
	<div id="tabulka-wrapper"></div>
	<script>
	$('#tabulka-wrapper').html("<table class='table'> <colgroup> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> <col span='1' style='width: 6.66%;'> </colgroup> <thead> <tr> <th>Deň</th> <th>6:00</th> <th>7:00</th> <th>8:00</th> <th>9:00</th> <th>10:00</th> <th>11:00</th> <th>12:00</th> <th>13:00</th> <th>14:00</th> <th>15:00</th> <th>16:00</th> <th>17:00</th> <th>18:00</th> <th>19:00</th> </tr> </thead> <tbody> <tr> <td class='den' >Pondelok</td> <td id='p-6' class='np'></td> <td id='p-7' class='np'></td> <td id='p-8' class='np'></td> <td id='p-9' class='np'></td> <td id='p-10' class='np'></td> <td id='p-11' class='np'></td> <td id='p-12' class='np'></td> <td id='p-13' class='np'></td> <td id='p-14' class='np'></td> <td id='p-15' class='np'></td> <td id='p-16' class='np'></td> <td id='p-17' class='np'></td> <td id='p-18' class='np'></td> <td id='p-19' class='np'></td> </tr> <tr> <td class='den' >Utorok</td> <td class='np' id='u-6'></td> <td class='np' id='u-7'></td> <td class='np' id='u-8'></td> <td class='np' id='u-9'></td> <td class='np' id='u-10'></td> <td class='np' id='u-11'></td> <td class='np' id='u-12'></td> <td class='np' id='u-13'></td> <td class='np' id='u-14'></td> <td class='np' id='u-15'></td> <td class='np' id='u-16'></td> <td class='np' id='u-17'></td> <td class='np' id='u-18'></td> <td class='np' id='u-19'></td> </tr> <tr> <td class='den' >Streda</td> <td class='np' id='s-6'></td> <td class='np' id='s-7'></td> <td class='np' id='s-8'></td> <td class='np' id='s-9'></td> <td class='np' id='s-10'></td> <td class='np' id='s-11'></td> <td class='np' id='s-12'></td> <td class='np' id='s-13'></td> <td class='np' id='s-14'></td> <td class='np' id='s-15'></td> <td class='np' id='s-16'></td> <td class='np' id='s-17'></td> <td class='np' id='s-18'></td> <td class='np' id='s-19'></td> </tr> <tr> <td class='den' >Štvrtok</td> <td class='np' id='st-6'></td> <td class='np' id='st-7'></td> <td class='np' id='st-8'></td> <td class='np' id='st-9'></td> <td class='np' id='st-10'></td> <td class='np' id='st-11'></td> <td class='np' id='st-12'></td> <td class='np' id='st-13'></td> <td class='np' id='st-14'></td> <td class='np' id='st-15'></td> <td class='np' id='st-16'></td> <td class='np' id='st-17'></td> <td class='np' id='st-18'></td> <td class='np' id='st-19'></td> </tr> <tr> <td class='den' >Piatok</td> <td class='np' id='pi-6'></td> <td class='np' id='pi-7'></td> <td class='np' id='pi-8'></td> <td class='np' id='pi-9'></td> <td class='np' id='pi-10'></td> <td class='np' id='pi-11'></td> <td class='np' id='pi-12'></td> <td class='np' id='pi-13'></td> <td class='np' id='pi-14'></td> <td class='np' id='pi-15'></td> <td class='np' id='pi-16'></td> <td class='np' id='pi-17'></td> <td class='np' id='pi-18'></td> <td class='np' id='pi-19'></td> </tr> </tbody> </table>");


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


	var obj = <?php echo json_encode($_GET) ?>;
	var data = 'type='+obj.type+'&id='+obj.id;
	console.log(data);
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
	</script>
</body>
</html>