<header class="encabezado navbar-fixed-top" role="banner" id="encabezado">
    <div class="container">
        <a href="/" class="logo text-white" style="text-decoration:none">
            <span class="hidden-md-up"><figure class="img"><img src="assets/img/logo_nb.png" alt="www.tiempocompartido.com"></figure></span>
            <span class="hidden-md-down"><figure class="img"><img src="assets/img/logo_nw.png" alt="www.tiempocompartido.com"></figure></span>
        </a>
        <button type="button" class="boton-buscar hidden-md-up" data-toggle="collapse" data-target="#menu-principal" aria-expanded="false">
            <i class="fa fa-bars" aria-hidden="true"></i></button>
        <nav id="menu-principal" class="collapse">
        @if(Session::has('SUPER_USER'))
            <ul>
                <li><a href="/promocion/create" class="border-rigth pr-0 pl-0"><i  class="fa fa-star"></i> Agregar promoción</a></li>
                <li><a href="/logout"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>             
            </ul>  
        @else
            <ul>
                <li><a href="/busqueda" class="border-rigth pr-0 pl-0"><i  class="fa fa-search"></i> Búsqueda</a></li>
                <li><a href="/recomendados/tiempos-compartidos-recomendados/0/2" class="border-rigth pr-0 pl-0"><i  class="fa fa-thumbs-o-up"></i> Recomendados</a></li>
                <li><a href="/ventas/tiempos-compartidos-en-venta/0/2" class="border-rigth pr-0 pl-0"><i  class="fa fa-money"></i> Venta</a></li>
                <li><a href="/rentas/tiempos-compartidos-en-renta/0/2" class="border-rigth pr-0 pl-0"><i  class="fa fa-ticket"></i> Renta</a></li>
                <li><a href="/promociones" class="border-rigth pr-0 pl-0"><i  class="fa fa-star"></i> Promociones</a></li>
                <li><a href="/listados" class="border-rigth pr-0 pl-0"><i  class="fa fa-list"></i> Listados</a></li>
                @if(!Session::has('ACCESS_TOKEN'))
                    <li><a href="/login" class="border-rigth pr-0 pl-0"> Ingresa </a></li>
                    <li><a href="/signup" class="border-rigth pr-0 pl-0">Regístrate</a></li>
                @else
                    <li><a href="/mi-cuenta" class="border-rigth pr-0 pl-0">Mi cuenta <span class="caret"></span></a></li>
                    <li><a href="/logout"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
                @endif    
            </ul>
        @endif
        </nav>
    </div>
