<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PetstoreApi {

    CONST BASE_URL = 'petstore.swagger.io/v2/pet/';

    public function findById($id){
        return Http::get(self::BASE_URL.$id);
    }


}
