<?php

namespace App\Http\Controllers;
use App\Http\Resources\EmployeesResource;
use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\Position;
use App\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Redirect,Response,Config,Validator,Datatables;

class EmployeeController extends Controller
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
        $employees = Employee::orderBy('last_name', 'asc')->get();
        $departments = Department::orderBy('short_name', 'asc')->get();
        $positions = Position::all();    
        $positions = $positions->sortBy(function($position){
            return $position->sorted_list;
        });
        $user = Auth::user();

        return view('employee.index', [
            'employees' => $employees,
            'departments' => $departments,
            'positions' => $positions
        ]);
    }

    function action(Request $request)
    {
        if($request->ajax())
         {

            $data = Employee::search($request->get('full_text_search_query'))->get();

            return response()->json($data);
         }
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

    public function listEmployee(Employee $employee)
    {
        // return Response::json($department->all());
        return EmployeesResource::collection($employee->all());
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee_id = $request->employee_id;
        $validator = Validator::make($request->all(), [
            // 'employee_id' => 'nullable',
            'last_name' => 'required|unique:employees,last_name,' . $employee_id . ',id,first_name,' . $request->first_name,
            'middle_name' => 'nullable',
            'first_name' => 'required',
            'ext_name' => 'nullable',
            'gender' => 'required',
            'status' => 'required',
            'employment_status' => 'required',
            'department_id' => 'required',
            'section_id' => 'required',
            'position_id' => 'required',
            'rank_of_ass' => 'required',
            'date_activated' => 'nullable|date',
            'date_deactivated' => 'nullable|date',
            'date_ipcr' => 'nullable|date',
        ],[

            'last_name.unique' => 'existing',

        ]);
     
    if ($validator->passes()) {
        $employee = Employee::updateOrCreate(['id'=>$employee_id],
            [
                'last_name' => $request->last_name,
                'middle_name' => $request->middle_name,
                'first_name' => $request->first_name,
                'ext_name' => $request->ext_name,
                'gender' => $request->gender,
                'status' => $request->status,
                'employment_status' => $request->employment_status,
                'department_id' => $request->department_id,
                'section_id' => $request->section_id,
                'position_id' => $request->position_id,
                'rank_of_ass' => $request->rank_of_ass,
                'date_activated' => $request->date_activated,
                'date_deactivated' => $request->date_deactivated,
                'date_ipcr' => $request->date_ipcr,
            ]);

        $serial = $employee->toArray();
        return Response::json($serial);

        }
     
        return response()->json(['error'=>$validator->errors()]);
        // return response()->json($validator->errors());


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee  = Employee::find($id);
        $appointments = Appointment::where('employee_id',$id)->get();
        $departments = Department::orderBy('short_name', 'asc')->get();
        // $appointments = Appointments::
        return view('employee.show', [
            'employee' => $employee,
            'appointments' => $appointments,
            'departments' => $departments
        ]);
        // return view('employee.show');
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

        $where = array('id' => $id);
        $employee  = Employee::where($where)->first();
 
        return Response::json($employee);

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


        $employee = Employee::where('id',$id)->delete();
        // return Response::json($employee);
        $count = Employee::get()->count();
        
            return response()->json($count);
        
    }


}
