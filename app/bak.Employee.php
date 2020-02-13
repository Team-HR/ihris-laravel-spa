<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Department;
use App\Position;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Notifications\Notifiable;
class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use Notifiable;
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'employees.last_name'  => 10,
            'employees.first_name'   => 10,
            'employees.middle_name'   => 10,
        ]
    ];


    protected $fillable = [
        'last_name',
        'middle_name',
        'first_name',
        'ext_name',
        'gender',
        'status',
		'employment_status',
		'department_id',
        'section_id',
		'position_id',
		'rank_of_ass',
		'date_activated',
		'date_inactivated',
		'date_ipcr',
    ];

    protected $appends = [
        'padded_id',
        'full_name',
        'department_short',
        'department',
        'position',
        'position_function'
    ];

public function getFullNameAttribute()
{
    $fullName = "{$this->last_name}, {$this->first_name}".($this->middle_name?" ".$this->middle_name[0].".":"").($this->ext_name?" ".$this->ext_name." ":"");
    return mb_convert_case($fullName, MB_CASE_UPPER);
}

public function getPaddedIDAttribute()
{
	return sprintf('%05d', $this->id);	
}

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

public function getPositionAttribute()
{
    $where = array('id' => $this->position_id);
    $position = Position::where($where)->first();
    // return $position['name'];
    return mb_convert_case($position['name'], MB_CASE_UPPER);
}
public function getPositionFunctionAttribute()
{
    $where = array('id' => $this->position_id);
    $position = Position::where($where)->first();
    // return $position['function'];
    return mb_convert_case($position['function'], MB_CASE_UPPER);
}


}
