<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class PetstoreApi {

    CONST BASE_URL = 'https://petstore.swagger.io/v2/pet/';

    public function findById($id){
        return Http::get(self::BASE_URL.$id);
    }

    public function update($data)
    {
        $response = Http::put(self::BASE_URL, $data);

        return $response;
    }

    public function create($data)
    {
        $response = Http::post(self::BASE_URL, $data);

        return $response;
    }
    public function delete($id)
    {
        $response = Http::delete(self::BASE_URL.$id);

        return $response;
    }


    public function uploadPhoto($id, UploadedFile $file, $additionalMetadata = null)
    {
        $response = Http::attach(
            'file',
            file_get_contents($file),
            $file->getClientOriginalName()
        )->post(self::BASE_URL."$id/uploadImage", [
            'additionalMetadata' => $additionalMetadata,
            'id' => $id
        ]);

        return $response;
    }
}
