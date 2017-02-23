<?php

namespace App\Transformers;

use App\Place;
use League\Fractal\TransformerAbstract;

class PlaceTransformer extends TransformerAbstract
{
    public function transform(Place $place)
    {
        return [
            'name' => $place->name,
            'lat' => $place->lat,
            'long' => $place->long,
            'website' => $place->website,
            'address1' => $place->address1,
            'address2' => $place->address2,
            'zip' => $place->zip,
            'city' => $place->city,
            'state' => $place->state,
            'phone' => $place->phone
        ];
    }
}