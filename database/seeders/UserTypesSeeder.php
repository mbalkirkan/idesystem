<?php

namespace Database\Seeders;

use App\Models\UserType;
use Illuminate\Database\Seeder;

class UserTypesSeeder extends Seeder
{

    public function run()
    {
        $types=['Administrator'=>'Sistem Yöneticisi','Supervisor'=>'Sistem Sağlayıcı','User'=>'Kullanıcı'];
        foreach ($types as $key=>$type) {
            UserType::create([
                'name'=>$key,
                'role'=>$type
            ]);
        }
    }
}
