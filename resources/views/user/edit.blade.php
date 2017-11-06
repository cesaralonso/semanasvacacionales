@extends('layouts.master')
@section('content')  
        <section class="ruta py-1" id="inicia">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 text-xs-right">
                        <a href="/">Inicio</a> » <a href="/mi-cuenta">Mi cuenta</a> » Mis datos
                    </div>
                </div>
            </div>
        </section>

        <section class="py-1">   
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-xl-4">
                        @include('layouts.menu-cuenta')
                    </div>
                    <div class="col-md-7 col-xl-8"> 
                        <div class="container padding">
                            <h2 class="title margin-bottom">Modifica tus datos</h2>


                            <form name="personForm" method="POST" action="/guardar-datos" role="form" class="ng-pristine ng-invalid ng-invalid-required ng-valid-email">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-control-default required">
                                            <label>Usuario ó Compañia</label>
                                            <input id="nickname" name="nickname" value="{{ isset($user->nickname) ? $user->nickname : '' }}" type="text" class="form-control ng-pristine ng-untouched ng-invalid ng-invalid-required" placeholder="Nombre" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-control-default required">
                                    <label>Email</label>
                                    <input id="email" name="email" value="{{ isset($user->email) ? $user->email : '' }}" type="email" class="form-control ng-pristine ng-untouched ng-valid-email ng-invalid ng-invalid-required" placeholder="Email" required="">
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-control-default required">
                                            <label>Nombre completo del titular de esta cuenta</label>
                                            <input id="name" name="name" value="{{ isset($user->name) ? $user->name : '' }}" type="text" class="form-control ng-pristine ng-untouched ng-invalid ng-invalid-required" placeholder="Nombre" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-control-default">
                                            <label>Datos ó información extra</label>
                                            <textarea id="informacion" name="informacion" class="form-control ng-pristine ng-valid ng-touched" placeholder="Informacion adicional acerca de la empresa o usuario">{{ isset($user->informacion) ? $user->informacion : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-control-default">
                                            <label>Teléfono</label>
                                            <input id="telefono" name="telefono" value="{{ isset($user->telefono) ? $user->telefono : '' }}" type="text" class="form-control ng-pristine ng-untouched ng-valid" placeholder="Lada + 10 Digitos" >
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-control-default required">
                                        <label>Pais</label>
                                        {{--  <input id="pais" name="pais" value="{{ isset($user->pais) ? $user->pais : '' }}" type="text" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" placeholder="Residencia">  --}}
                                            @if (isset($paises))
                                                {{ Form::select('pais', $paises, 
                                                    pv($user, 'pais'), [
                                                        'class'    => 'form-control',
                                                        'id'       => 'pais',
                                                        'onchange'       => 'setLocalidadesUser()'
                                                    ])
                                                }}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-control-default required ciudadNombre-user-select">
                                            <label>Ciudad</label>
                                            {{--  <select id="ciudad" name="ciudad" class="form-control" list="locations">
                                                <optgroup label="Argentina"><option value="Bariloche">Bariloche</option><option value="Buenos Aires">Buenos Aires</option><option value="Cabalango">Cabalango</option><option value="Capital Federal">Capital Federal</option><option value="Carlos Paz">Carlos Paz</option><option value="Caviahue">Caviahue</option><option value="Chapadmalal">Chapadmalal</option><option value="Costa Del Este">Costa Del Este</option><option value="Las Grutas">Las Grutas</option><option value="Las Le&amp;ntilde;as">Las Leñas</option><option value="Maipu">Maipu</option><option value="Malargue">Malargue</option><option value="Mar Del Plata">Mar Del Plata</option><option value="Pinamar">Pinamar</option><option value="San Bernardo">San Bernardo</option><option value="San Carlos De Bariloche">San Carlos De Bariloche</option><option value="San Carolos De Bariloche">San Carolos De Bariloche</option><option value="San Martin De Los Andes">San Martin De Los Andes</option><option value="Villa Carlos Paz">Villa Carlos Paz</option><option value="Villa La Angostura">Villa La Angostura</option></optgroup><optgroup label="Aruba"><option value="Aruba">Aruba</option><option value="Aruba-oranjestad">Aruba-oranjestad</option><option value="Eagle Beach">Eagle Beach</option><option value="Oranjestad">Oranjestad</option></optgroup><optgroup label="Belice"><option value="Cayo Ambergris">Cayo Ambergris</option></optgroup><optgroup label="Brasil"><option value="Buzios">Buzios</option><option value="Fortaleza">Fortaleza</option><option value="Porto Belo">Porto Belo</option></optgroup><optgroup label="Canada"><option value="Whistler">Whistler</option></optgroup><optgroup label="Chile"><option value="Con Con">Con Con</option><option value="Pucon">Pucon</option><option value="Re&amp;ntilde;aca">Reñaca</option><option value="Santiago">Santiago</option><option value="Vi&amp;ntilde;a Del Mar">Viña Del Mar</option><option value="Villarrica">Villarrica</option></optgroup><optgroup label="Colombia"><option value="Baq">Baq</option><option value="Bogota">Bogota</option><option value="Cartagena">Cartagena</option><option value="Santa Marta">Santa Marta</option></optgroup><optgroup rica="" label="Costa"><option value="10 Minutos De El Coco">10 Minutos De El Coco</option><option value="Alajuela">Alajuela</option><option value="Carrillo">Carrillo</option><option value="El Roble">El Roble</option><option value="El Roble Puntarenas">El Roble Puntarenas</option><option value="Guanacaste">Guanacaste</option><option value="La Cruz">La Cruz</option><option value="Liberia">Liberia</option><option value="Nicoya">Nicoya</option><option value="Playa Hermosa">Playa Hermosa</option><option value="Playas Del Coco">Playas Del Coco</option><option value="Puntarenas">Puntarenas</option><option value="Santa Cruz Gte.">Santa Cruz Gte.</option></optgroup><optgroup label="Ecuador"><option value="Gal&amp;aacute;pagos">Galápagos</option><option value="Salinas">Salinas</option></optgroup><optgroup label="España"><option value="Alfas Del Pi  Alicante">Alfas Del Pi  Alicante</option><option value="Alicante">Alicante</option><option value="Almeria">Almeria</option><option value="Benalmadena">Benalmadena</option><option value="Benalmadena-malaga">Benalmadena-malaga</option><option value="Cambrils">Cambrils</option><option value="Denia">Denia</option><option value="Gran Canaria">Gran Canaria</option><option value="Ibiza">Ibiza</option><option value="La Manga Del Mar Menor">La Manga Del Mar Menor</option><option value="Madrid">Madrid</option><option value="Malaga">Malaga</option><option value="Malaga - Benalmadena Costa">Malaga - Benalmadena Costa</option><option value="Mijas Costa Malaga">Mijas Costa Malaga</option><option value="Mostoles">Mostoles</option><option value="Oropesa Del Mar (castellon)">Oropesa Del Mar (castellon)</option><option value="Pe&amp;ntilde;iscola">Peñiscola</option><option value="Pe&amp;ntilde;iscola(castellon)">Peñiscola(castellon)</option><option value="Salou">Salou</option><option value="Salou Tarragona">Salou Tarragona</option><option value="Santa Cruz De Tenerife">Santa Cruz De Tenerife</option><option value="Tenerife">Tenerife</option><option value="Torrevieja(alicante)">Torrevieja(alicante)</option></optgroup><optgroup unidos="" label="Estados"><option value="Breckenridge">Breckenridge</option><option value="Canyon Lake">Canyon Lake</option><option value="Cleremont">Cleremont</option><option value="Fairfield Bay">Fairfield Bay</option><option value="Fort Lauderdale">Fort Lauderdale</option><option value="Fourt Laudardele">Fourt Laudardele</option><option value="Isla Del Padre">Isla Del Padre</option><option value="Kissimmee">Kissimmee</option><option value="Lake Buena Vista">Lake Buena Vista</option><option value="Las Vegas">Las Vegas</option><option value="Manhattan">Manhattan</option><option value="Miami">Miami</option><option value="Orlando">Orlando</option><option value="Pompano Beach">Pompano Beach</option><option value="Rio Grande">Rio Grande</option><option value="South Padre Island-isla Del Padre">South Padre Island-isla Del Padre</option><option value="Vail">Vail</option><option value="Waikoloa">Waikoloa</option><option value="Weston">Weston</option></optgroup><optgroup label="Jamaica"><option value="Main Street">Main Street</option></optgroup><optgroup label="Martinique"></optgroup><optgroup label="Mexico"><option value="Acapulco">Acapulco</option><option value="Acapulco Diamante">Acapulco Diamante</option><option value="Cabo San Lucas">Cabo San Lucas</option><option value="Cacun">Cacun</option><option value="Canc&amp;uacute;n">Cancún</option><option value="Chihuahua">Chihuahua</option><option value="Ciudad De Mexico">Ciudad De Mexico</option><option value="Coacalco">Coacalco</option><option value="Congregacion Canoas">Congregacion Canoas</option><option value="Cordoba">Cordoba</option><option value="Coyoacan">Coyoacan</option><option value="Cozumel">Cozumel</option><option value="Cuautitlan Izcalli">Cuautitlan Izcalli</option><option value="Cuernavaca">Cuernavaca</option><option value="Distrito Federal">Distrito Federal</option><option value="Durango">Durango</option><option value="Guadalajara">Guadalajara</option><option value="Hermosillo">Hermosillo</option><option value="Irapuato">Irapuato</option><option value="Ixtapa">Ixtapa</option><option value="Ixtapa Zihuatanejo">Ixtapa Zihuatanejo</option><option value="Jalisco">Jalisco</option><option value="Juarez">Juarez</option><option value="Leon">Leon</option><option value="Los Cabos">Los Cabos</option><option value="Manzanillo">Manzanillo</option><option value="Mazatl&amp;aacute;n">Mazatlán</option><option value="MazatlÃ&nbsp;n">MazatlÃ&nbsp;n</option><option value="Mexicali">Mexicali</option><option value="Mexico">Mexico</option><option value="Monterrey">Monterrey</option><option value="Morelia">Morelia</option><option value="P. Pe&amp;ntilde;aco">P. Peñaco</option><option value="Para Ser Usado En Cualquier Desarrollo De Royal Holiday Club">Para Ser Usado En Cualquier Desarrollo De Royal Holiday Club</option><option value="Places In Mexico">Places In Mexico</option><option value="Playa Del Carmen">Playa Del Carmen</option><option value="Puerto Morelos">Puerto Morelos</option><option value="Puerto Pe&amp;ntilde;asco">Puerto Peñasco</option><option value="Puerto Vallarta">Puerto Vallarta</option><option value="Queretaro">Queretaro</option><option value="Rio Lagartos">Rio Lagartos</option><option value="Riviera Maya">Riviera Maya</option><option value="Salamanca">Salamanca</option><option value="San Jose Del Cabo">San Jose Del Cabo</option><option value="San Luis Potosi">San Luis Potosi</option><option value="Santiago N.l.">Santiago N.l.</option><option value="Solidaridad">Solidaridad</option><option value="Talquepaque">Talquepaque</option><option value="Tapachula">Tapachula</option><option value="Tequesquitengo">Tequesquitengo</option><option value="Tequisqiapan">Tequisqiapan</option><option value="Tlalnepantla">Tlalnepantla</option><option value="Varios Destinos">Varios Destinos</option><option value="Varios Sitios">Varios Sitios</option><option value="Venustiano Carranza">Venustiano Carranza</option><option value="Villahermosa">Villahermosa</option><option value="Zapopan">Zapopan</option></optgroup><optgroup dominicana="" label="Republica"><option value="Bavaro">Bavaro</option><option value="Bavaro-punta Cana">Bavaro-punta Cana</option><option value="Bayahibe">Bayahibe</option><option value="Higuey">Higuey</option><option value="Higuey - Punta Cana">Higuey - Punta Cana</option><option value="Playa Bavaro">Playa Bavaro</option><option value="Punta Cana">Punta Cana</option><option value="Punta Cana (playa Bavaro)">Punta Cana (playa Bavaro)</option></optgroup><optgroup label="Uruguay"><option value="Punta Del Este">Punta Del Este</option><option value="Solanas">Solanas</option></optgroup><optgroup label="Venezuela"><option value="Margarita">Margarita</option><option value="Pampatar">Pampatar</option><option value="Pampatar/ Isla Margarita">Pampatar/ Isla Margarita</option><option value="Porlamar">Porlamar</option></optgroup>
                                            </select>  --}}
                                            @if (isset($localidades))
                                                {{ Form::select('ciudad', $localidades, 
                                                    pv($user, 'ciudad'), [
                                                        'class'    => 'form-control ciudadNombre-select',
                                                        'id'       => 'ciudad',
                                                    ])
                                                }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-control-default required">
                                            <label>Mis datos visibles?</label>
                                            <select id="datosVisibles" name="datosVisibles" class="form-control ng-pristine ng-invalid ng-invalid-required ng-touched" required="">
                                                @if( isset($user->datosVisibles) )
                                                    @if( $user->datosVisibles )
                                                        <option value="0" >No</option>
                                                        <option value="1" selected>Si</option>
                                                    @else
                                                        <option value="0" selected>No</option>
                                                        <option value="1" >Si</option>
                                                    @endif
                                                @else
                                                    <option value="0" selected>No</option>
                                                    <option value="1" >Si</option>
                                                @endif
                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-control-default">
                                            <label>Lenguajes</label>
                                            <textarea id="lenguaje" name="lenguaje" class="form-control ng-pristine ng-valid ng-touched" placeholder="Separados por coma">{{ isset($user->lenguaje) ? $user->lenguaje : '' }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-control-default">
                                            <label>Destinos de tu interes</label>
                                            <input id="destinosInteres" name="destinosInteres"value="{{ isset($user->destinosInteres) ? $user->destinosInteres : '' }}" type="text" class="form-control ng-pristine ng-untouched ng-valid" placeholder="Separados por comas">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-control-default">
                                            <label>Ingrese password para confirmar cambios</label>
                                            <input id="password" name="password" type="password" class="form-control"  required>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary btn-xl pull-right" >
                                                <i class="ace-icon fa fa-user"></i>
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection