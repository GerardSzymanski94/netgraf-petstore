<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class PetstoreApi {

    CONST BASE_URL = 'https://petstore.swagger.io/v2/pet/';

    public function findById($id): Response
    {
        return Http::get(self::BASE_URL.$id);
    }

    public function update($data): Response
    {
        $response = Http::put(self::BASE_URL, $data);

        return $response;
    }

    public function create($data): Response
    {
        $response = Http::post(self::BASE_URL, $data);

        return $response;
    }
    public function delete($id): Response
    {
        $response = Http::delete(self::BASE_URL.$id);

        return $response;
    }


    public function uploadPhoto($id, UploadedFile $file, $additionalMetadata = null): Response
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

    public function findByStatus($status): Response {
        return Http::get(self::BASE_URL."findByStatus?status=$status");
    }
}
