<?php

namespace App;
use App\Department;
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

    protected $appends = [
    	'department_short',
    	'department'];

	public function getDepartmentShortAttribute()
	{
	    $where = array('id' => $this->department_id);
	    $department  = Department::where($where)->first();
	    return mb_convert_case($department['short_name'], MB_CASE_UPPER);
	}

	public function getDepartmentAttribute()
	{
	    $where = array('id' => $this->department_id);
	    $department  = Department::where($where)->first();
	    return mb_convert_case($department['name'], MB_CASE_UPPER);
	}



}
