<?php

namespace App\Http\Controllers;

use App\Place;
use Illuminate\Http\Request;
use App\Transformers\PlaceTransformer;
use App\Http\Controllers\ApiController;

class PlaceController extends ApiController
{
    public function getAll()
    {
        $places = Place::all();
        
        $this->respondWithCollection($places, new PlaceTransformer);
    }

    public function findOneById(Request $request)
    {
        if ($this->validate($request, ['id'=> 'required'])) {
            return $this->errorWrongArgs();
        }

        $place = Place::where('id', $request->input('id'))->first();

        return $this->respondWithItem($place, new PlaceTransformer);
    }
}
