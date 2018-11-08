
// This example displays an address form, using the autocomplete feature
// of the Google Places API to help users fill in the information.

// This example requires the Places library. Include the libraries=places
// parameter when you first load the API. For example:
// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

var placeSearch, autocomplete;
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

function initAutocomplete() {
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    autocomplete = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
        {types: ['geocode']});
    autocomplete1 = new google.maps.places.Autocomplete(
        /** @type {!HTMLInputElement} */(document.getElementById('autocomplete1')),
        {types: ['geocode']});

    // When the user selects an address from the dropdown, populate the address
    // fields in the form.
    autocomplete.addListener('place_changed', fillInAddress);
    autocomplete1.addListener('place_changed', fillInAddress1);
}

function fillInAddress() {
    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();

    for (var component in componentForm) {
        document.getElementById(component).value = '';
        document.getElementById(component).disabled = false;
    }

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    var street_number='';
    var route='';
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            if(addressType=='street_number'){
                 street_number=val;
            }
            else if(addressType=='route'){
                route=val;
            }
            else{
                document.getElementById(addressType).value = val;
            }

        }
    }
    document.getElementById('street_number').value = street_number+' '+route;
    var country = jQuery('#country').val();
    if(country=='China'){
        jQuery(".selected-flag:eq(1)").attr( "title",'China (中国): +86');
        jQuery(".selected-flag:eq(1) div:eq(0)").attr( "class",'iti-flag cn');
        jQuery('#mobile_number-58').val('+86');
    }
    if(country=='Canada'){
        jQuery(".selected-flag:eq(1)").attr( "title",'Canada: +1');
        jQuery(".selected-flag:eq(1) div:eq(0)").attr( "class",'iti-flag ca');
        jQuery('#mobile_number-58').val('+1');
    }
    if(country=='Taiwan'){
        jQuery(".selected-flag:eq(1)").attr( "title",'Taiwan (台灣): +886');
        jQuery(".selected-flag:eq(1) div:eq(0)").attr( "class",'iti-flag tw');
        jQuery('#mobile_number-58').val('+886');
    }
    textarea=document.getElementById("autocomplete");
    textarea.focus();
    var len = textarea.value.length;
    if (document.selection) {
        var sel = textarea.createTextRange();
        sel.moveStart('character', len);
        sel.collapse();
        sel.select();
    } else if (typeof textarea.selectionStart == 'number'
        && typeof textarea.selectionEnd == 'number') {
        textarea.selectionStart = textarea.selectionEnd = len;
    }



}
function fillInAddress1() {
    var place = autocomplete1.getPlace();

    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    document.getElementById('birth_post').value = '';

    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if(addressType=='postal_code'){
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById('birth_post').value = val;
            var elem = document.getElementById("notmatch");
            elem.style.visibility = 'hidden';
        }else{
            var elem = document.getElementById("notmatch");
            elem.style.visibility = 'visible';
        }

    }
    textarea=document.getElementById("autocomplete1");
    textarea.focus();
    var len = textarea.value.length;
    if (document.selection) {
        var sel = textarea.createTextRange();
        sel.moveStart('character', len);
        sel.collapse();
        sel.select();
    } else if (typeof textarea.selectionStart == 'number'
        && typeof textarea.selectionEnd == 'number') {
        textarea.selectionStart = textarea.selectionEnd = len;
    }



}
// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
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
function set_phone() {
    var country = jQuery('#country').val();
    if(country=='China' || country=='china'){
        jQuery(".selected-flag:eq(1)").attr( "title",'China (中国): +86');
        jQuery(".selected-flag:eq(1) div:eq(0)").attr( "class",'iti-flag cn');
        jQuery('#mobile_number-58').val('+86');
    }
    if(country=='Canada' || country=='canada'){
        jQuery(".selected-flag:eq(1)").attr( "title",'Canada: +1');
        jQuery(".selected-flag:eq(1) div:eq(0)").attr( "class",'iti-flag ca');
        jQuery('#mobile_number-58').val('+1');
    }
    if(country=='Taiwan' || country=='taiwan'){
        jQuery(".selected-flag:eq(1)").attr( "title",'Taiwan (台灣): +886');
        jQuery(".selected-flag:eq(1) div:eq(0)").attr( "class",'iti-flag tw');
        jQuery('#mobile_number-58').val('+886');
    }

}

