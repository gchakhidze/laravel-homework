<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            $now = Carbon::now();

            DB::table('quizzes')->insert([
                'name'        => "Quiz $i",
                'description' => ($i % 3 == 0) ? null : "Description for Quiz $i",
                'image'       => ($i % 2 == 0) ? "https://t3.ftcdn.net/jpg/03/45/97/36/360_F_345973621_sMifpCogXNoIDjmXlbLwx1QZA5ZmQVl8.jpg" : null,
                'status'      => ($i % 4 == 0) ? 0 : 1, 
                'created_at'  => $now,
                'updated_at'  => $now,
            ]);
        }
    }
}
