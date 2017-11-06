var endPoint = window.location.hostname == 'localhost' ? 'http://0.0.0.0:3000/api/' : 'http://tiempocompartidolb.herokuapp.com/api/';
var uploadFolder = window.location.hostname == 'localhost' ? 'uploads' : 'server-upload';
function setDescription(imageNumber) {
    var id = $('#image-' + imageNumber).val();
    var description = $('#modif-descripcion-' + imageNumber).val();
    $.ajax({
        type: 'PATCH',
        url: `${endPoint}imagenes/${id}`,
        data: {
            descripcion : description
        },
        success: function (data) {
            $('#successEdit-'+imageNumber).show().delay(3000).fadeOut();
            $('#topDescription-'+imageNumber).text(description);
        },
        error: function(xhr, status, error) {
            makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING');
        }
    })
}

// function setFavorito(membresiaId, userId, isFavorito) {
//     var method;
//     var color;
//     var message;
//     var toastStatus;
//     // Mandar un request a la API sabiendo si el usario tiene favorito a esa membresia
//     // Si sí lo tiene: hacer method DELETE
//     // Si no lo tiene: hacer method POST
//     // Problema: no hay un metodo en la API para obtener la relacion si hay un favorito entre la persona y la membresia 
//     getFavoritosByIdUser(userId, function(error, favoritos) {
//         favoritos.forEach(function(favorito) {
//             // Es favorito y se debe eliminar
//             if(favorito.idMembresia == membresiaId) {
//                 $.ajax({
//                     type: 'DELETE',
//                     url: `${endPoint}People/${userId}/favoritos/${favorito.id}`,
//                     success: function (data) {
//                         console.log(data);
//                         makeToast('Favorito', 'Ha sido quitado de favoritos', 'SUCCESS');
//                     },
//                     error: function(xhr, status, error) {
//                         makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING');
//                     }
//                 });
//                 break;
//             } else { // No es favorito y se debe eliminar
//                 $.ajax({
//                     type: 'POST',
//                     url: `${endPoint}People/${userId}/favoritos`,
//                     success: function (data) {
//                         console.log(data);
//                         makeToast('Favorito', 'Guardado en favoritos', 'SUCCESS');
//                     },
//                     error: function(xhr, status, error) {
//                         makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING');
//                     }
//                 });
//                 break;
//             }
//         });
//     });
//     // if (isFavorito) {
//     //     method = 'DELETE';
//     //     color = 'gray';
//     //     message = 'Eliminado de favoritos';
//     //     toastStatus = 'WARNING';
//     // } else {
//     //     method = 'POST';
//     //     color = 'red';
//     //     message = 'Agregado a favoritos';
//     //     toastStatus = 'SUCCESS';
//     // }

//     // $.ajax({
//     //     type: method,
//     //     url: `${endPoint}People/${userId}/favoritos`,
//     //     data: {
//     //         idMembresia : membresiaId
//     //     },
//     //     success: function (data) {
//     //         console.log(color);
//     //         $('favoritos-heart').css('color', color);
//     //         makeToast('Favorito', message, toastStatus);
//     //     },
//     //     error: function(xhr, status, error) {
//     //         makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING');
//     //     }
//     // });
    
// }

function getFavoritosByIdUser(userId, cb) {
    $.ajax({
        type: 'GET',
        url: `${endPoint}/People/${userId}/favoritos`,
        success: function (data) {
            return cb(null, data);
        },
        error: function(xhr, status, error) {
            return cb(error);
        }
    });
}
function setLocation($ACCESS_TOKEN) {
    $.ajax({
        url: `${endPoint}Membresia/${$('#membresiaId').val()}`,
        type: 'GET',
        dataType: 'json',        
        success: function (data) {
            var method = data.ubicacion == null ? 'POST' : 'PUT';

            $.ajax({
                url: `${endPoint}Membresia/${$('#membresiaId').val()}/ubicacion`,
                type: method,
                data: {
                    lat : $('#us2-lat').val().toString(),
                    lng : $('#us2-lon').val().toString(),
                    descripcion : $('#us2-address').val().toString(),
                    ciudad : $('#us2-city').val().toString()
                },
                success: function (data) {
                    $('#successLocationChanged').show().delay(3000).fadeOut();
                },
                error: function(xhr, status, error) {
                    makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING');
                }
            });
        },
        error: function(xhr, status, error) {
            makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING');
        }
    });
}

