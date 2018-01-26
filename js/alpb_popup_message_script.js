function popupbox() {
    jQuery('.alpb-popup-message-wrapper').css({
    	'display' : 'block'
    });
}
function GetCookie(name) {
    var arg=name+"=";
    var alen=arg.length;
    var clen=document.cookie.length;
    var i=0;

    while (i<clen) {
        var j=i+alen;
            if (document.cookie.substring(i,j)==arg)
                return "show";
            i=document.cookie.indexOf(" ",i)+1;
            if (i==0) 
                break;
    }
    return null;
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires="+d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

jQuery(document).ready(function($){
	var winHeight = $(window).height(),
		login_checker = $('#alpb-popup-message-login-checker').val();

	if(login_checker == 0){
		$(window).scroll(function (event) {
		    var winScroll = $(window).scrollTop();
		    if( winScroll >= 100 ){
		    	var visit=GetCookie("alpbpopupmessage");
			    if (visit==null){
			    	var exdays = (( 1 / 60 ) / 24); //expires within 30 mins
			    	setCookie('alpbpopupmessage','true', exdays);
			        popupbox();
			    }
		    }
		});	
	}
    $('.alpb-popup-message-close').on('click', function(e){
		$('.alpb-popup-message-wrapper').css({'display':'none'});
	});

});

