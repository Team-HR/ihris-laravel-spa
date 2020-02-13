<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
// INCLUDES
use Illuminate\Support\Facades\Auth;
use Redirect,Response;
use Illuminate\Validation\Rule;
use Validator;

class PositionController extends Controller
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
        // $employees = Employee::orderBy('last_name', 'asc')->paginate(50);
        
        // $departments = Department::orderBy('name', 'asc')->get();
        $positions = Position::orderBy('name', 'asc')->get();

        // $user = Auth::user();
        return view('position.index', [
            // 'employees' => $employees,
            // 'departments' => $departments,
            'positions' => $positions
        ]);
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
        $object_id = $request->object_id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:positions,name,' . $object_id. ',id,function,' . $request->function,
            'function' => 'nullable',
            'level' => 'nullable',
            'category' => 'nullable',
            'sg' => 'nullable',
        ],[
            'name.unique' => 'Position and function is already in the record!',
        ]);
     
    if ($validator->passes()) {
        $position = Position::updateOrCreate(['id'=>$object_id],
            [
                'name' => $request->name,
                'function' => $request->function,
                'level' => $request->level,
                'category' => $request->category,
                'sg' => $request->sg
            ]);

        


        // return response()->json(['success'=>'Added new records.']);
        // $pushee = array('Testing Pushee!');

        // array_push($employee, $pushee);
        $serial = $position->toArray();
        $serial['count'] = Position::get()->count();
        return Response::json($serial);

        }
     
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $where = array('id' => $id);
        $position  = Position::where($where)->first();
        return Response::json($position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position = Position::where('id',$id)->delete();
        $count = Position::get()->count();
        return response()->json($count);
    }
}
