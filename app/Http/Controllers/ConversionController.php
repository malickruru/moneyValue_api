<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use App\Models\Pairs;
use Illuminate\Http\Request;

class ConversionController extends ApiController
{
    public function convert(Request $request){
        $pair = Pairs::find($request->pair_id );
        $result = $request->amount*$pair->change_rate;
        $conversion = Conversion::create([
            'pair_id' => $request->pair_id,
            'amount' => $request->amount,
            'created_at' => now(),
        ]);

        return $this->success([
            'result' => $result,
            'conversion' => $conversion,
        ], 'conversion réussie');
    }

    public function sum(){
        return $this->success(Conversion::all()->countBy('pair_id'), 'états des conversion');
    }

    public function show(string $id){
        return $this->success(Conversion::all()->where('pair_id',$id)->sortBy('created_at')->values(), 'historique de conversion');
    }
}
