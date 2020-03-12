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
        // return parent::toArray($request);
        return [
            'id' => $this->id,
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
            'department_short' => $this->department_short,
            'department' => $this->department,
            // 'created_at' => Carbon::parse($this->created_at)->toDayDateTimeString(),
        ];
    }

}
