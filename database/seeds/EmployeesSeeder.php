<?php

use Illuminate\Database\Seeder;
use App\Employee;
class EmployeesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = [
            [
                'last_name'=>'Doe',
                'middle_name'=>'Tesla',
                'first_name'=>'John',
                'ext_name'=>null,
                'gender'=>'M',
                'status'=>'ACTIVE',
                'employment_status'=>'PERMANENT',
                'department_id'=>'1',
                'position_id'=>'2',
                'rank_of_ass'=>'SUPERVISORY',
                'date_activated'=>'2012-11-16',
                'date_deactivated'=>null,
                'date_ipcr'=>null,
            ],
            [
                'last_name'=>'Dela Cruz',
                'middle_name'=>'Alba',
                'first_name'=>'Juanita',
                'ext_name'=>null,
                'gender'=>'F',
                'status'=>'ACTIVE',
                'employment_status'=>'CASUAL',
                'department_id'=>'2',
                'position_id'=>'3',
                'rank_of_ass'=>'RANK AND FILE',
                'date_activated'=>'2016-07-16',
                'date_deactivated'=>null,
                'date_ipcr'=>null,
            ],
            [
                'last_name'=>'Santa',
                'middle_name'=>'Vida',
                'first_name'=>'Clara',
                'ext_name'=>null,
                'gender'=>'F',
                'status'=>'ACTIVE',
                'employment_status'=>'CASUAL',
                'department_id'=>'2',
                'position_id'=>'2',
                'rank_of_ass'=>'RANK AND FILE',
                'date_activated'=>'2018-01-16',
                'date_deactivated'=>null,
                'date_ipcr'=>null,
            ],
        ];
  
        foreach ($employee as $key => $value) {
            Employee::create($value);
        }
    }
}
