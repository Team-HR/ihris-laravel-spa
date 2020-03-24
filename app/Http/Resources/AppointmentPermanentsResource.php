<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AppointmentPermanentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'appointment_id' => $this->id,
            'plantilla_permanent_id' => $this->plantilla_permanent_id,
            'employee_id' => $this->employee_id,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'ext_name' => $this->ext_name,
            'middle_name' => $this->middle_name,
            'sex' => $this->sex,
            'date_of_birth' => $this->date_of_birth,
            'tin' => $this->tin,
            'appointed' => $this->appointed,
            'date_appointed' => $this->date_appointed,
            'date_vacated' => $this->date_vacated,
            'full_name'=> $this->last_name.', '.$this->first_name.($this->middle_name?' '.$this->middle_name[0].'.':'').($this->ext_name?' '.$this->ext_name:''),
        ];
    }
}
