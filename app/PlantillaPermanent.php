<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlantillaPermanent extends Model
{
    protected $fillable = [
            'id',
            'item_no',
            'department_id',
            'position_title',
            'functional_title',
            'level',
            'salary_grade',
            'authorized_salary',
            'actual_salary',
            'step',
            'region_code',
            'area_type',
            'category',
            'classification',
    ];

}
