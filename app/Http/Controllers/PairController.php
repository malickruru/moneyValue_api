<?php

namespace App\Http\Controllers;

use App\Models\Currencies;
use App\Models\Pairs;
use Illuminate\Http\Request;

class PairController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->success(Pairs::all(), 'Liste des pairs de devises');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $from = Currencies::find($request->from);
        
        if($from->pair()->where('to',$request->to)->exists() ){
            return $this->error([], 'la paire existe déja',401);
        }
        $from->pair()->attach($request->to, ['change_rate' => $request->change_rate,'created_at' => now()]);
        $pair = Pairs::all()->last();
        return $this->success($pair, 'Paire créer avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->success([
            'paires' => Pairs::find($id),
            'nbr_conversions' => Pairs::find($id)->total()
        ],
        'Pair n° :' . $id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pair = Pairs::find($id);

        
        $pair->change_rate = $request->change_rate;
       
        $pair->save();

        return $this->success($pair, 'Mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pair = Pairs::find($id);
        $pair->delete(); 
        return $this->success($pair, 'suppression réussie');
    }
}
