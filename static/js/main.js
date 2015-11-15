function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

$(document).ready(function() {
	$.ajax({
			cache:false,
			url:base_url+"smsys_core/network.php",
			success:function(e){
				if(e!=""){ 
					var arrData = $.parseJSON(e); 
					if(isNumeric(arrData.signal))
						$("span.signal").html(arrData.signal+"% ("+arrData.network+")");
				}
			}
	});	
	setInterval(function(){
			$.ajax({
					cache:false,
					url:base_url+"smsys_core/network.php",
					success:function(e){
						if(e!=""){ 
							var arrData = $.parseJSON(e); 
							if(isNumeric(arrData.signal))
								$("span.signal").html(arrData.signal+"% ("+arrData.network+")"); 
						}
					}
			});
	}, 20000);
});