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
        $result['photoUrls'] = [];
        if(isset($data['photos'])){
            foreach ($data['photos'] as $photo){
                $result['photoUrls'][] = $photo;
            }
        }
        if(isset($data['tags'])){
            foreach ($data['tags'] as $tag){
                $explodeTag = explode('_', $tag);
                $result['tags'][] = [
                    'id' => $explodeTag[0],
                    'name' => $explodeTag[1]
                ];
            }
        }
        if(isset($data['status'])){
            $result['status'] = $data['status'];

        }
        return $result;
    }
}
