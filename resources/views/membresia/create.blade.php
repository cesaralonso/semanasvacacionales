@extends('layouts.master')
@section('content')
    <div class="container padding">
    <h1>Publica tu membresia</h1>    
    <form method="POST" action="/new-membresia" name="membresiaForm" class="form-horizontal padding" role="form">
        {{csrf_field()}}

        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="email"> Título </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="text" class="form-control" id="titulo"name="titulo" required/>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="email"> Título (Inglés) </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text" class="form-control" id="title"name="title" />
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="email"> Nombre del Club </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text" class="form-control" placeholder="" id="clubNombre"name="clubNombre" required/>
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="email"> URL del Club </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text" class="form-control" id="clubUrl" name="clubUrl" />
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="email"> Tipo de semana </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control" placeholder="" id="semanaTipo"name="semanaTipo" required>
                            <option value="FIJA">Fija</option>
                            <option value="FLOTANTE">Flotante</option>
                            <option value="PUNTOS">Puntos</option>
                            <option value="NOCHES">Noches</option>
                        </select>
                    </span>
                </div>
            </div>
        </div>
        <div id="cualSemanaFijaDiv" class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="cualSemanaFija"> ¿Cuál Semana Fija? </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="number" class="form-control" min="1" step="1" max="52" id="cualSemanaFija"name="cualSemanaFija"  />
                    </span>
                </div>
            </div>
        </div>
        <div style="display: none;" id="cualTemporadaflotanteDiv" class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="cualTemporadaflotante"> ¿Cuál Temporada flotante? </label>
                <div class="col-sm-7">
                <span class="block input-icon input-icon-right">
                    <select class="form-control" placeholder="" id="cualTemporadaflotante"name="cualTemporadaflotante" >
                        <option value="ALTA">Alta</option>
                        <option value="BAJA">Baja</option>
                    </select>
                    </span>
                </div>
            </div>
        </div>
        <div style="display: none;" id="cuantosPuntosDiv" class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="cuantosPuntos"> ¿Cuántos Puntos? </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="number" class="form-control" id="cuantosPuntos" name="cuantosPuntos" min="1" />
                    </span>
                </div>
            </div>
        </div>
        <div style="display: none;" id="cuantasNochesDiv" class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="cuantasNoches"> ¿Cuantas Noches? </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="number" class="form-control" id="cuantasNoches" name="cuantasNoches" min="1" max="20" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="email"> Descripción </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text" class="form-control" id="descripcion" name="descripcion" required/>
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="description"> Descripción (Inglés) </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text" class="form-control"  id="description" name="description" />
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="sala"> Sala </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="checkbox" class="form-control" id="sala" name="sala" />
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="dormitorios"> Dormitorios </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="number" class="form-control" placeholder="" id="dormitorios"name="dormitorios" min="1" max="15"/>
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="lockOff"> Lock Off </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="checkbox" class="form-control"  id="lockOff" name="lockOff" />
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="tipoInmueble"> Tipo de inmueble </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <select class="form-control" placeholder="" id="tipoInmueble"name="tipoInmueble" required>
                    @if(isset($unidades))
                        @foreach($unidades as $unidad)
                            <option value="{{ $unidad->nombre }}">{{ $unidad->descripcion}}</option>
                        @endforeach
                    @endif
                </select>
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="banosCompletos"> Baños Completos </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="number" class="form-control" id="banosCompletos" name="banosCompletos" min="1" max="15" />
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="banosMedios"> Baños Medios </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="number" class="form-control" placeholder="" id="banosMedios" name="banosMedios" min="1" max="15" />
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="tipoCocina"> Tipo de Cocina </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control" id="tipoCocina" name="tipoCocina" >
                            <option value="COMPLETA">Cocina Completa</option>
                            <option value="MEDIANA">Cocina Mediana</option>
                            <option value="CHICA">Cocina Chica</option>
                        </select>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="maxOcupantes"> Máximo de Ocupantes </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="number" class="form-control"  id="maxOcupantes" name="maxOcupantes" min="1" max="15" required/>
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="maxPrivacidad"> Máximo con Privacidad </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="number" class="form-control" id="maxPrivacidad" name="maxPrivacidad" min="1" max="15" required/>
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="numCamas"> Número de camas (ind/mat/king) </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="number" class="form-control" id="numCamas" id="numCamas" name="numCamas" min="1" max="15"/>
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="frecSemanasPorAnio"> ¿Cuántas Semanas Por Año? </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="number" class="form-control" min="1" max="10" step="1" placeholder="" id="frecSemanasPorAnio" name="frecSemanasPorAnio" min="1" max="15" />
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="frecCadaAnios"> ¿Cada Cuantos Años? </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <select class="form-control" placeholder="frecCadaAnios" id="frecCadaAnios" name="frecCadaAnios">
                    <option value="UNO">Cada Año</option>
                    <option value="DOS">Cada 2 años</option>
                    <option value="NONES">Años nones</option>
                    <option value="PARES">Años pares</option>
                </select>
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="localidadNombre"> Destino, Ciudad y Pais </label>
            <div class="col-sm-3">     
                <span class="block input-icon input-icon-right">
                <select class="form-control pais-select-membresia" placeholder="Pais" id="idPais" name="idPais" onchange="setLocalidadesMembresia()">
                    @if (isset($paises))
                        <option value=""> Selecciona un país </option>
                        @foreach($paises as $pais)
                            <option value="{{ $pais->id}}"> {{ $pais->nombre }} </option>
                        @endforeach
                    @endif
                </select>
                </span>
            </div>
            <div class="col-sm-4">
                <span class="block input-icon input-icon-right localidad-select" id="localidad-select">
                    {{--  <input  name="localidadNombre" type="text" class="form-control" placeholder="Destino, Ciudad" list="localidadNombre" required>
                    <datalist id="localidadNombre" >
                        <optgroup label="Argentina"><option value="Bariloche">Bariloche</option><option value="Buenos Aires">Buenos Aires</option><option value="Cabalango">Cabalango</option><option value="Capital Federal">Capital Federal</option><option value="Carlos Paz">Carlos Paz</option><option value="Caviahue">Caviahue</option><option value="Chapadmalal">Chapadmalal</option><option value="Costa Del Este">Costa Del Este</option><option value="Las Grutas">Las Grutas</option><option value="Las Le&amp;ntilde;as">Las Leñas</option><option value="Maipu">Maipu</option><option value="Malargue">Malargue</option><option value="Mar Del Plata">Mar Del Plata</option><option value="Pinamar">Pinamar</option><option value="San Bernardo">San Bernardo</option><option value="San Carlos De Bariloche">San Carlos De Bariloche</option><option value="San Carolos De Bariloche">San Carolos De Bariloche</option><option value="San Martin De Los Andes">San Martin De Los Andes</option><option value="Villa Carlos Paz">Villa Carlos Paz</option><option value="Villa La Angostura">Villa La Angostura</option></optgroup><optgroup label="Aruba"><option value="Aruba">Aruba</option><option value="Aruba-oranjestad">Aruba-oranjestad</option><option value="Eagle Beach">Eagle Beach</option><option value="Oranjestad">Oranjestad</option></optgroup><optgroup label="Belice"><option value="Cayo Ambergris">Cayo Ambergris</option></optgroup><optgroup label="Brasil"><option value="Buzios">Buzios</option><option value="Fortaleza">Fortaleza</option><option value="Porto Belo">Porto Belo</option></optgroup><optgroup label="Canada"><option value="Whistler">Whistler</option></optgroup><optgroup label="Chile"><option value="Con Con">Con Con</option><option value="Pucon">Pucon</option><option value="Re&amp;ntilde;aca">Reñaca</option><option value="Santiago">Santiago</option><option value="Vi&amp;ntilde;a Del Mar">Viña Del Mar</option><option value="Villarrica">Villarrica</option></optgroup><optgroup label="Colombia"><option value="Baq">Baq</option><option value="Bogota">Bogota</option><option value="Cartagena">Cartagena</option><option value="Santa Marta">Santa Marta</option></optgroup><optgroup rica="" label="Costa"><option value="10 Minutos De El Coco">10 Minutos De El Coco</option><option value="Alajuela">Alajuela</option><option value="Carrillo">Carrillo</option><option value="El Roble">El Roble</option><option value="El Roble Puntarenas">El Roble Puntarenas</option><option value="Guanacaste">Guanacaste</option><option value="La Cruz">La Cruz</option><option value="Liberia">Liberia</option><option value="Nicoya">Nicoya</option><option value="Playa Hermosa">Playa Hermosa</option><option value="Playas Del Coco">Playas Del Coco</option><option value="Puntarenas">Puntarenas</option><option value="Santa Cruz Gte.">Santa Cruz Gte.</option></optgroup><optgroup label="Ecuador"><option value="Gal&amp;aacute;pagos">Galápagos</option><option value="Salinas">Salinas</option></optgroup><optgroup label="España"><option value="Alfas Del Pi  Alicante">Alfas Del Pi  Alicante</option><option value="Alicante">Alicante</option><option value="Almeria">Almeria</option><option value="Benalmadena">Benalmadena</option><option value="Benalmadena-malaga">Benalmadena-malaga</option><option value="Cambrils">Cambrils</option><option value="Denia">Denia</option><option value="Gran Canaria">Gran Canaria</option><option value="Ibiza">Ibiza</option><option value="La Manga Del Mar Menor">La Manga Del Mar Menor</option><option value="Madrid">Madrid</option><option value="Malaga">Malaga</option><option value="Malaga - Benalmadena Costa">Malaga - Benalmadena Costa</option><option value="Mijas Costa Malaga">Mijas Costa Malaga</option><option value="Mostoles">Mostoles</option><option value="Oropesa Del Mar (castellon)">Oropesa Del Mar (castellon)</option><option value="Pe&amp;ntilde;iscola">Peñiscola</option><option value="Pe&amp;ntilde;iscola(castellon)">Peñiscola(castellon)</option><option value="Salou">Salou</option><option value="Salou Tarragona">Salou Tarragona</option><option value="Santa Cruz De Tenerife">Santa Cruz De Tenerife</option><option value="Tenerife">Tenerife</option><option value="Torrevieja(alicante)">Torrevieja(alicante)</option></optgroup><optgroup unidos="" label="Estados"><option value="Breckenridge">Breckenridge</option><option value="Canyon Lake">Canyon Lake</option><option value="Cleremont">Cleremont</option><option value="Fairfield Bay">Fairfield Bay</option><option value="Fort Lauderdale">Fort Lauderdale</option><option value="Fourt Laudardele">Fourt Laudardele</option><option value="Isla Del Padre">Isla Del Padre</option><option value="Kissimmee">Kissimmee</option><option value="Lake Buena Vista">Lake Buena Vista</option><option value="Las Vegas">Las Vegas</option><option value="Manhattan">Manhattan</option><option value="Miami">Miami</option><option value="Orlando">Orlando</option><option value="Pompano Beach">Pompano Beach</option><option value="Rio Grande">Rio Grande</option><option value="South Padre Island-isla Del Padre">South Padre Island-isla Del Padre</option><option value="Vail">Vail</option><option value="Waikoloa">Waikoloa</option><option value="Weston">Weston</option></optgroup><optgroup label="Jamaica"><option value="Main Street">Main Street</option></optgroup><optgroup label="Martinique"></optgroup><optgroup label="Mexico"><option value="Acapulco">Acapulco</option><option value="Acapulco Diamante">Acapulco Diamante</option><option value="Cabo San Lucas">Cabo San Lucas</option><option value="Cacun">Cacun</option><option value="Canc&amp;uacute;n">Cancún</option><option value="Chihuahua">Chihuahua</option><option value="Ciudad De Mexico">Ciudad De Mexico</option><option value="Coacalco">Coacalco</option><option value="Congregacion Canoas">Congregacion Canoas</option><option value="Cordoba">Cordoba</option><option value="Coyoacan">Coyoacan</option><option value="Cozumel">Cozumel</option><option value="Cuautitlan Izcalli">Cuautitlan Izcalli</option><option value="Cuernavaca">Cuernavaca</option><option value="Distrito Federal">Distrito Federal</option><option value="Durango">Durango</option><option value="Guadalajara">Guadalajara</option><option value="Hermosillo">Hermosillo</option><option value="Irapuato">Irapuato</option><option value="Ixtapa">Ixtapa</option><option value="Ixtapa Zihuatanejo">Ixtapa Zihuatanejo</option><option value="Jalisco">Jalisco</option><option value="Juarez">Juarez</option><option value="Leon">Leon</option><option value="Los Cabos">Los Cabos</option><option value="Manzanillo">Manzanillo</option><option value="Mazatl&amp;aacute;n">Mazatlán</option><option value="MazatlÃ&nbsp;n">MazatlÃ&nbsp;n</option><option value="Mexicali">Mexicali</option><option value="Mexico">Mexico</option><option value="Monterrey">Monterrey</option><option value="Morelia">Morelia</option><option value="P. Pe&amp;ntilde;aco">P. Peñaco</option><option value="Para Ser Usado En Cualquier Desarrollo De Royal Holiday Club">Para Ser Usado En Cualquier Desarrollo De Royal Holiday Club</option><option value="Places In Mexico">Places In Mexico</option><option value="Playa Del Carmen">Playa Del Carmen</option><option value="Puerto Morelos">Puerto Morelos</option><option value="Puerto Pe&amp;ntilde;asco">Puerto Peñasco</option><option value="Puerto Vallarta">Puerto Vallarta</option><option value="Queretaro">Queretaro</option><option value="Rio Lagartos">Rio Lagartos</option><option value="Riviera Maya">Riviera Maya</option><option value="Salamanca">Salamanca</option><option value="San Jose Del Cabo">San Jose Del Cabo</option><option value="San Luis Potosi">San Luis Potosi</option><option value="Santiago N.l.">Santiago N.l.</option><option value="Solidaridad">Solidaridad</option><option value="Talquepaque">Talquepaque</option><option value="Tapachula">Tapachula</option><option value="Tequesquitengo">Tequesquitengo</option><option value="Tequisqiapan">Tequisqiapan</option><option value="Tlalnepantla">Tlalnepantla</option><option value="Varios Destinos">Varios Destinos</option><option value="Varios Sitios">Varios Sitios</option><option value="Venustiano Carranza">Venustiano Carranza</option><option value="Villahermosa">Villahermosa</option><option value="Zapopan">Zapopan</option></optgroup><optgroup dominicana="" label="Republica"><option value="Bavaro">Bavaro</option><option value="Bavaro-punta Cana">Bavaro-punta Cana</option><option value="Bayahibe">Bayahibe</option><option value="Higuey">Higuey</option><option value="Higuey - Punta Cana">Higuey - Punta Cana</option><option value="Playa Bavaro">Playa Bavaro</option><option value="Punta Cana">Punta Cana</option><option value="Punta Cana (playa Bavaro)">Punta Cana (playa Bavaro)</option></optgroup><optgroup label="Uruguay"><option value="Punta Del Este">Punta Del Este</option><option value="Solanas">Solanas</option></optgroup><optgroup label="Venezuela"><option value="Margarita">Margarita</option><option value="Pampatar">Pampatar</option><option value="Pampatar/ Isla Margarita">Pampatar/ Isla Margarita</option><option value="Porlamar">Porlamar</option></optgroup>
                    </datalist>  --}}
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="ubicadoEn"> Donde se encuentra ubicado</label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <select class="form-control" placeholder="" id="ubicadoEn" name="ubicadoEn" required>
                    @if(isset($ubicados))
                        @foreach($ubicados as $ubicado)
                            <option value="{{ pv($ubicado, 'nombre') }}">{{ pv($ubicado, 'descripcion') }}</option>
                        @endforeach
                    @endif
                </select>
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="mantenimiento"> ¿Existe Cuota de Mantenimiento? </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="checkbox" class="form-control" id="mantenimiento" name="mantenimiento"/>
                    </span>
                </div>
            </div>
        </div>
        <div  style="display:none;" class="form-group existeCuotaMantenimiento" style="display:none;">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="mantenimientoImporte"> Importe de Mantenimiento  </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="number" class="form-control" placeholder="mantenimientoImporte" id="mantenimientoImporte" name="mantenimientoImporte"/>
                    </span>
                </div>
            </div>
        </div>
        <div style="display:none;" class="form-group existeCuotaMantenimiento" style="display:none;">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="mantenimientoMoneda"> Moneda para Costo de Mantenimiento  </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control" placeholder="mantenimientoMoneda" id="mantenimientoMoneda" name="mantenimientoMoneda" >
                            <option value="DOLARES AMERICANOS">Dolares americanos</option>
                            <option value="PESOS MEXICANOS">Pesos mexicanos</option>
                            <option value="EUROS">Euros</option>
                        </select>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="venta"> ¿Está en Venta? </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="checkbox" class="form-control" placeholder="venta" id="venta" name="venta" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group estaEnVenta" style="display: none;" >
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="ventaPrecio"> Precio de venta </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="number" class="form-control" placeholder="ventaPrecio" id="ventaPrecio" name="ventaPrecio" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group estaEnVenta" style="display: none;" >
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="ventaMoneda"> Moneda para Precio de Venta </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control" placeholder="ventaMoneda" id="ventaMoneda" name="ventaMoneda" >
                            <option value="DOLARES AMERICANOS">Dolares americanos</option>
                            <option value="PESOS MEXICANOS">Pesos mexicanos</option>
                            <option value="EUROS">Euros</option>
                        </select>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group estaEnVenta" style="display: none;" >
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="ventaOcultarImporte"> Venta Ocultar Importe </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="checkbox" class="form-control" placeholder="ventaOcultarImporte" id="ventaOcultarImporte" name="ventaOcultarImporte" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group estaEnVenta" style="display: none;" >
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="ventaNegociable"> ¿La Venta es Negociable? </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="checkbox" class="form-control" placeholder="ventaNegociable" id="ventaNegociable" name="ventaNegociable" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group estaEnVenta" style="display: none;" >
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="compraFecha"> Fecha de Compra </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="date" class="form-control" placeholder="compraFecha" id="compraFecha" name="compraFecha" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group estaEnVenta" style="display: none;" >
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="ocultarFecha"> ¿Deseas Ocultar la Fecha de Compra? </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="checkbox" class="form-control" placeholder="ocultarFecha" id="ocultarFecha" name="ocultarFecha" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group estaEnVenta" style="display: none;" >
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="compraCaduca"> ¿La Compra Tiene Caducidad? </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="checkbox" class="form-control" placeholder="" id="compraCaduca" name="compraCaduca" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group estaEnVenta" style="display: none;" >
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="compraCaducidad"> Fecha de Caducidad </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="date" class="form-control" placeholder="" id="compraCaducidad" name="compraCaducidad" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="renta"> ¿Está en Renta? </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="checkbox" class="form-control" id="renta" name="renta" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group estaEnRenta" style="display:none;">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="rentaPrecio"> Precio de Renta </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="number" class="form-control" placeholder="" id="rentaPrecio" name="rentaPrecio" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group estaEnRenta" style="display:none;">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="rentaMoneda"> Moneda para Precio de Renta </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <select class="form-control" placeholder="" id="rentaMoneda" name="rentaMoneda" >
                            <option value="DOLARES AMERICANOS">Dolares americanos</option>
                            <option value="PESOS MEXICANOS">Pesos mexicanos</option>
                            <option value="EUROS">Euros</option>
                        </select>
                    </span>
                </div>
            </div>
        </div> 
        <div class="form-group estaEnRenta" style="display:none;">
            <div class="row">
                <label class="col-sm-3 control-label no-padding-right" for="rentaNegociable"> ¿La Renta es Negociable? </label>
                <div class="col-sm-7">
                    <span class="block input-icon input-icon-right">
                        <input type="checkbox" class="form-control" placeholder="" id="rentaNegociable" name="rentaNegociable" />
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="telContacto"> Teléfono de Contacto </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <input type="text" class="form-control" placeholder="" id="telContacto" name="telContacto" required/>
                </span>
            </div>
        </div>
        </div>
        <div class="form-group">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right" for="metodoPago"> Método(s) de pago que aceptas para la transacción </label>
            <div class="col-sm-7">
            <span class="block input-icon input-icon-right">
                <select id="metodoPago" name="metodoPago[]" id="metodoPago" class="form-control" multiple  required>
                    <option value="EFECTIVO">Efectivo</option>
                    <option value="CREDITO-DEBITO">Tarjeta Crédito/Débito</option>
                    <option value="TRANSFERENCIA">Transferencia</option>
                    <option value="CHEQUE">Cheque</option>
                </select>
                </span>
            </div>
        </div>
        </div>
        <div class="clearfix">
        <div class="row">
            <label class="col-sm-3 control-label no-padding-right"> </label>
            <div class="col-sm-7">
                <button type="submit" class="width-35 pull-right btn btn-primary" >
                <i class="ace-icon fa fa-key"></i>
                Crear
                </button>
            </div>
        </div>
        </div>
        <div class="col-sm-7">¿Tienes algunas dudas? <a href="/preguntas-frecuentes-sobre-tiempos-compartidos">Revisa nuestra sección de preguntas o privacidad</a></div>
    </form> 
    </div>
@endsection