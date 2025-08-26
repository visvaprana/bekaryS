<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'=>"Admin",
            'email'=>'admin@gmail.com',
            'phone'=>'01916962118',
            'password' => bcrypt('123123123'),
            'role_id'=>1,
            'image'=>'http://via.placeholder.com/37x37?text=Admin Image-37x37',
            'status'=>1
        ]);
    }
}
