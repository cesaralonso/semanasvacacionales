<?php

namespace App\Http\Controllers;


use Image;
use Session;
use App\Pais;
use Redirect;
use App\User;
use Exception;
use App\Unidad;
use App\Imagen;
use App\Ubicado;
use App\Localidad;
use App\Membresia;
use GuzzleHttp\Psr7;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class MembresiaController extends Controller
{
    /**
     * Show the form for creating a new resource (membresia).
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');
        // Check if can create another membresia
        try {
            $response = User::countMembresias(getClient(), Session::get('USER_ID'));
        } catch (RequestException $e) {
            // In case something went wrong it will redirect to register view
            session()->flash('error', 'Hubo un error, por favor intente de nuevo');
            return Redirect::to('/');
        }

        $countMembresia = json_decode($response->getBody()->getContents())->count;
        if ( Session::get('USER_TYPE') == 'PROPIETARIO' ) {
            session()->flash('error', 'Solo puedes crear una membresia');
            return Redirect::to('/mis-membresias');
        }

        return var_dump($countMembresia);

        $hasUbicados = false;
        $hasUnidades = false;
        $hasPaises = false;

        try {
            // Get all Ubicados
            $responseUbicados = Ubicado::getAll(getClient());
            $hasUbicados = true;

            // Get all Unidades
            $responseUnidades = Unidad::getAll(getClient());
            $hasUnidades = true;
            
            // Get all Paises
            $responsePaises = Pais::allPaises(getClient());
            $hasPaises = true;
        } catch (RequestException $e) {
            // In case something went wrong it will redirect to register view
            session()->flash('error', 'Hubo un error, por favor intente de nuevo');
            return Redirect::to('/');
        }

        $reponses = []; // This will contain all variables passed to compact function
        
        if ($hasUbicados) {
            $ubicados = json_decode($responseUbicados->getBody()->getContents());
            $responses[] = 'ubicados';
        }
        if ($hasUnidades) {
            $unidades = json_decode($responseUnidades->getBody()->getContents());
            $responses[] = 'unidades';
        }
        if ($hasPaises) {
            $paises = json_decode($responsePaises->getBody()->getContents());
            $responses[] = 'paises';
        }

        return view('membresia.create', compact($responses));
        

    }
    /**
     * Store a newly created resource (membresia) in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');
        
        $metodos = $request->input('metodoPago');
        $metodos = implode(',', $metodos);

        $request->metodoPago = $metodos;
            
        try {
            // Store a new membresia
            $response = Membresia::storeMembresia(getClient(), $request, Session::get('USER_ID'), Session::get('ACCESS_TOKEN'));
        } catch (ClientException $e) {
            // In case something went wrong it will redirect to register view
            session()->flash('error', 'Hubo un error al registrar la nueva membresia, por favor intente de nuevo');
            return view('membresia.create'); 
        }
        $membresia = json_decode($response->getBody()->getContents());
        // Save pais name correctly
        try {
            $responsePais = Pais::findById(getClient(), $request->idPais);
            $pais = json_decode($responsePais->getBody()->getContents());

            $responseStorePais = Membresia::storePaisNombre(getClient(), 
                                                            $membresia->id, 
                                                            $pais->nombre, 
                                                            Session::get('ACCESS_TOKEN'));
        } catch (ClientException $e) {
            // In case something went wrong it will redirect to register view
            session()->flash('error', 'Hubo un error al registrar la nueva membresia, por favor intente de nuevo');
            return view('membresia.create'); 
        }
        session()->flash('message', 'Se ha creado su nueva membresia');        
        return Redirect::to('/mis-membresias');
    }

    private function setMetodosPago($metodosPago)
    {

    }

    /**
     * Display the specified Membresia.
     *
     * @param  String  $titulo
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function show($titulo, $id)
    {
         // Get the instance to make HTTP Requests
        $client = getClient();  

        try {
            // Get a single promocion
            $response = Membresia::findById($client, $id);
            if(Session::has('USER_ID'))
                $isFavorito = User::isFavorito($client, $id, Session::get('USER_ID'), Session::get('ACCESS_TOKEN'));                
            
        } catch (RequestException $e) {
            // In case something went wrong it will redirect to /
            session()->flash('error', 'Ocurrio un error al acceder a esta membresia, por favor, intente de nuevo.');
            return view('home.index');
        }

        // Get the response body from HTTP Request and parse to Object
        $membresia = json_decode($response->getBody()->getContents());
        
        // Get membresias relacionadas
        try {
            $renta = isset($membresia->renta) ? $membresia->renta : false;
            $venta = isset($membresia->venta) ? $membresia->venta : false;

            $response = Membresia::getMembresiasRelacionadas(getClient(), $membresia->paisNombre, $renta, $venta, $membresia->ubicadoEn);
            
        } catch (RequestException $e) {
            // In case something went wrong it will redirect to /
            session()->flash('error', 'Ocurrio un error al acceder a esta membresia, por favor, intente de nuevo.');
            return view('home.index');
        }
        $relacionados = json_decode($response->getBody()->getContents());

        $personInfo = self::getPersonInfo($membresia->messages);
        
        return view('membresia.show', compact(['membresia', 'isFavorito', 'relacionados', 'personInfo']));
    }
     
    /**
     * Show the form for editing the specified membresia.
     *
     * @param  String $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');

        try {
            $response = Membresia::findByid(getClient(), $id);
        } catch (RequestException $e) {
            // In case something went wrong it will redirect to /mis-membresias
            session()->flash('error', 'Por favor intente de nuevo');
            return Redirect::to('/mis-membresias' . '#inicia');
        }

        $responses = []; // This will contain all variables passed to compact function
        
        $membresia = json_decode($response->getBody()->getContents());
        $responses[] = 'membresia';

        // Get content for diaplaying in select tags
        $hasUbicados = false;
        $hasUnidades = false;
        $hasPaises = false;
        $hasLocalidades = false;
        try {

            $responseUbicados = Ubicado::getAll(getClient());
            $hasUbicados = true;

            $responseUnidades = Unidad::getAll(getClient());
            $hasUnidades = true;

            $responsePaises = Pais::allPaises(getClient());
            $hasPaises = true;

            $responseLocalidades = Localidad::findByPais(getClient(), $membresia->idPais);
            $hasLocalidades = true;

        } catch (RequestException $e) {
            // In case something went wrong it will redirect to /mis-membresias
            session()->flash('error', 'Por favor intente de nuevo');
            return Redirect::to('/');
        }

       

        if($hasUnidades) {
            $unidades = json_decode($responseUnidades->getBody()->getContents());
            $unidades = makeAsocArray($unidades, 'nombre', 'descripcion');
            $responses[] = 'unidades';
        }
        if ($hasUbicados) {
            $ubicados = json_decode($responseUbicados->getBody()->getContents());
            $ubicados = makeAsocArray($ubicados, 'nombre', 'descripcion');
            $responses[] = 'ubicados';
        }
        if ($hasPaises) {
            $paises = json_decode($responsePaises->getBody()->getContents());
            $paises = makeAsocArray($paises, 'id', 'nombre');
            $responses[] = 'paises';
        }
        if ($hasLocalidades) {
            $localidades = json_decode($responseLocalidades->getBody()->getContents());
            $localidades = makeAsocArray($localidades, 'nombre', 'nombre');
            $responses[] = 'localidades';
        }
        return view('membresia.edit',  compact($responses));
            

    }

    /**
     * Update the specified membresia in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');

        // Get the instance to make HTTP Requests        
        $client = getClient();

        try {
            $response = Membresia::edit($client, $request, Session::get('USER_ID'), Session::get('ACCESS_TOKEN'));
        } catch (RequestException $e) {
            // If something went wrong it will redirect to home page
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return redirect()->home(); 
        }

        $membresia = json_decode($response->getBody()->getContents());
        // Save pais name correctly
        try {
            $responsePais = Pais::findById(getClient(), $request->idPais);
            $pais = json_decode($responsePais->getBody()->getContents());

            $responseStorePais = Membresia::storePaisNombre(getClient(), $membresia->id, $pais->nombre, Session::get('ACCESS_TOKEN'));
        } catch (ClientException $e) {
            // In case something went wrong it will redirect to register view
            session()->flash('error', 'Hubo un error al registrar la nueva membresia, por favor intente de nuevo');
            return view('membresia.create'); 
        }

        session()->flash('message', 'Membresia actualizada con éxito');
        return Redirect::to('/mis-membresias');
    }
    
    /**
     * Show the form for creating a new resource (Image related to a membresia).
     *
     * @return \Illuminate\Http\Response
     */
    public function createImage($id)
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');
        
        // Get the instance to make HTTP Requests        
        $client = getClient();

        try {
            $response = Membresia::findById($client, $id);
        } catch (RequestException $e) {
            // If something went wrong it will redirect to home page
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return redirect()->home(); 
        }

        $membresia = json_decode($response->getBody()->getContents());

        return view('membresia.images.create', compact('membresia'));
    }

    /**
     * Store a newly created resource (Image) in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function storeImage(Request $request)
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');
        // Verify if theres more than 6 images
        try {
            $response = Membresia::countImages(getClient(), $request->membresiaId);
        } catch (RequestException $e) {
            // If something went wrong it will redirect to home page
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return var_dump($e->getResponse()->getBody()->getContents());
        }
        $count = json_decode($response->getBody()->getContents())->count;
        $remaningImages = 6-$count;
        if ($request->hasFile('images')) {
            $post_image = $request->file('images');  
            if ( count($post_image) * 2 > $remaningImages) {
                session()->flash('error', 'Sólo puedes subir tres imagenes de de tu membresia');
                return Redirect::back();
            }
            // Get the instance to make HTTP Requests        
            $client = getClient();
            foreach($post_image as $key => $image ) {
                $filename = $request->membresiaTitulo . '-' .time(). '-'. $key . '.' . $image->getClientOriginalExtension();
                $description = $request->{'descripcion-'.$key} || 'Sin descripcion';
            
                // Save image in original size without oversized up to 1900
                Image::make($image)->resize(1900, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save( public_path('/'.$_ENV['UPLOAD_FOLDER'].'/membresias-images/') . $filename);
    
                // Save image in thumb folder giving it 300 for height and auto width
                Image::make($image)->resize(300, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save( public_path('/'.$_ENV['UPLOAD_FOLDER'].'/membresias-images/thumbs/') . $filename);    
                
                //Make POST to API and save image information
                try {
                    $response = Membresia::setImage($client, $request, Session::get('ACCESS_TOKEN'), $filename, 'thumb', $description );
                    $response = Membresia::setImage($client, $request, Session::get('ACCESS_TOKEN'), $filename, 'original', $description );
                } catch (RequestException $e) {
                    // If something went wrong it will redirect to home page
                    session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
                    return dd($e);
                }
            }
        } else {
            session()->flash('error', 'Por favor intente subir la(s) imagen(es) de nuevo');
            return back()->withInput();
        }
                
        return Redirect::to('/guardar-imagenes/' . $request->membresiaId . '#mis-imagenes');
        // return Redirect::back()->with('message','Las imágenes han sido guardadas.');
        
    }

    public function setLocation($id)
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');

        try {
            $response = Membresia::findById(getClient(), $id);
        } catch (RequestException $e) {
            // If something went wrong it will redirect to home page
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return redirect()->home();             
        }

        $membresia = json_decode($response->getBody()->getContents());

        return view('membresia.ubicacion', compact('membresia'));
    }

    // DSIPONIBILIDADES
    public function createDisponibilidad($id)
    {
        // Verify route
        if (!Session::has('ACCESS_TOKEN'))
            return Redirect::to('/');
            
        try {
            $response = Membresia::allDisponibilidades(getClient(), $id);
        } catch (RequestException $e) {
            return var_dump(json_decode($e->getResponse()->getBody()));
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return Redirect::back();
        }
        
        $disponibilidades = json_decode($response->getBody()->getContents());

        return view('membresia.disponibilidad', compact(['id', 'disponibilidades']));
    }

    public function saveDisponibilidad(Request $request)
    {
        if(strtotime($request->fecha_inicial) > strtotime($request->fecha_final)) {
            session()->flash('error', 'La fecha inicial es mayor a la fecha final');
            return Redirect::back();
        }
        try {
            $response = Membresia::createDisponibilidad(getClient(), $request->membresiaId, $request->fecha_inicial, $request->fecha_final, false);
        } catch (RequestException $e) {
            // return var_dump(json_decode($e->getResponse()->getBody()));
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return Redirect::back();
        }
        
        return Redirect::back();
    }

    // AMENIDADES
    public function createAmenidad($id)
    {
        try {
            $responseAmenidades = Membresia::allAmenidades(getClient());
            $responseAmenidadesByMembresia = Membresia::allAmenidadesByMembresia(getClient(), $id);
        } catch( RequestException $e ) {
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return Redirect::back();
        }
        $amenidades = json_decode($responseAmenidades->getBody()->getContents());
        $amenidadesMembresia = json_decode($responseAmenidadesByMembresia->getBody()->getContents());
        
        $allAmenidades = [];
        foreach ($amenidades as $key => $amenidad) {
            $allAmenidades[$key][0] = $amenidad->id;
            $allAmenidades[$key][1] = $amenidad->nombre;
            $allAmenidades[$key][2] = in_array($amenidades[$key], $amenidadesMembresia) ? true : false;
            
        }
        return view('membresia.amenidad', compact(['id', 'allAmenidades']));
    }

    private function getPersonInfo($messages)
    {
        $personInfo = [];

        foreach ($messages as $key => $message) {
            try {
                $response = User::findById(getClient(), $message->personId);
                $personInfo[] = json_decode($response->getBody()->getContents());
            } catch( RequestException $e ) {
                
            }
        }

        return $personInfo;
    }

}