function publish(membresiaId, statusName) {
    $.ajax({
        url: `${endPoint}Membresia/${membresiaId}`,
        type: 'PATCH',
        dataType: 'json',
        data: {
            status: statusName            
        },
        success: function (data) {
            makeToast('Cambio de status','Estatus actualizado a ' + statusName, 'INFO');
        },
        error: function(xhr, status, error) {
            makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING')
        }
    });
}

function setLocalidadesUser() {
    console.log('setLocalidades');
    $('.ciudadNombre-select').remove();
    var paisId = $('select[name=pais]').val()
    $.ajax({
        url: `${endPoint}localidades/findLocalidades/${paisId}`,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log('Datos: ',data);
            var selectTag = $("<select id='ciudad' name='ciudad' class='form-control ciudadNombre-select'></select>");
            data.forEach(function(city) {
                selectTag.append(`<option value="${city.nombre}" >${city.nombre}</option>`);
            });
            $('.ciudadNombre-user-select').append(selectTag);
        },
        error: function(xhr, status, error) {
            console.log('Error: ', error);
        }
    });
}

function setLocalidadesMembresia() {
    console.log('setLocalidadesMem');        
    $('.localidadNombre-select').remove();
    var paisId = $('select[name=idPais]').val()
    $.ajax({
        url: `${endPoint}localidades/findLocalidades/${paisId}`,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var selectTag = $("<select id='localidadNombre' name='localidadNombre' class='form-control localidadNombre-select' required></select>");
            data.forEach(function(city) {
                selectTag.append(`<option value="${city.nombre}" >${city.nombre}</option>`);
            });
            $('.localidad-select').append(selectTag);
        },
        error: function(xhr, status, error) {
            console.log('Error: ', error);
        }
    });
}
function setLocalidadesBusqueda() {
    console.log('setLocalidades');
    $('.ciudadBusqueda-select').remove();
    $('#cmb__City').remove();
    var paisId = $('select[name=pais]').val()
    $.ajax({
        url: `${endPoint}localidades/findLocalidades/${paisId}`,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            var labelCity = $(`<label for="cmb__City" id="cmb__City">Ciudad</label>`);
            var selectTag = $(`
                <select id="ciudad" name="ciudad" class="form-control ciudadBusqueda-select"></select>
            `);
            selectTag.append($('<option value="">Todas</option>'));
            
            data.forEach(function(city) {
                selectTag.append(`<option value="${city.nombre}" >${city.nombre}</option>`);
            });
            $('.ciudad-busqueda').append(labelCity);
            $('.ciudad-busqueda').append(selectTag);
        },
        error: function(xhr, status, error) {
            console.log('Error: ', error);
        }
    });
}

function searchMembresias() {
    var paisId = $('#pais').val();
    var ciudad = $('#ciudad').val();
    var busco = $('#busco').val();
    var huespedes = $('#huespedes').val();
    var ubicacion = $('#ubicacion').val();
    var inmueble = $('#inmueble').val();
    var pais;

    findPaisById(paisId, function(error, pais) {
        console.log(pais.nombre);
        getBusqueda(pais.nombre, ciudad, busco, huespedes, ubicacion, inmueble, function(error, membresias) {
            setLocationsOnMap(membresias);
            console.log(membresias);
            var card;
            $('.resultados-content').remove();
            var resulContent = $('<div class="resultados-content row" ></div>');
            $('.membresias-result').append(resulContent);
            
            membresias.forEach(function(membresia) {
                var image = membresia.imagenes[0] == null ? 'assets/img/sin-imagen-land.jpg' :  `${uploadFolder}/membresias-images/thumbs/${membresia.imagenes[0].src}`;
                card = $(`
                    <div class="col-md-4" style="max-width:100%;">
                            <div class="card">
                                <img style="width:100%;"class="card-img-top" src="${image}" alt="imagen">
                                <div class="card-block">
                                    <h4 class="card-title">${membresia.titulo}</h4>
                                    <p class="card-text">${membresia.descripcion}</p>
                                    <a class="btn btn-primary" href="/membresia/tiempo-compartido-en-${slugify(membresia.localidadNombre)}-${slugify(membresia.clubNombre)}-${slugify(membresia.paisNombre)}/${membresia.id}">Ir a membresia</a>
                                </div>
                            </div>
                    </div>
                `);
                $('.resultados-content').append(card);
            });
        });
    })        
    
}

