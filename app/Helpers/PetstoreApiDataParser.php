<?php

namespace App\Helpers;

class PetstoreApiDataParser {
    public static function requestToArray($data): array{
        $result = [];

        $result['name'] = $data['name'];

        if(isset($data['category'])){
            $category = explode('_',$data['category']);
            $result['category'] = [
                'id' => $category[0],
                'name' => $category[1]
            ];
        }
        if(isset($data['photoUrls'])){
            $result['photoUrls'] = explode(',', $data['photoUrls']);
        }
        if(isset($data['tags'])){
            foreach ($data['tags'] as $key=>$tag){
                $result['tags'][] = [
                    'id' => $key,
                    'name' => $tag
                ];
            }
        }
        if(isset($data['status'])){
            $result['status'] = $data['status'];

        }
        return $result;
    }
}
