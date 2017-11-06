$(document).ready(function() {

    // Checks for the select tag at the beginning of execute the web page       
    switch($('#semanaTipo option:selected').val()) {
        case 'FIJA':
            $('#cualSemanaFijaDiv').show();              
            break;
        case 'PUNTOS':
            $('#cuantosPuntosDiv').show();
            break;
        case 'NOCHES':
            $('#cuantasNochesDiv').show();
            break;
        case 'FLOTANTE':
            $('#cualTemporadaflotanteDiv').show();
            break;
    }

    // Checks if at the beginning of execute the web page checkboxes are checked
    if ( $('#mantenimiento').is(':checked') ) 
        $('.existeCuotaMantenimiento').show();
    
    if ( $('#venta').is(':checked') ) 
        $('.estaEnVenta').show();
    
    if ( $('#renta').is(':checked') ) 
        $('.estaEnRenta').show();


    $('#semanaTipo').on('change', function() {
        $('#cualSemanaFijaDiv').hide();
        $('#cuantosPuntosDiv').hide();
        $('#cuantasNochesDiv').hide();
        $('#cualTemporadaflotanteDiv').hide();

        switch(this.value) {
        case 'FIJA':
            $('#cualSemanaFijaDiv').show();              
            break;
        case 'PUNTOS':
            $('#cuantosPuntosDiv').show();
            break;
        case 'NOCHES':
            $('#cuantasNochesDiv').show();
            break;
        case 'FLOTANTE':
            $('#cualTemporadaflotanteDiv').show();
            break;
        }
    });

    $('#mantenimiento').on('change', function() {
        $('#mantenimiento').is(':checked') 
        ? $('.existeCuotaMantenimiento').slideDown() 
        : $('.existeCuotaMantenimiento').slideUp();
    });

    $('#venta').on('change', function() {
        $('#venta').is(':checked') 
        ? $('.estaEnVenta').slideDown() 
        : $('.estaEnVenta').slideUp();
    });

    $('#renta').on('change', function() {
        $('#renta').is(':checked') 
        ? $('.estaEnRenta').slideDown() 
        : $('.estaEnRenta').slideUp();
    });
});

