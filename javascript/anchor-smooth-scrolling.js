/**
	all of this code in tandem should handle all smooth scrolling on your site

	requirements:
		jQuery
**/

var headerOffset = 0; // pixel height to account for sticky headers
var notAnchors = '.lightbox-inline,.lightbox-contact'; // comma-delimited string of classes to apply to anchors for which you do not want smooth scrolling

function smoothScroll(target, offset) {
	$('html,body').animate({
		scrollTop: target.offset().top - offset
	}, 1000);
}

function navigate_to_hash() {
	var target = $('#'+hash).length ? $('#'+hash) : $('[name=' + this.hash.slice(1) +']');
	smoothScroll(target, headerOffset);
	clearInterval(interval);
}

$(document).ready(function(){
	$('a[href*=#]:not([href=#])').not($(notAnchors)).click(function(event) {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				setTimeout(function() {
					smoothScroll(target, headerOffset);
				}, 50);
			}
			return false;
		}
	});
	
	if(hash!=undefined && hash!='') {
		interval = setInterval(navigate_to_hash , 250); // this should give your page enough time to load; if not, increase the second parameter to > 250
	}
});

var hash = '';
var interval = null;
hash = location.hash.replace('#', '');
if(hash != ''){
	// Clear the hash in the URL
	location.hash = '';
}