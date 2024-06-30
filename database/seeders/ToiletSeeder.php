<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ToiletSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('toilets')->insert([
            'address' => '新宿区中落合',
            'title' => '公園のトイレ',
            'function_id' => '1',
            'opening_hours' => '２４時間',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
            'user_id' => '1',
            ]);
    }
}
