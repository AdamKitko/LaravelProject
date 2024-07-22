<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'user_id' => 2,
                'name'=> 'Barber',
                'city' => 'Prešov',
                'address' => 'Františkánske námestie 5',
                'image_url' => 'https://images.unsplash.com/photo-1592647420148-bfcc177e2117?q=80&w=2639&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'description' => 'Cool Barber Shop',
                'active' => '1',
            ],
            [
                'user_id' => 3,
                'name'=> 'Holicstvo',
                'city' => 'Sabinov',
                'address' => 'Námestie slobody 50',
                'image_url' => 'https://images.unsplash.com/photo-1549271568-e87e07c5406b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
                'description' => 'Very cool',
                'active' => '1',
            ],
        ]);
    }
}
