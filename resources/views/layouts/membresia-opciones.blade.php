    <a  style="cursor:pointer;" data-toggle="modal" data-target="#exampleModalLabel-{{$index}}">
        <i style="color:#FFD700;"class="fa fa-2x fa-usd pull-right">
        </i>
    </a>
    <a  href="/amenidades/{{ $membresia->id }}">
        <i class="fa fa-2x fa-bicycle pull-right"></i>
    </a>
    <a  href="/disponibilidad/{{ $membresia->id }}">
        <i class="fa fa-2x fa-calendar-check-o pull-right"></i>
    </a>
    <a  href="/guardar-imagenes/{{ $membresia->id }}">
        <i class="fa fa-2x fa-image pull-right">
        </i>
    </a>
    <a  href="/mi-cuenta/membresia-ubicacion/{{ $membresia->id }}">
        <i class="fa fa-2x fa-map pull-right">
        </i>
    </a>
    <a  style="cursor:pointer;color:#0275d8;"  onclick="publish('{{ $membresia->id }}', 'BAJA')">
        <i class="fa fa-2x fa-remove pull-right">
        </i>
    </a>
    <a  href="/edit-membresia/{{ $membresia->id }}">
        <i class="fa fa-2x fa-edit pull-right"></i>
    </a>
    <a  style="cursor:pointer;color:#0275d8;" onclick="publish('{{ $membresia->id }}', 'DETENIDO')">
        <i class="fa fa-2x fa-pause pull-right">
        </i>
    </a>
    <a  style="cursor:pointer;color:#0275d8;" onclick="publish('{{ $membresia->id }}', 'PUBLICADO')">
        <i class="fa fa-2x fa-play pull-right">
        </i>
    </a>