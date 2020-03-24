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
        $matchThese = ['plantilla_permanent_id'=>$request->plantilla_id];
        $appointment = AppointmentPermanent::rightJoin('employees','appointment_permanents.employee_id', '=', 'employees.id')
        ->where($matchThese)
        ->get();
        return AppointmentPermanentsResource::collection($appointment);
    }

}
