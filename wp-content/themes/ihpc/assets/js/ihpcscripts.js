/**
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
    jQuery("#company_name").bind("keyup", function(e) {
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
    });
	

	jQuery( "._unhappy .iCheck-helper" ).bind( "click", function() {
	  jQuery('._happy').removeClass("active")																 
	  jQuery(this).parents().find('._unhappy').addClass("active")
	});
	jQuery( "._happy .iCheck-helper" ).bind( "click", function() {
	  jQuery('._unhappy').removeClass("active")															   
	  jQuery(this).parents().find('._happy').addClass("active")
	});
	
	
/* Define star*/
var currentRating = jQuery('.star-rating').data('current-rating');

jQuery('.stars-example-fontawesome-o .current-rating')
    .find('span')
    .html(currentRating);

jQuery('.stars-example-fontawesome-o .clear-rating').on('click', function(event) {
    event.preventDefault();

    jQuery('.star-rating')
        .barrating('clear');
});

jQuery('.star-rating').barrating({
    theme: 'fontawesome-stars-o',
    showSelectedRating: false,
    initialRating: currentRating,
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

// This is called with the results from from FB.getLoginStatus().
function statusChangeCallback(response) {
    //console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
        // Logged into your app and Facebook.
        //testAPI();
    } else {
        // The person is not logged into your app or we are unable to tell.
       // document.getElementById('status').innerHTML = 'Please log ' +
                //'into this app.';
    }
}

// This function is called when someone finishes with the Login
// Button.  See the onlogin handler attached to it in the sample
// code below.
function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

window.fbAsyncInit = function() {
    FB.init({
        appId      : '192419861278690',
        cookie     : true,  // enable cookies to allow the server to access
        oauth      : true,  // the oauth
        status     : true,
        xfbml      : true,  // parse social plugins on this page
        version    : 'v2.8' // use graph api version 2.8
    });


    // Now that we've initialized the JavaScript SDK, we call
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
    // These three cases are handled in the callback function.

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });

};



function fb_login(){
    FB.login(function(response) {
        if (response.authResponse) {
            //console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me',{fields: 'id,name,email,first_name,last_name,picture.type(large)'}, function(response) {
                user_fbid = response.id; //get user email
                user_email = response.email; //get user email
                user_fullname = response.name;
                user_fname = response.first_name; //get user first_name
                user_lname = response.last_name; //get user first_name
                user_picture = response.picture.data.url; //get user imagesrc
                //console.log(response);
                //console.log(response.picture.data.url);
                jQuery.ajax({
                    url : ajaxurl,
                    type : 'post',
                    data : {
                        action : 'ihpc_social_login',
                        'user_fbid'  : user_fbid,
                        'user_email' : user_email,
                        'user_fname' : user_fname,
                        'user_lname' : user_lname,
                        'user_fullname' : user_fullname,
                        'user_picture' : user_picture
                    },
                    success : function( response ) {
                        console.log(response);
                    },
                    error: function(xhr, ajaxOptions, thrownError)
                    {
                        //console.log(xhr.responseText);
                        //console.log(thrownError);
                    }
                });
            });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'email,public_profile,user_about_me',
        return_scopes:true
    });
}
/*(function() {
    var e = document.createElement('script');
    e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
    e.async = true;
    document.getElementById('fb-root').appendChild(e);
}());*/

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Here we run a very simple test of the Graph API after login is
// successful.  See statusChangeCallback() for when this call is made.
function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Successful login for: ' + response.name);
       //document.getElementById('status').innerHTML =
        // 'Thanks for logging in, ' + response.name + '!';
    });
}

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
/***
* END
***/