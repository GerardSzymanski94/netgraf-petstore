<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Petstore\FindPetRequest;
use App\Services\PetstoreApi;

class PetstoreApiController extends Controller
{
    public function index(){
        return view('petstore.index');
    }

    public function find(FindPetRequest $request){
        $response = (new PetstoreApi())->findById($request->input('pet_id'));
        if(!$response){
            return redirect()->route('index')->with(['error' => 'Something went wrong!']);
        }
        if($response->getStatusCode() != 200){
            return redirect()->route('index')
                ->with(['error' => $response->json()['message'] ?? 'Something went wrong!',
                    'errorCode' => $response->getStatusCode() ?? null,
                    'petId' => $request->input('pet_id')]);
        }


        return redirect()->route('index')->with(['pet' => $response->json() ?? null]);
    }

}
