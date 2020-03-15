<?php

namespace App\Http\Controllers;
use App\PlantillaPermanent;
use App\User;
use App\Http\Resources\PlantillaPermanentsResource;
use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Illuminate\Validation\Rule;
use Validator;

class PlantillaPermanentController extends Controller
{

    protected $plantillaPermanent;

    public function __construct (PlantillaPermanent $plantillaPermanent)
    {
        $this->plantillaPermanent = $plantillaPermanent;
    }

    public function getPlantillaPermanentsForDataTable()
    {
        // $matchThese = ['department_id' => 1 ];
        // $plantillaPermanents = $this->plantillaPermanent->where($matchThese)
        $plantillaPermanents = $this->plantillaPermanent
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
        // $data = $request->editedItem;
        dd ($request);
    //     $id = $data['id'];
    //     $item_no = $data['item_no'];
    //     $position_title = $data['position_title'];
    //     $functional_title = $data['functional_title'];
    //     $department_id = $data['department_id'];

    //     $validator = Validator::make($data, [
    //         'item_no' => 'required',
    //         'position_title' => 'required'
    //     ],[
    //         'item_no.unique' => 'Item already in the record!',
    //     ]);
     
    // if ($validator->passes()) {
    //     $plantillaPermanent = PlantillaPermanent::updateOrCreate(['id'=>$id],
    //         [
    //             'item_no' => $item_no,
    //             'position_title' => $position_title,
    //             'functional_title' => $functional_title,
    //             'department_id' => $department_id,
    //         ]);
        
    //     $serial = $plantillaPermanent->toArray();
    //     $serial['count'] = PlantillaPermanent::get()->count();
    //     return Response::json($serial);

    //     }
     
    //     return response()->json(['error'=>$validator->errors()->all()]);
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
