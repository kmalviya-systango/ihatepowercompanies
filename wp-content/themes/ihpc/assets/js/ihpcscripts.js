/*
* All Scripts and functions
*/
jQuery( document ).ready(function() {
	//Adding class to hottopics
    jQuery('#_hottopics').prev().addClass('_hottopics');
    
    //If no category is present then hide the element
    jQuery('.by_cat:empty').each(function(){
        if(jQuery.trim($(this).html()).length == 0){
            jQuery(this).parent().remove();
        }
    });

    var maxHeight = Math.max.apply(null, jQuery(".by_cat").map(function (){
        return jQuery(this).height();
    }).get());

    var highestBox = 0;
    jQuery('.by_cat').each(function(){  
        if(jQuery(this).height() > highestBox){  
            highestBox = jQuery(this).height();  
        }
    });

    jQuery('.by_cat').height(highestBox);

    jQuery(".show-toggle").click(function(){
        jQuery(this).next().next().toggleClass('hidden');
    });

    initAutocomplete();    

    //Jquery auto complete for companies
    //https://github.com/bassjobsen/Bootstrap-3-Typeahead
    jQuery.get(ihcpvars.ihcp_ajax_url+"?action=search_company", function(data){
        jQuery(".typeaheadCompanies").typeahead({ 
            source:data,
            minLength:1,
            fitToElement:1,
            showHintOnFocus:"all",
            afterSelect: function(item){
                console.log(item);
                window.location.href = item.url;
            }
        });
        jQuery(".reviewPageCompanies").typeahead({ 
            source:data,
            minLength:1,
            fitToElement:1,
            showHintOnFocus:"all",
            afterSelect: function(item){
                jQuery("#newCompanyCategory").hide();
            }
        });
    },'json');

    jQuery(".reviewTags").tagsinput({
        typeahead: {
            source: function(query) {
                return jQuery.get(ihcpvars.ihcp_ajax_url+"?action=search_review_tags");
            },
            afterSelect: function(item){
                var redirct = jQuery(".reviewTags").attr("data-redirect");
                window.location.href = redirct+"?tag="+item;
                // /console.log(item);                
            }
        }
    });

    jQuery("#toggleElement").on("click",function(){
        var element = jQuery(this).attr("data-target");
        jQuery(this).toggleClass("open");
        jQuery(element).slideToggle('500','linear');
    });

    //For companies page ajax call by letters
    jQuery(".company_by_letter").on("click",function(){
        jQuery("#ajax_loader").show();
        jQuery.ajax({
            url: ihcpvars.ihcp_ajax_url,
            data: {
                letter: jQuery(this).text(),
                action: 'get_company_by_letter',
                retType: 'html'
            },
            method: 'post',
            success: function(result){
                jQuery("#main").html(result);
                jQuery("#ajax_loader").hide();
            }
        });
    });

    //Display rattings
    jQuery(".showRatting").barrating({
        theme: 'fontawesome-stars-o',
        showSelectedRating: true,
        readonly: true,
        allowEmpty: true,
        emptyValue: 0
    });

});

