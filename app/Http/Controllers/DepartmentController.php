<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use Illuminate\Support\Facades\Auth;
use Redirect,Response;
use Illuminate\Validation\Rule;
use Validator;

use App\Http\Resources\DepartmentsResource;

class DepartmentController extends Controller
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
        $departments = Department::orderBy('name', 'asc')->get();

        return view('department.index', [
            'departments' => $departments
        ]);
    }

    public function listDepartment(Department $department)
    {
        // return Response::json($department->all());
        return DepartmentsResource::collection($department->all());
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
        dd ($request);
        $object_id = $request->object_id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:departments,name,' . $object_id,
            'short_name' => 'nullable'
        ],[
            'name.unique' => 'Department already in the record!',
        ]);
     
    if ($validator->passes()) {
        $department = Department::updateOrCreate(['id'=>$object_id],
            [
                'name' => $request->name,
                'short_name' => $request->short_name
            ]);

        


        // return response()->json(['success'=>'Added new records.']);
        // $pushee = array('Testing Pushee!');

        // array_push($employee, $pushee);
        $serial = $department->toArray();
        $serial['count'] = Department::get()->count();
        return Response::json($serial);

        }
     
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $where = array('id' => $id);
        $department  = Department::where($where)->first();
        return Response::json($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::where('id',$id)->delete();
   
        $count = Department::get()->count();
        return response()->json($count);
    }
}
