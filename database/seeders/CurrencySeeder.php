<?php

namespace Database\Seeders;

use App\Models\Currencies;
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
                'symbol' => '€',
            ],
            [
                'code' => 'GBP',
                'name' => 'Livre Britannique',
                'flag' => './img/gbp.png',
                'symbol' => '£',
            ],
            [
                'code' => 'USD',
                'name' => 'Dollar américain',
                'flag' => './img/usd.jpeg',
                'symbol' => '$',
            ],
            [
                'code' => 'CNY',
                'name' => 'Yuan chinois',
                'flag' => './img/cny.png',
                'symbol' => '¥',
            ],
            [
                'code' => 'XOF',
                'name' => 'Franc CFA',
                'flag' => './img/xof.png',
                'symbol' => 'CFA',
            ],
            [
                'code' => 'ZAR',
                'name' => 'Rand sud-africain',
                'flag' => './img/zar.png',
                'symbol' => 'R',
            ],
            [
                'code' => 'MAD',
                'name' => 'Dirham marocain',
                'flag' => './img/mad.png',
                'symbol' => 'MAD',
            ],
            [
                'code' => 'NGN',
                'name' => 'Naira nigériane',
                'flag' => './img/ngn.png',
                'symbol' => '₦',
            ],
            [
                'code' => 'GNF',
                'name' => 'Franc guinéen',
                'flag' => './img/guiné.png',
                'symbol' => 'FG',
            ],
            [
                'code' => 'GHS',
                'name' => 'Cedi ghanéen',
                'flag' => './img/ghs.png',
                'symbol' => 'GH₵',
            ],
    
            ];
    }  
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        

            // foreach ( $this->data() as $d) {
            //     DB::table('currencies')->insert([
            //         'code' => $d['code'],
            //         'name' => $d['name'],
            //         'flag' => $d['flag'],
            //     ]);
            // }

            foreach ($this->data() as $d) {
                $currency = Currencies::find($d['code']);
                $currency->symbol = $d['symbol'];
                $currency->save();
            }
    }
}
