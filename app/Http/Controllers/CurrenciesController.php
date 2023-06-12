<?php

namespace App\Http\Controllers;

use App\Models\Currencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CurrenciesController extends ApiController
{
    /**
     * afficher toutes les monnaie. api/currencies
     */
    public function index()
    {
        return $this->success(Currencies::all(), 'Liste des devises');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * créer un nouvelle monnaie. api/currencies
     */
    public function store(Request $request)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'flag' => 'required',
                'code' => 'required|max:3|unique:currencies',
                'name' => 'required',
            ]
        );



        if ($validated->fails()) {
            return $this->error($validated->errors(), 'echec de création de monnaie', 401);
        }


        $path = Storage::disk('local')->put('', $request->file('flag'));

        $currency = Currencies::create([
            'flag' => "/img/" . $path,
            'code' => $request->code,
            'name' => $request->name,
        ]);

        return $this->success($currency, 'Devise ajoutée avec succès');
    }

    /**
     * Display the specified resource. api/currencies/{currency}
     */
    public function show(string $code)
    {

        return $this->success(Currencies::find($code), 'Devises :' . $code);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage. api/currencies/{currency}
     */
    public function update(Request $request, string $code)
    {
        $validated = Validator::make(
            $request->all(),
            [
                'code' => 'max:3|unique:currencies',
            ]
        );

        if ($validated->fails()) {
            return $this->error($validated->errors(), 'echec de modification de monnaie', 401);
        }

        if ($request->flag != null) {
            $path = Storage::disk('local')->put('', $request->file('flag'));
        }

        $currency = Currencies::find($code);

        
        $currency->flag = $request->flag != null ? "/img/" . $path : $currency->flag;
        $currency->code = $request->code != null ? $request->code : $currency->code;
        $currency->name = $request->name != null ? $request->name : $currency->name;

        $currency->save();

        return $this->success($currency, 'Mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage. api/currencies/{currency}
     */
    public function destroy(string $code)
    {
        $currency = Currencies::find($code);
        $currency->delete(); 
        return $this->success($currency, 'suppression réussie');
    }
}
