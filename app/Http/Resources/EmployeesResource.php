<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeesResource extends JsonResource
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
            'employee_id'=>$this->id,
            'last_name'=>$this->last_name,
            'middle_name'=>$this->middle_name,
            'first_name'=>$this->first_name,
            'ext_name'=>$this->ext_name,
            'sex'=>$this->sex,
            'date_of_birth'=>$this->date_of_birth,
            'tin'=>$this->tin,
            'full_name'=> $this->last_name.', '.$this->first_name.($this->middle_name?' '.$this->middle_name[0].'.':'').($this->ext_name?' '.$this->ext_name:'')
        ];
    }
}
