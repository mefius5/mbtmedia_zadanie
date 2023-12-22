<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdditionalLogoStoreRequest;
use App\Models\AdditionalClientLogo;
use App\Models\Client;
use Illuminate\Support\Facades\Storage;

class AdditionalClientLogoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdditionalLogoStoreRequest $request, Client $client)
    {
        $logo = $request->validated()['logo'];

        $logo->store('/public');

        AdditionalClientLogo::create([
            'name' => $logo->hashName(),
            'client_id' => $client->id
        ]);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AdditionalClientLogo $additional_logo)
    {
        Storage::delete('public/' . $additional_logo->name);
        $additional_logo->delete();

        return back();
    }

}