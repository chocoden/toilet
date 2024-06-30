<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('reviews')->insert([
            'toilet_id' => 1,
            'user_id' => 1,
            'rating' => 4.5,
            'comment' => '綺麗だったよ',
            'created_at' => new DateTime(),
            'updated_at' => new DateTime(),
            ]);
    }
}