</header>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <li data-target="#myCarousel" data-slide-to="3"></li>
        {{--  <li data-target="#myCarousel" data-slide-to="4"></li>  --}}
      </ol>
      <div class="carousel-inner" >
        <div class="carousel-item active bienvenidos" style="background: url('../assets/img/slide-4.jpg') no-repeat center top;">
          <img class="first-slide img-responsive responsive-tiempo"/>
          <div class="container">
            <div class="carousel-caption d-none d-md-block text-left" style="bottom:9rem;">
                {{--  <div class="row">  --}}
                    {{--  <div class="col-md-"></div>                  --}}
                    {{--  <div  style="width: 50%; margin: 0 auto;">  --}}
                        <h1 class="hidden-sm-down  display-4"> Visita lugares increíbles y crea recuerdos inolvidables</h1>
                        <h1 class="hidden-md-up"> Visita lugares increíbles y crea recuerdos inolvidables</h1>
                        <ul class="hidden-sm-down" style="list-style-type: none;">
                            Cómodas y Espaciosas Suites, Condominios y Villas para toda la familia.
                            Exclusividad y menor costo que reservar varios cuartos de hotel.
                            Ahorra en el costo de tus próximas vacaciones familiares.
                            Conoce las ventajas y experiencias de los mismos propietarios y sus familias.
                        </ul>
                        <a class="hidden-sm-down btn btn-lg btn-primary mt-1" href="/rentas/tiempos-compartidos-en-renta/0/2" role="button">Tiempos Compartidos en Alquiler</a>
                        <a class="hidden-md-up btn btn-lg btn-primary mt-1" style="font-size: .9rem;" href="/rentas/tiempos-compartidos-en-renta/0/2" role="button">Tiempos Compartidos en Alquiler</a>
                    {{--  </div>                
                </div>                  --}}
            </div>
          </div>
        </div>
        <div class="carousel-item bienvenidos" style="background: url('../assets/img/slide-3.jpg') no-repeat center top;">
          <img class="second-slide responsive-tiempo">                
          <div class="container">
            <div class="carousel-caption d-none d-md-block text-right">
              <h1 class="hidden-sm-down  display-4">Ahorra en el costo de tus futuras vacaciones</h1>
              <h1 class="hidden-md-up">Ahorra en el costo de tus futuras vacaciones</h1>
              <ul class="hidden-sm-down" style="list-style-type: none;"> 
                <li>Únete a más de 20 millones de propietarios mundialmente.</li>
                <li>Garantízale a tu familia vacaciones de calidad y un mundo de posibilidades.</li>
                <li>Sin intermediación ni pagar comisiones. Trato directo con los propietarios.</li>
                <li>Negocia el mejor precio.</li>
              </ul> 
              <a class="hidden-sm-down btn btn-lg btn-primary mt-1" href="/ventas/tiempos-compartidos-en-venta/0/2" role="button">Tiempos Compartidos en Venta</a>
              <a class="hidden-md-up btn btn-lg btn-primary mt-1" style="font-size: .9rem;"  href="/ventas/tiempos-compartidos-en-venta/0/2" role="button">Tiempos Compartidos en Venta</a>
              
            </div>
          </div>
        </div>
        <div class="carousel-item bienvenidos" style="background: url('../assets/img/cover-home.jpg') no-repeat center top;">
          <img class="second-slide responsive-tiempo">
          <div class="container">
            <div class="carousel-caption d-none d-md-block">
                <h1 class="hidden-sm-down display-4">Vende o Alquila tu Tiempo Compartido GRATIS!</h1>
                <h1 class="hidden-md-up">Vende o Alquila tu Tiempo Compartido GRATIS!</h1>
                <ul class="hidden-sm-down" style="list-style-type: none;">
                    <li>Crea y Modifica Fácilmente tu Publicación.</li>
                    <li>Responde las preguntas y mensajes privados de los usuarios.</li>
                    <li>Comparte tus experiencias con los interesados en tu publicación.</li>
                    <li>Suspende temporalmente tu publicación sin perder tus datos, fácil de usar.</li>
                </ul>
                {{--  <p><a class="btn btn-lg btn-primary mt-1" href="#" role="button">Planes de publicación</a></p>  --}}
                @if(!Session::has('ACCESS_TOKEN'))
                    <p><a class="btn btn-lg btn-primary mt-1" href="/signup" role="button">Registrate ahora mismo</a></p>
                @endif
            </div>
          </div>
        </div>
        <div class="carousel-item bienvenidos" style="background: url('../assets/img/slide-5.jpg') no-repeat center top;">
          <img class="second-slide responsive-tiempo">
          <div class="container">
            <div class="carousel-caption d-none d-md-block text-right">
                <h1 class="hidden-sm-down display-4">Promueve tu programa Fly&Buy o Net-Center</h1>
                <h1 class="hidden-md-up">Promueve tu programa Fly&Buy o Net-Center</h1>
                <ul class="hidden-sm-down" class="mt-1 text-right" style="list-style-type: none;">
                     <li>Clientes reales e interesados en Tiempos Compartidos.</li>
                     <li>Banners, links, encuestas de perfil y pre-calificación.</li>
                     <li>Exposición inigualable en la red! Más de 78,000 visitas los últimos 12 meses!</li>
                     <li>Desde 1998, promoviendo la industria uniendo Vacacionistas y Propietarios.</li>
                </ul>
                {{--  <p><a class="btn btn-lg btn-primary mt-1" href="#" role="button">Cotizar un Plan Promocional</a></p>  --}}
            </div>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>