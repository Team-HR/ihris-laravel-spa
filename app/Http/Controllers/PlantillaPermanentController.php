<?php

namespace App\Http\Controllers;
use App\AppointmentPermanent;
use App\PlantillaPermanent;
use App\Employee;
use App\User;
use Illuminate\Http\Request;
use Redirect,Response,DB,Config;
use Illuminate\Validation\Rule;
use Validator;
// resources
use App\Http\Resources\PlantillaPermanentsResource;
use App\Http\Resources\AppointmentPermanentsResource;

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
        // $plantillaPermanents = $this->plantillaPermanent
        //     ->select('*')
        //     ->get();

        $plantilla = PlantillaPermanent::leftJoin('appointment_permanents','appointment_permanents.plantilla_permanent_id','=','plantilla_permanents.id')
            ->leftJoin('employees', 'appointment_permanents.employee_id', '=', 'employees.id')
            ->select('plantilla_permanents.id as plantilla_id','plantilla_permanents.*','appointment_permanents.*','employees.*')
            ->get();

        // dd($plantilla->toArray());
        // $data = array('data'=>$appointmentPermanents->toArray());
        // return $data;
        return PlantillaPermanentsResource::collection($plantilla);
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
        $id = $request->data['plantilla_id'];
        $item_no = $request->data['item_no'];
        $position_title = $request->data['position_title'];
        $functional_title = $request->data['functional_title'];
        $department_id = $request->data['department_id'];
        $level = $request->data['level'];
        $salary_grade = $request->data['salary_grade'];
        $authorized_salary = $request->data['authorized_salary'];
        $actual_salary = $request->data['actual_salary'];
        $step = $request->data['step'];
        $region_code = $request->data['region_code'];
        $area_type = $request->data['area_type'];
        $category = $request->data['category'];
        $classification = $request->data['classification'];

        // dd($request->data);

        $validator = Validator::make($request->data, [
            // 'item_no' => 'required'.($id==0?'|unique:plantilla_permanents':''),
            'item_no' => 'required|unique:plantilla_permanents,item_no,' . $id,
            'position_title' => 'required'
        ],[
            'item_no.unique' => 'Item already in the record!',
        ]);
     
    if ($validator->passes()) {
        $plantillaPermanent = PlantillaPermanent::updateOrCreate(['id'=>$id],
            [
                'item_no' => $item_no,
                'position_title' => $position_title,
                'functional_title' => $functional_title,
                'department_id' => $department_id,
                'level' => $level,
                'salary_grade' => $salary_grade,
                'authorized_salary' => $authorized_salary,
                'actual_salary' => $actual_salary,
                'step' => $step,
                'region_code' => $region_code,
                'area_type' => $area_type,
                'category' => $category,
                'classification' => $classification
            ]);
        
        $serial = $plantillaPermanent->toArray();
        $serial['count'] = PlantillaPermanent::get()->count();
        return Response::json($serial);
    }
     
        return response()->json(['error'=>$validator->errors()->all()]);
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
    public function destroy(Request $request)
    {
        // dd ($request->id);
        $plantillaPermanent = PlantillaPermanent::where('id',$request->plantilla_id)->delete();
        $count = PlantillaPermanent::get()->count();
        return response()->json($count);
    }
}
