$('#map-component').locationpicker({
    location: {
        latitude: $('#us2-lat').val(),
        longitude: $('#us2-lon').val(),
    },
    radius: 300,
    inputBinding: {
        locationNameInput: $('#us2-address'),
        latitudeInput: $('#us2-lat'),
        longitudeInput: $('#us2-lon')
    },
    enableAutocomplete: true,
    onchanged: function (currentLocation, radius, isMarkerDropped) {
        var addressComponents = $(this).locationpicker('map').location.addressComponents;
        updateControls(addressComponents);
    }

});
function updateControls(addressComponents) {
    $('#us2-city').val(addressComponents.city);
}