<?php

namespace App\Http\Controllers;

use App\PlantillaPermanent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Response;
use Faker\Generator;

class PlantillaPermanentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $plantilla_permanent = PlantillaPermanent::all()->jsonSerialize();
        return response(PlantillaPermanent::all()->jsonSerialize(), Response::HTTP_OK);
        // return view('permanent.plantilla.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PlantillaPermanent  $plantillaPermanent
     * @return \Illuminate\Http\Response
     */
    public function show(PlantillaPermanent $plantillaPermanent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PlantillaPermanent  $plantillaPermanent
     * @return \Illuminate\Http\Response
     */
    public function edit(PlantillaPermanent $plantillaPermanent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PlantillaPermanent  $plantillaPermanent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PlantillaPermanent $plantillaPermanent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PlantillaPermanent  $plantillaPermanent
     * @return \Illuminate\Http\Response
     */
    public function destroy(PlantillaPermanent $plantillaPermanent)
    {
        //
    }
}
