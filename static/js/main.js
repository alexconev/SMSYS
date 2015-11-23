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

var snk = snk || {};

(function ($, window) {
    var nChar = 160;
    var nSms = 0;
    var ascii = /^[ -~]+$/;

    function send(){
    	$('#LeftSym').val(nChar);
    	$('#SmsNum').val(nSms);
    	$('#Content').keypress(function(){
			if ( ascii.test( str ) ) {
                var str = $('#Content').val();
                $('#LeftSym').val(nChar - ((str.length + 1) % nChar));
                $('#SmsNum').val(parseInt((str.length + 1) / nChar));
			}
    	});

        $('#phone2').change(function(){
            $("#phone").val($("#phone2 option:selected").val());
        })
    }

    function getstatus(){
		$.ajax({
			cache:false,
			url:base_url+"sys/status",
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
    }

    function loadsmss(){
        $.ajax({
            cache:false,
            url:base_url+"sys/loadsms",
            success:function(e){}
        });         
    }

    return snk.sms = {
        s: send,
        st: getstatus,
        l: loadsmss
    };
})(jQuery, window);

$(document).ready(function() {
	var signal = getCookie("signal");
	if(signal != '')
		$("span.signal").html(signal); 

    var Interval = 60000;
	snk.sms.st();
    setInterval(function(){ snk.sms.st() }, Interval);
	//setTimeout(function(){ snk.sms.l(); setInterval(function(){ snk.sms.l() }, 2*Interval);}, Interval/2);
});