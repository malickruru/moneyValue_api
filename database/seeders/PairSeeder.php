<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class PairSeeder extends CurrencySeeder
{
    /**
     * Run the database seeds.
     */
    public function fetchPair($from, $to)
    {
        //GHS%2CXOF
        // Configuration de la requête
        $options = array(
            'http' => array(
                'method' => 'GET'
            )
        );

        // Création du flux de contexte
        $context = stream_context_create($options);

        // Exécution de la requête
        $result = file_get_contents("https://api.fastforex.io/fetch-multi?from=$from&to=$to&api_key=ae47014cb8-879a89ad5a-rw1rcg", false, $context);

        // Vérification de la réponse
        if ($result === FALSE) {
            // Erreur lors de la requête
            echo "Erreur lors de la requête API";
        } else {
            // Traitement de la réponse
           foreach (json_decode($result)->results as $key => $value) {
            DB::table('pairs')->insert([
                'from' => json_decode($result)->base,
                'to' => $key,
                'change_rate' =>$value,
                'created_at' => now(),
            ]);
           }
            
        }
        // $res = Http::get("https://api.fastforex.io/fetch-multi?from=$from&to=$to&api_key=ae47014cb8-879a89ad5a-rw1rcg");

    }

    function getCodes($base)  {
        $codes = [];
       foreach ($this->data() as $d) {
        if($d['code'] != $base){
            array_push($codes,$d['code']);
        }
       }
       return join('%2C',$codes) ;
    }



    public function run(): void
    {
        // print($this->getCodes('EUR'));
        // print($this->fetchPair('EUR', 'XOF'));
        foreach ($this->data() as $d) {
            $from = $d['code'];
            $to = $this->getCodes($from);
            $this->fetchPair($from, $to);
        }
    }
}
