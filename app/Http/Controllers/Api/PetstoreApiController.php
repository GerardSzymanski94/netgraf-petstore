<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Petstore\FindPetRequest;
use App\Http\Requests\Petstore\StoreRequest;
use App\Http\Requests\Petstore\UpdateRequest;
use App\Services\PetstoreApi;
use App\Helpers\PetstoreApiDataParser;
use Exception;
use Illuminate\Support\Facades\Log;

class PetstoreApiController extends Controller
{
    public function index(){
        return view('petstore.index');
    }

    public function find(FindPetRequest $request){
        try{
            $response = (new PetstoreApi())->findById($request->input('pet_id'));
        }catch(Exception $e){
            Log::error($e);
            return redirect()->route('index')
                ->with(['error' => 'Something went wrong!',
                    'petId' => $request->input('pet_id')]);
        }
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

    public function edit($id){

        try{
            $response = (new PetstoreApi())->findById($id);
        }catch(Exception $e){
            Log::error($e);
            return redirect()->route('index')
                ->with(['error' => 'Something went wrong!',
                    'petId' => $id]);
        }

        if(!$response){
            return redirect()->route('index')->with(['error' => 'Something went wrong!']);
        }
        if($response->getStatusCode() != 200){
            return redirect()->route('index')
                ->with(['error' => $response->json()['message'] ?? 'Something went wrong!',
                    'errorCode' => $response->getStatusCode() ?? null,
                    'petId' => $id]);
        }

        return view('petstore.edit')->with(['pet' => $response->json() ?? null]);
    }

    public function update(UpdateRequest $request, $id){

        try{
            $data = PetstoreApiDataParser::requestToArray($request->all());
            $response = (new PetstoreApi())->update(['id' => $id, ...$data]);
        }catch(Exception $e){
            Log::error($e);
            return redirect()->route('index')
                ->with(['error' => 'Something went wrong!']);
        }

        if(!$response){
            return redirect()->back()->with(['error' => 'Something went wrong!']);
        }
        if($response->getStatusCode() != 200){
            return redirect()->back()
                ->with(['error' => $response->json()['message'] ?? 'Something went wrong!',
                    'errorCode' => $response->getStatusCode() ?? null]);
        }


        if($request->hasFile('photo')){
            try{
                $response = (new PetstoreApi())->uploadPhoto($id, $request->file('photo'), $request->additional_metadata ?? null);
            }catch(Exception $e){
                Log::error($e);
                return redirect()->route('index')
                    ->with(['error' => 'Something went wrong!',
                        'petId' => $request->input('pet_id')]);
            }
            if(!$response){
                return redirect()->back()->with(['error' => 'Something went wrong!']);
            }
            if($response->getStatusCode() != 200){
                return redirect()->back()
                    ->with(['error' => $response->json()['message'] ?? 'Something went wrong!',
                        'errorCode' => $response->getStatusCode() ?? null]);
            }
        }

        return redirect()->back()
            ->with(['success' => 'Pet has been successfully updated']);
    }
    public function create(){
        return view('petstore.create');
    }
    public function store(StoreRequest $request){
        try{
            $data = PetstoreApiDataParser::requestToArray($request->all());
            $response = (new PetstoreApi())->create($data);
        }catch(Exception $e){
            Log::error($e);
            return redirect()->route('index')
                ->with(['error' => 'Something went wrong!']);
        }

        if(!$response){
            return redirect()->back()->with(['error' => 'Something went wrong!']);
        }
        if($response->getStatusCode() != 200){
            return redirect()->back()
                ->with(['error' => $response->json()['message'] ?? 'Something went wrong!',
                    'errorCode' => $response->getStatusCode() ?? null]);
        }

        $petId = $response->json()['id'] ?? null;

        if($petId && $request->hasFile('photo')){
            try{
                $response = (new PetstoreApi())->uploadPhoto($petId, $request->file('photo'), $request->additional_metadata ?? null);
                Log::debug('photo');
            }catch(Exception $e){
                Log::error($e);
                return redirect()->route('index')
                    ->with(['error' => 'Something went wrong!',
                        'petId' => $request->input('pet_id')]);
            }
            if(!$response){
                return redirect()->back()->with(['error' => 'Something went wrong!']);
            }
            if($response->getStatusCode() != 200){
                return redirect()->back()
                    ->with(['error' => $response->json()['message'] ?? 'Something went wrong!',
                        'errorCode' => $response->getStatusCode() ?? null]);
            }
        }


        return redirect()->route('index')
            ->with(['success' => 'Pet has been successfully created']);


    }
    public function delete($id){
        try{
            $response = (new PetstoreApi())->delete($id);
        }catch(Exception $e){
            Log::error($e);
            return redirect()->route('index')
                ->with(['error' => 'Something went wrong!']);
        }
        if(!$response){
            return redirect()->back()->with(['error' => 'Something went wrong!']);
        }
        if($response->getStatusCode() != 200){
            return redirect()->back()
                ->with(['error' => $response->json()['message'] ?? 'Something went wrong!',
                    'errorCode' => $response->getStatusCode() ?? null]);
        }
        return redirect()->route('index')
            ->with(['success' => 'Pet has been successfully deleted']);
    }

}
