var endPoint = window.location.hostname == 'localhost' ? 'http://0.0.0.0:3000/api/' : 'http://tiempocompartidolb.herokuapp.com/api/';

$(document).ready(function() {
    $.ajax({
        url: `${endPoint}promociones?filter[limit]=1`,
        type: 'GET',
        dataType: 'json',
        success: function (promocion) {
            $('#promocion-destacada-footer').append(`
                <div class="Card__Image">
                    Imagen
                </div>
                <p class="lead">
                    ${promocion.titulo}
                </p>
                <p class="text">
                    ${promocion.descripcion}
                </p>
                <p class="">
                    <a href="/promociones" class="btn btn-success">Promociones de tiempos compartidos</a>
                </p>
            `);
        },
        error: function(xhr, status, error) {
            console.log(error);
        }
    });  
});