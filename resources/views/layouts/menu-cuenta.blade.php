<h1 class="title margin-bottom">
    Mis datos
</h1>
<div class="list-group">
    <a class="list-group-item tiempocompartido-list">
        Tus opciones en tiempo compartido
    </a>
    
    <a href="/mis-datos" class="list-group-item list-group-item-action tiemplocompartido-list-active {{ \Request::is('mis-datos') ? 'active': ''}}"><i class="fa fa-user"></i> Mis datos</a>
    @if( Session::has('USER_TYPE') && Session::get('USER_TYPE') == 'PROPIETARIO')
        <a href="/mis-membresias" class="list-group-item list-group-item-action tiemplocompartido-list-active {{ \Request::is('mis-membresias') ? 'active': ''}}"><i class="fa fa-home"></i> Mis membresias</a>
    @endif
    <a href="/mis-favoritos" class="list-group-item list-group-item-action tiemplocompartido-list-active {{ \Request::is('mis-favoritos') ? 'active': ''}}"><i class="fa fa-heart"></i> Mi lista de favoritos</a>
    <a href="/mis-mensajes" class="list-group-item list-group-item-action tiemplocompartido-list-active {{ \Request::is('mis-mensajes') ? 'active': ''}}"><i class="fa fa-envelope"></i> Mis mensajes</a>
    <a href="/cambiar-contrasena" class="list-group-item list-group-item-action tiemplocompartido-list-active {{ \Request::is('cambiar-contrasena') ? 'active': ''}}"><i class="fa fa-key"></i> Cambiar mi contraseña</a>
</div>