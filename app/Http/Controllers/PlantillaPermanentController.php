<?php

namespace App\Http\Controllers;
use App\PlantillaPermanent;
use App\User;
use App\Http\Resources\PlantillaPermanentsResource;
use Illuminate\Http\Request;
use Redirect,Response,DB,Config;

class PlantillaPermanentController extends Controller
{

    protected $plantillaPermanent;

    public function __construct (PlantillaPermanent $plantillaPermanent)
    {
        $this->plantillaPermanent = $plantillaPermanent;
    }

    public function getPlantillaPermanentsForDataTable()
    {
        $matchThese = ['department_id' => 1 ];
        $plantillaPermanents = $this->plantillaPermanent->where($matchThese)
            ->select('*')
            ->get();
        return PlantillaPermanentsResource::collection($plantillaPermanents);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
