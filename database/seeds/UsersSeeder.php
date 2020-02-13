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
               'is_admin'=>'0',
               'password'=> bcrypt('1234'),
            ],
            [
               'name'=>'Jane Doe',
               // 'email'=>'user@itsolutionstuff.com',
               'username'=>'jdoe',
               'is_admin'=>'0',
               'password'=> bcrypt('1234'),
            ],
            [
               'name'=>'Jessel Marie B. Alingcomot',
               // 'email'=>'user@itsolutionstuff.com',
               'username'=>'jmbalingcomot',
               'is_admin'=>'0',
               'password'=> bcrypt('1234'),
            ],
        ];
  
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}