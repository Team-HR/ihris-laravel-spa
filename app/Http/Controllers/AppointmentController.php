<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use Response;

class AppointmentController extends Controller
{
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
        $where = array('id' => $id);
        $appointment  = Appointment::where($where)->first();
        return Response::json($appointment);
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

    public function updatePerEmployee(Request $request, $id)
    {

        $appointment = Appointment::find($request->id);
        $appointment->employment_status = $request->employment_status;
        $appointment->position_title = $request->position_title;
        $appointment->sg = $request->sg;
        $appointment->daily_wage = $request->daily_wage;
        $appointment->from_date = $request->from_date;
        $appointment->to_date = $request->to_date;
        $appointment->nature_of_appointment = $request->nature_of_appointment;
        $appointment->department_id = $request->department_id;

        $appointment->save();

        return Response::json('updated');
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