jQuery(window).load(function(){							 
    jQuery('input').iCheck({
        checkboxClass: 'icheckbox_square-red',
        radioClass: 'iradio_square-red',
        increaseArea: '20%' // optional
    });				
	
    //console.log(ihcpvars.ihcp_ajax_url);
    //console.log(ihcpvars.ihcp_nonce);
    var ajaxurl = ihcpvars.ihcp_ajax_url;
    var ajaxurlnonce = ihcpvars.ihcp_nonce;
    //Adding class on body
    if (jQuery("body").hasClass("page")) {
        jQuery(".top_header").addClass("fixed")
    }

    //Home page search ajax company list
    //jQuery("#company_name").bind("keyup change", function(e) {
    /*jQuery("#company_name").bind("keyup", function(e) {
        var s_companyname = jQuery(this).val();
        jQuery.post(
            ajaxurl,
            {
                'action': 'home_search_title',
                'data':   s_companyname
            },
            function(response){
                //alert('The server responded: ' + response);
            }
        );
        console.log(s_companyname);
    });*/
	

	jQuery( "._unhappy .iCheck-helper" ).bind( "click", function() {
	  jQuery('._happy').removeClass("active")																 
	  jQuery(this).parents().find('._unhappy').addClass("active")
	});
	jQuery( "._happy .iCheck-helper" ).bind( "click", function() {
	  jQuery('._unhappy').removeClass("active")															   
	  jQuery(this).parents().find('._happy').addClass("active")
	});
	
	
/* Define star*/
/*var currentRating = jQuery('.star-rating').data('current-rating');

jQuery('.stars-example-fontawesome-o .current-rating')
    .find('span')
    .html(currentRating);

jQuery('.stars-example-fontawesome-o .clear-rating').on('click', function(event) {
    event.preventDefault();

    jQuery('.star-rating')
        .barrating('clear');
});*/

jQuery('.star-rating').barrating({
    theme: 'fontawesome-stars-o',
    showSelectedRating: false,
    onSelect: function(value, text) {
        if (!value) {
            jQuery('.star-rating')
                .barrating('clear');
        } else {
            jQuery('.stars-example-fontawesome-o .current-rating')
                .addClass('hidden');
            jQuery('.stars-example-fontawesome-o .your-rating')
                .removeClass('hidden')
                .find('span')
                .html(value);
        }
    },
    onClear: function(value, text) {
        jQuery('.stars-example-fontawesome-o')
            .find('.current-rating')
            .removeClass('hidden')
            .end()
            .find('.your-rating')
            .addClass('hidden');
    }
});

/* End Define star*/


/* Add remove list  Liked*/
var wnum = 0; 
var selectedwLiked = [];
jQuery('#addwLiked').click(function() {	
 var item = jQuery('#wliekd') 
 if(!item.val()) {
    jQuery('#wliekd').parent().addClass('has-error');
 }
 else{
	if(wnum < 5){	
      jQuery('#wliekd').parent().removeClass('has-error');	
      wnum++; 
      jQuery('ul#wliked-list').prepend("<li class=\"list-group-item\"><label>"+item.val()+"</label><div class=\"pull-right action-buttons\"><button type=\"button\" class=\"trash\"><span class=\"glyphicon glyphicon-trash\"></span></button></div></li>");
        selectedwLiked.push( item.val() );
        item.val('');            
        item.next().val(selectedwLiked);
 } else{	 		
	 jQuery('ul#wliked-list').prepend("<div class=\"alert alert-danger alert-dismissable\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>You can add only up to 5 likes</div>")		
	};
};
});
jQuery('ul#wliked-list').on('click', 'li .trash', function() {
 wnum--;  														  
  jQuery(this).closest("li").remove();
});
/* End add remove list Liked */


/* Add remove list  Liked*/
var num = 0;
var selectedLiked = [];
jQuery('#addLiked').click(function() {	
    var item = jQuery('#liekd') 
    if(!item.val()) {
        jQuery('#liekd').parent().addClass('has-error');
    }
    else{
        if(num < 5){	
            console.log("nav value add");
            jQuery('#liekd').parent().removeClass('has-error');	
            num++;
            jQuery('ul#liked-list').prepend("<li class=\"list-group-item\"><label>"+item.val()+"</label><div class=\"pull-right action-buttons\"><button type=\"button\" class=\"trash\"><span class=\"glyphicon glyphicon-trash\"></span></button></div></li>");
            selectedLiked.push( item.val() );
            item.val('');            
            item.next().val(selectedLiked);
        } 
        else{	 		
            jQuery('ul#liked-list').prepend("<div class=\"alert alert-danger alert-dismissable\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>You can add only up to 5 likes</div>")		
        };
    };
});

jQuery('ul#liked-list').on('click', 'li .trash', function() {
    console.log("nav value remove");
    num--;  														  
    jQuery(this).closest("li").remove();
});
/* End add remove list Liked */

/* Add remove list  UNLiked*/
var numun = 0; 
var selectedUnLiked = [];
jQuery('#addunLiked').click(function() {	
 var item = jQuery('#unliekd') 
 if(!item.val()) {
    jQuery('#unliekd').parent().addClass('has-error');
 }
 else{
	if(numun < 5){	
	  console.log("nav value add");
      jQuery('#unliekd').parent().removeClass('has-error');	
      numun++; 
      jQuery('ul#unliked-list').prepend("<li class=\"list-group-item\"><label>"+item.val()+"</label><div class=\"pull-right action-buttons\"><button type=\"button\" class=\"trash\"><span class=\"glyphicon glyphicon-trash\"></span></button></div></li>");
        selectedUnLiked.push( item.val() );
        item.val('');            
        item.next().val(selectedUnLiked);
 } else{	 		
	 jQuery('ul#unliked-list').prepend("<div class=\"alert alert-danger alert-dismissable\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>You can add only up to 5 likes</div>")		
	};
};
});
jQuery('ul#unliked-list').on('click', 'li .trash', function() {
console.log("nav value remove");
 numun--;  														  
  jQuery(this).closest("li").remove();
});
/* End add remove list UNLiked */



});

function set_modal_lat_long(lat, long) {
    document.getElementById('glat').value = lat;
    document.getElementById('glong').value = long;
    /*jQuery('#longitude').text(long);
    jQuery('#latitude').text(lat);*/
}

/*********
* Google place auto complete address
*
* <input onFocus="geolocate()" id="autocomplete" type="text">
* <input type="hidden" id="glat" name="location[latitude]" value="" />
* <input type="hidden" id="glong" name="location[longitude]" value="" />
********/
var autocomplete;
function initAutocomplete() {
    autocomplete = new google.maps.places.Autocomplete(
    /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
    {types: ['geocode']});
    autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  var place     = autocomplete.getPlace();
  var latitude  = place.geometry.location.lat().toFixed(6);
  var longitude = place.geometry.location.lng().toFixed(6);
  set_modal_lat_long(latitude,longitude);
}

function geolocate() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };
            var circle = new google.maps.Circle({
                center: geolocation,
                radius: position.coords.accuracy
            });
            autocomplete.setBounds(circle.getBounds());
        });
    }
}