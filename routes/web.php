<?php

// HOME
Route::get('/', 'HomeController@index')->name('home');
Route::post('/searchFromHome', 'HomeController@search');

// SUPER USER
Route::get('/controlpanel', 'SuperUserController@index');
Route::get('/su-login', 'SuperUserController@create');
Route::post('/su-login', 'SuperUserController@store');

// SESSION
Route::get('/login', 'SessionsController@create');
Route::post('/login', 'SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

// REGISTRATION
Route::get('/signup', 'RegistrationController@create');
Route::post('/signup', 'RegistrationController@store');

// USER
Route::get('/mis-datos', 'UserController@edit');
Route::get('/cambiar-contrasena', 'UserController@editPassword');
Route::put('/guardar-datos', 'UserController@update');
Route::post('/guardar-contrasena', 'UserController@updatePassword');
Route::get('/mis-membresias', 'UserController@showMembresias');
Route::get('/mis-favoritos', 'UserController@showFavoritos');
Route::post('/store-message', 'UserController@storeMessage');
Route::get('/mis-mensajes', 'UserController@correos');
Route::get('/membresia-mensajes/{id}', 'UserController@membresiaMensajes');

// CORREO
Route::post('/contact-owner', 'CorreoController@contactOwner');
Route::post('/contact-sender', 'CorreoController@contactSender');

// MEMBRESIAS
Route::get('/new-membresia', 'MembresiaController@create');
Route::post('/new-membresia', 'MembresiaController@store');
Route::get('/membresia/{titulo}/{id}', 'MembresiaController@show');
Route::get('/edit-membresia/{id}', 'MembresiaController@edit');
Route::put('/update-membresia', 'MembresiaController@update');
Route::get('/mi-cuenta/membresia-ubicacion/{id}','MembresiaController@setLocation');
Route::get('/disponibilidad/{id}','MembresiaController@createDisponibilidad');
Route::post('/saveDisponibilidad','MembresiaController@saveDisponibilidad');
Route::get('/amenidades/{id}','MembresiaController@createAmenidad');

// MEMBRESIAS->IMAGENES
Route::get('/guardar-imagenes/{membresia}', 'MembresiaController@createImage');
Route::post('/save-image', 'MembresiaController@storeImage')->name('saveImage');

// PROMOCIONES
Route::get('/promociones', 'PromocionController@index');
Route::get('/promociones/{titulo}/{id}', 'PromocionController@show');
Route::get('/promocion/create', 'PromocionController@create');
Route::post('/promocion', 'PromocionController@store');
Route::get('/edit-promocion/{id}', 'PromocionController@edit');
Route::put('/save-promocion', 'PromocionController@update');
Route::get('/guardar-imagenes-promocion/{id}', 'PromocionController@createImage');
Route::post('/save-image-promocion', 'PromocionController@storeImage')->name('saveImagePromocion');

// BUSQUEDA
Route::get('/busqueda', 'BusquedaController@index');

// EMAIL
Route::get('/verifyEmail/{id}', 'EmailController@verify');

// VENTA SEARCH
Route::get('/ventas/{titulo}/{init}/{final}', 'VentaSearchController@show');

// RENTA SEARCH
Route::get('/rentas/{titulo}/{init}/{final}', 'RentaSearchController@show');

// DESTACADO SEARCH
Route::get('/recomendados/{titulo}/{init}/{final}', 'DestacadoSearchController@show');


// RESET PASSWORD
Route::get('/reset-password/{access_token}', 'ResetPasswordApiController@index');
Route::post('/save-reseted-password', 'ResetPasswordApiController@store');
Route::post('/send-confirmation-password', 'ResetPasswordApiController@send');

Route::get('/cambio-de-contrasena', function() {
    return view('cambio-de-contrasena');
});


Route::get('/condiciones-de-uso', function () {
    return view('condiciones-de-uso');
});
Route::get('/acerca-de-nosotros', function () {
    return view('acerca-de-nosotros');
});
Route::get('/contacto', function () {
    return view('contacto');
});
Route::get('/politicas-de-privacidad', function () {
    return view('politicas-de-privacidad');
});
Route::get('/preguntas-frecuentes-sobre-tiempos-compartidos', function () {
    return view('preguntas-frecuentes-sobre-tiempos-compartidos');
});

Route::get('/mi-cuenta', function () {
    return view('mi-cuenta');
});

Route::get('/listados', function () {
    return view('listados');
});
Route::get('/listados/{categoria}/{titulo}', function () {
    return view('listados-categoria');
});
Route::get('/listados/{categoria}/{subcategoria}/{titulo}', function () {
    return view('listados-detail');
});
Route::get('/concepto-de-tiempo-compartido', function () {
    return view('concepto-de-tiempo-compartido');
});