function findPaisById (paisId, cb) {
    $.ajax({
        url: `${endPoint}paises/${paisId}`,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            return cb(null, data);
        },
        error: function(xhr, status, error) {
            return cb(error);
        }
    });    
}

function getBusqueda(pais, ciudad, rentaventa, huespedes, ubicacion, inmueble, cb) {
    ciudad = ciudad !== undefined ? ciudad : '';
    var ventaVal = (rentaventa == 'VENTA') ? true : false;
    var rentaVal = (rentaventa == 'RENTA') ? true : false;
    $.ajax({
        // url: `${endPoint}Membresia/busqueda/${pais}/${ciudad}/${rentaventa}/${huespedes}`,
        url: `${endPoint}Membresia/?filter[where][paisNombre][like]=${pais}&filter[where][localidadNombre][like]=${ciudad}&filter[where][venta]=${ventaVal}&filter[where][renta]=${rentaVal}&filter[where][maxOcupantes][gt]=${huespedes}&filter[where][ubicadoEn][like]=${ubicacion}&filter[where][tipoInmueble][like]=${inmueble}`,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log(`${endPoint}Membresia/?filter[where][paisNombre][like]=${pais}&filter[where][localidadNombre][like]=${ciudad}&filter[where][venta]=${ventaVal}&filter[where][renta]=${rentaVal}&filter[where][maxOcupantes][gt]=${huespedes}&filter[where][ubicadoEn][like]=${ubicacion}&filter[where][tipoInmueble][like]=${inmueble}`);
            console.log(`${endPoint}Membresia/busqueda/${pais}/${ciudad}/${rentaventa}/${huespedes}`);
            return cb(null, data)
        },
        error: function(xhr, status, error) {
            return(error);
        }
    }); 
}

    
function initMap() {
    var map;
    map = new google.maps.Map(document.getElementById('mapSearch'), {
        center: {lat: 19.436088918814285, lng: -50},
        zoom: 2
    });
}
function setLocationsOnMap(membresias) {
    var locations=[];

    for(var x = 0; x < membresias.length; x ++) {
        if( membresias[x].ubicacion != null && membresias[x].ubicacion != undefined)
            locations.push([
                membresias[x].ubicacion.descripcion,
                membresias[x].ubicacion.lat,
                membresias[x].ubicacion.lng,
            ]);
    }
    var map = new google.maps.Map(document.getElementById('mapSearch'), {
        zoom: 2,
        center: {lat: 19.436088918814285, lng: -50},        
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();
    var marker, i;

    for(i =0; i < locations.length; i++) {
        marker = new google.maps.Marker({
            position: new google.maps.LatLng(locations[i][1], locations[i][2]),
            map: map
        });

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
            infowindow.setContent(locations[i][0]);
            infowindow.open(map, marker);
            }
        })(marker, i));
    }
    console.log(locations);
}
function slugify(input){
    if(input!==undefined) {
        var tittles = "ÃÀÁÄÂÈÉËÊÌÍÏÎÒÓÖÔÙÚÜÛãàáäâèéëêìíïîòóöôùúüûÑñÇç %$!¡?¿";
        var original = "AAAAAEEEEIIIIOOOOUUUUaaaaaeeeeiiiioooouuuunncc-";
        for (var i = 0; i < tittles.length; i++) {
            input = input.replace(tittles.charAt(i), original.charAt(i)).toLowerCase();
        };
        return input;
    }
}
var isMemFavorito = false;
function isFavorite(membresiaId, userId) {
    var checked = false;
    getFavoritosByIdUser(userId, function(err, favoritos) {
        if( !err ) {
            if( favoritos.length > 0 ) {
                for(var i = 0; i < favoritos.length; i ++) {
                    if(favoritos[i].idMembresia === membresiaId) {
                        $('#favoritos-heart').css('color', 'red');
                        checked = true;
                        break;
                    }
                }
                if( !checked ) {  
                    $('#favoritos-heart').css('color', 'gray');                    
                }
            } else {
                $('#favoritos-heart').css('color', 'gray');
            }
        }
    });
}

