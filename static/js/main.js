function isNumeric(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function setCookie(cname, cvalue) {
    var d = new Date();
    d.setTime(d.getTime() + 24*60*60*1000);
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}


$(document).ready(function() {
	var signal = getCookie("signal");
	if(signal != '')
		$("span.signal").html(signal); 

	$.ajax({
			cache:false,
			url:base_url+"smsys_core/network.php",
			success:function(e){
				if(e!=""){ 
					var arrData = $.parseJSON(e); 
					if(isNumeric(arrData.signal)){
						$("span.signal").html(arrData.signal+"% ("+arrData.network+")");
						setCookie("signal", arrData.signal+"% ("+arrData.network+")");
					}
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
							if(isNumeric(arrData.signal)){
								$("span.signal").html(arrData.signal+"% ("+arrData.network+")"); 
								setCookie("signal", arrData.signal+"% ("+arrData.network+")");
							}
						}
					}
			});
	}, 20000);
});