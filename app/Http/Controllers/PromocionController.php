<?php

namespace App\Http\Controllers;
use Image;
use Session;
use Redirect;
use App\User;
use App\Promocion;
use Illuminate\Http\Request;

class PromocionController extends Controller
{
    /**
     * Display a listing of Promociones.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the instance to make HTTP Requests
        $client = getClient();
        try {
            // Get all Promociones
            $response = Promocion::getAll($client);
        } catch (RequestException $e) {
            // In case something went wrong it will redirect to /promociones without any information
            return view('promocion.index');
        }

        // Get the response body from HTTP Request and parse to Object
        $promociones = json_decode($response->getBody()->getContents());

        //Return to /promociones with the Object: $promociones
        return view('promocion.index', compact('promociones'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Session::has('SUPER_USER'))
            return Redirect::to('/');
        return view('promocion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Session::has('SUPER_USER'))
            return Redirect::to('/');
        try {
            // Get a single promocion
            $response = Promocion::create(getClient(), $request);
        } catch (RequestException $e) {
            
            // In case something went wrong it will redirect to /promociones
            session()->flash('error', 'Ocurrio un error al crear a esta promoción, por favor, intente de nuevo.');
            return view('promocion.index');
        }
        
        session()->flash('message', 'Se ha creado una nueva promoción.');        
        return Redirect::to('/controlpanel');
    }

    /**
     * Display the specified resource.
     *
     * @param  String  $titulo
     * @param  String  $id
     * @return \Illuminate\Http\Response
     */
    public function show($titulo, $id)
    {
        try {
            // Get a single promocion
            $response = Promocion::findById(getClient(), $id);
        } catch (RequestException $e) {
            

            // In case something went wrong it will redirect to /promociones
            session()->flash('error', 'Ocurrio un error al acceder a esta promoción, por favor, intente de nuevo.');
            return view('promocion.index');
        }
        
        // Get the response body from HTTP Request and parse to Object        
        $promocion = json_decode($response->getBody()->getContents());
        // return var_dump($promocion->imagenes);
        
        //Return to /promociones/{titulo}/{id} with the Object: $promocion
        return view('promocion.show', compact('promocion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Verify route
        if (!Session::has('SUPER_USER'))
            return Redirect::to('/');

        try {
            $response = Promocion::findByid(getClient(), $id);
        } catch (RequestException $e) {
            // In case something went wrong it will redirect to /controlpanel
            session()->flash('error', 'Por favor intente de nuevo');
            return Redirect::to('/controlpanel');
        }

        $promocion = json_decode($response->getBody()->getContents());

        return view('promocion.edit', compact('promocion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Promocion  $promocion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // Verify route
        if (!Session::has('SUPER_USER'))
            return Redirect::to('/');

        try {
            $response = Promocion::edit(getClient(), $request, Session::get('ACCESS_TOKEN'));
        } catch (RequestException $e) {
            // If something went wrong it will redirect to home page
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return redirect()->home(); 
        }
        session()->flash('message', 'Cambios guardados correctamente');
        return Redirect::to('/controlpanel');
    }

    public function createImage($id)
    {
        // Verify route
        if (!Session::has('SUPER_USER'))
            return Redirect::to('/');
        
        try {
            $response = Promocion::findById(getClient(), $id);
        } catch (RequestException $e) {
            // If something went wrong it will redirect to home page
            session()->flash('error', 'Ha ocurrido un error inesperado, por favor intente de nuevo');
            return Redirect::to('/controlpanel');
        }

        $promocion = json_decode($response->getBody()->getContents());
    
        return view('promocion.images.create', compact('promocion'));
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
         if (!Session::has('SUPER_USER'))
             return Redirect::to('/');
 
         if ($request->hasFile('images')) {
             $post_image = $request->file('images');  
             // Get the instance to make HTTP Requests        
             $client = getClient();
             
             foreach($post_image as $key => $image ) {
                 $filename = $request->promocionTitulo . '-' .time().'-'. $key . '.' . $image->getClientOriginalExtension();
                //  $description = $request->{'descripcion-'.$key};
             
                 // Save image in original size without oversized up to 1900
                 Image::make($image)->resize(1900, null, function ($constraint) {
                     $constraint->aspectRatio();
                     $constraint->upsize();
                 })->save( public_path('/'. $_ENV['UPLOAD_FOLDER'].'/promociones/') . $filename);
     
                 // Save image in thumb folder giving it 300 for height and auto width
                 Image::make($image)->resize(300, null, function ($constraint) {
                     $constraint->aspectRatio();
                     $constraint->upsize();
                 })->save( public_path('/'.$_ENV['UPLOAD_FOLDER'].'/promociones/thumbs/') . $filename);    
                 
                 //Make POST to API and save image information
                 try {
                     $response = Promocion::setImage($client, $request, Session::get('ACCESS_TOKEN'), $filename, 'thumb' );
                     $response = Promocion::setImage($client, $request, Session::get('ACCESS_TOKEN'), $filename, 'original' );
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
         
         // Make POST to API
         
         return Redirect::to('/guardar-imagenes-promocion/' . $request->promocionId . '#mis-imagenes');
         // return Redirect::back()->with('message','Las imágenes han sido guardadas.');
         
     }
}
