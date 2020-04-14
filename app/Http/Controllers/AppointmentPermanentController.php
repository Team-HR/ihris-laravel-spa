<?php

namespace App\Http\Controllers;
use App\AppointmentPermanent;
use App\PlantillaPermanent;
use Illuminate\Http\Request;

use App\Http\Resources\AppointmentPermanentsResource;


class AppointmentPermanentController extends Controller
{
    public function getAppointmentPermanents(Request $request)
    {
        $plantilla_id = ($request->plantilla_id?$request->plantilla_id:0);
        $matchThese = ['plantilla_id'=>$plantilla_id];
        $appointment = AppointmentPermanent::rightJoin('employees','appointment_permanents.employee_id', '=', 'employees.id')
        ->where($matchThese)
        ->get();

        // dd($appointment->toArray());

        return AppointmentPermanentsResource::collection($appointment);
    }

}
