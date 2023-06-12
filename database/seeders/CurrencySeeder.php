<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    public function data(){
        return [
            [
                'code' => 'EUR',
                'name' => 'Euro',
                'flag' => './img/euro.png',
            ],
            [
                'code' => 'GBP',
                'name' => 'Livre Britannique',
                'flag' => './img/gbp.png',
            ],
            [
                'code' => 'USD',
                'name' => 'Dollar américain',
                'flag' => './img/usd.jpeg',
            ],
            [
                'code' => 'CNY',
                'name' => 'Yuan chinois',
                'flag' => './img/cny.png',
            ],
            [
                'code' => 'XOF',
                'name' => 'Franc CFA',
                'flag' => './img/xof.png',
            ],
            [
                'code' => 'ZAR',
                'name' => 'Rand sud-africain',
                'flag' => './img/zar.png',
            ],
            [
                'code' => 'MAD',
                'name' => 'Dirham marocain',
                'flag' => './img/mad.png',
            ],
            [
                'code' => 'NGN',
                'name' => 'Naira nigériane',
                'flag' => './img/ngn.png',
            ],
            [
                'code' => 'GNF',
                'name' => 'Franc guinéen',
                'flag' => './img/guiné.png',
            ],
            [
                'code' => 'GHS',
                'name' => 'Cedi ghanéen',
                'flag' => './img/ghs.png',
            ],
    
            ];
    }  
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

            foreach ( $this->data() as $d) {
                DB::table('currencies')->insert([
                    'code' => $d['code'],
                    'name' => $d['name'],
                    'flag' => $d['flag'],
                ]);
            }
    }
}