function setFavorito(membresiaId, userId) {
    var checked = false;
    getFavoritosByIdUser(userId, function(err, favoritos) {
        if ( !err ) {
            if ( favoritos.length > 0 ) {
                for (var i = 0; i < favoritos.length; i++) {
                    if ( favoritos[i].idMembresia === membresiaId ) {
                        checked = true;
                        $.ajax({
                            type: 'DELETE',
                            url: `${endPoint}People/${userId}/favoritos/${favoritos[i].id}`,
                            success: function (data) {
                                console.log(data);
                                makeToast('Favorito', 'Ha sido eliminado de favoritos', 'SUCCESS');
                            },
                            error: function(xhr, status, error) {
                                makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING');
                            }
                        });
                        $('#favoritos-heart').css('color', 'gray');
                        break;               
                    }
                    
                }
                if ( !checked ) {
                    $.ajax({
                        type: 'POST',
                        url: `${endPoint}People/${userId}/favoritos`,
                        data: {
                            idMembresia: membresiaId,
                            idPerson: userId
                        },
                        success: function (data) {
                            console.log(data);
                            makeToast('Favorito', 'Ha sido agregado a favoritos', 'SUCCESS');
                        },
                        error: function(xhr, status, error) {
                            makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING');
                        }
                    });
                    $('#favoritos-heart').css('color', 'red');         
                }
            } else {
                $.ajax({
                    type: 'POST',
                    url: `${endPoint}People/${userId}/favoritos`,
                    data: {
                        idMembresia: membresiaId,
                        idPerson: userId
                    },
                    success: function (data) {
                        console.log(data);
                        makeToast('Favorito', 'Ha sido agregado a favoritos', 'SUCCESS');
                    },
                    error: function(xhr, status, error) {
                        makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING');
                    }
                });
                $('#favoritos-heart').css('color', 'red');                
            }
        }
    });
}

$(function(){
    $('div[onload]').trigger('onload');
});

function setDisponible( id ) {
    $.ajax({
        type: 'GET',
        url: `${endPoint}/disponibilidades/${id}`,
        success: function (data) {
            if ( data ) {
                
                $.ajax({
                    type: 'PATCH',
                    url: `${endPoint}/disponibilidades/${id}`,
                    data: {
                        libre: !data.libre
                    },
                    success: function (data) {
                        console.log(data);
                    },
                    error: function(xhr, status, error) {
                        makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING');
                    }
                });
            }
        },
        error: function(xhr, status, error) {
            makeToast('Error','Ha ocurrido un error, vuelva a intentarlo.', 'WARNING');
        }
    });
}

function selectAmenidad( amenidadId, membresiaId ) {
    $.ajax({
        type: 'GET',
        url: `${endPoint}/Membresia/${membresiaId}/amenidades/${amenidadId}`,
        success: function (data) {
            console.log(data);
            setAmenidad( amenidadId, membresiaId, 'DELETE', function( error, result ) {

            });
        },
        error: function(xhr, status, error) {
            if ( error === 'Not Found') {
                setAmenidad( amenidadId, membresiaId, 'PUT', function( error, result ) {
                    
                });
            }
        }
    });
}

function setAmenidad( amenidadId, membresiaId, method, cb ) {
    $.ajax({
        type: method,
        url: `${endPoint}/Membresia/${membresiaId}/amenidades/rel/${amenidadId}`,
        success: function (data) {
            return cb(null, data);
            
        },
        error: function(xhr, status, error) {
            return cb(error);
        }
    });
}