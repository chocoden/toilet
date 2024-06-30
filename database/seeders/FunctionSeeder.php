<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class FunctionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('functions')->insert([
            'name' => 'ウォシュレット',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
    }
}
