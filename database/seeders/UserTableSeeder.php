<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users=[
         [
             'username'=>'hbmemati',
             'email'=>'hbmemati@gmail.com',
             'name'=>'Muhammet BALKIRKAN',
             'type'=>1,
             'password'=>bcrypt('03mematiM()'),
         ]
       ];
        foreach ($users as $user) {
            User::create([
                'username'=>$user['username'],
                'email'=>$user['email'],
                'name'=>$user['name'],
                'type'=>$user['type'],
                'password'=>$user['password'],
            ]);
       }

    }
}
