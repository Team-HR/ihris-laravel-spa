<?php
  
use Illuminate\Database\Seeder;
use App\User;
   
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
               'name'=>'Franz Joshua Valencia',
               // 'email'=>'admin@itsolutionstuff.com',
               'username'=>'fjavalencia',
               'u_type'=>'sys_admin',
               'password'=> bcrypt('1234'),
            ],
            [
               'name'=>'Jane Doe',
               // 'email'=>'user@itsolutionstuff.com',
               'username'=>'jdoe',
               'u_type'=>null,
               'password'=> bcrypt('1234'),
            ],
            [
               'name'=>'Jessel Marie B. Alingcomot',
               // 'email'=>'user@itsolutionstuff.com',
               'username'=>'jmbalingcomot',
               'u_type'=>null,
               'password'=> bcrypt('1234'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}