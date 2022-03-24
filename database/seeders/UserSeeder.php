<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon as SupportCarbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'ivan',
                'email' => 'ivan@gmail.com',
                'password' => '1234qwer',
                'created_at' => SupportCarbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => SupportCarbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'catalina',
                'email' => 'catalina@gmail.com',
                'password' => '1234qwer',
                'created_at' => SupportCarbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => SupportCarbon::now()->format('Y-m-d H:i:s')
            ]
            ]);
    }
}
