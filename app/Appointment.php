<?php

namespace App;
use App\Department;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
		'employee_id',
		'employment_status',
		'position_title',
		'sg',
		'daily_wage',
		'from_date',
		'to_date',
		'nature_of_appointment',
		'department_id',
    ];

        protected $appends = [
        // 'padded_id',
        // 'full_name',
        'department_short',
        'department',
        // 'position',
        'from_date_str',
        'to_date_str'
        // 'position_function'
    ];

	public function getDepartmentShortAttribute()
	{
	    $where = array('id' => $this->department_id);
	    $department  = Department::where($where)->first();
	    // return $department['short_name'];
	    return mb_convert_case($department['short_name'], MB_CASE_UPPER);
	}

	public function getDepartmentAttribute()
	{
	    $where = array('id' => $this->department_id);
	    $department  = Department::where($where)->first();
	    // return $department['name'];
	    return mb_convert_case($department['name'], MB_CASE_UPPER);
	}

	public function getFromDateStrAttribute()
	{
		$date = date_create($this->from_date);
		return date_format($date, 'F d, Y');
	}

	public function getToDateStrAttribute()
	{
		$date = date_create($this->to_date);
		return date_format($date, 'F d, Y');
	}
}
