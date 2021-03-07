<?php

namespace Database\Seeders;

use App\Models\LogType;
use Illuminate\Database\Seeder;

class LogTypeTableSeeder extends Seeder
{

    public function run()
    {
        $types=['Giriş','İşlem','Kullanıcı'];
        foreach ($types as $type) {
            LogType::create([
                'name'=>$type,
            ]);
        }
    }
}
