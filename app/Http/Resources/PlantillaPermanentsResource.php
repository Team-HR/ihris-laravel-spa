<?php

namespace App\Http\Resources;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;


class PlantillaPermanentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    

    public function toArray($request)
    {
        return [
            'plantilla_id' => $this->plantilla_id,
            'item_no' => $this->item_no,
            'department_id' => $this->department_id,
            'position_title' => $this->position_title,
            'functional_title' => $this->functional_title,
            'level' => $this->level,
            'salary_grade' => $this->salary_grade,
            'authorized_salary' => $this->authorized_salary,
            'actual_salary' => $this->actual_salary,
            'step' => $this->step,
            'region_code' => $this->region_code,
            'area_type' => $this->area_type,
            'category' => $this->category,
            'classification' => $this->classification,
            'appointed_to' => $this->appointed_to,
            'employee_id' => $this->employee_id,
            'last_name' => $this->last_name,
            'first_name' => $this->first_name,
            'middle_name' => ($this->middle_name?$this->middle_name[0]:''),
            'sex' => $this->sex,
            'date_of_birth' => $this->date_of_birth,
            'tin' => $this->tin,
            'date_appointed' => $this->date_appointed,
            'date_vacated' => $this->date_vacated,
        ];
    }

}
