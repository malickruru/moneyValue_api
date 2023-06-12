<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ConversionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(2023, 1, 1);
        $endDate = Carbon::create(2023, 6, 1);

        for ($i=0; $i < 1000; $i++) { 
            DB::table('conversion')->insert([
                // 1.une paire aléatoire
                'pair_id' => DB::table('pairs')->inRandomOrder()->value('id'),
                'amount' => rand(1, 1000000),
                // Générer une date aléatoire entre le 1er janvier et le 1er juin 2023
                'created_at' => Carbon::createFromTimestamp(mt_rand($startDate->timestamp, $endDate->timestamp))->format('Y-m-d'),
            ]);
        }
    }
}
