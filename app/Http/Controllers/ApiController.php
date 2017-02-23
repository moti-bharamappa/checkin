<?php

namespace App\Http\Controllers;

use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    const CODE_WRONG_ARGS = 'GEN_FUBARGS';
    
    const CODE_NOT_FOUND = 'GEN_LIKETHEWIND';
    
    const CODE_INTERNAL_ERROR = 'GEN_AAAGGH';
    
    const CODE_UNAUTHORIZED = 'GEN_MAYBGTFO';
    
    const CODE_FORBIDDEN= 'GEN_GTFO';

    protected $fractal;

    protected $statusCode = 200;

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    /**
     * Gets the value of statusCode.
     *
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * Sets the value of statusCode.
     *
     * @param mixed $statusCode the status code
     *
     * @return self
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    protected function respondWithItem($item, $callback)
    {
        $resource = new Item($item, $callback);
        $rootScope = $this->fractal->createData($resource);
        
        return $this->respondWithArray($this->rootScope->toArray());
    }

    protected function respondWithCollection($collection, $callback)
    {
        $resource = new Collection($collection, $callback);
        $rootScope = $this->fractal->createData($resource);

        return $this->respondWithArray($rootScope->toArray());
    }

    protected function respondWithArray(array $array, array $headers = [])
    {
        return Response::json($array, $this->statusCode, $headers);
    }

    protected function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200) {
            trigger_error("You better have really good reason for erroring on a 200...", E_USER_WARNING);
        }
        return $this->respondWithArray(
            [
                'error' => [
                    'code' => $errorCode,
                    'http_code' => $this->statusCode,
                    'message' => $message
                 ]
            ]
        );
    }

    protected function errorForbidden($message = "Forbidden")
    {
        return $this->setStatusCode(403)
            ->respondWithError($message, self::CODE_FORBIDDEN);
    }

    protected function errorInternalError($message="Internal Error")
    {
        return $this->setStatusCode(500)->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    protected function errorNotFound($message="Resource not found")
    {
        return $this->setStatusCode(404)->respondWithError($message, self::CODE_NOT_FOUND);
    }

    protected function errorUnauthorized($message="Unauthorized")
    {
        return $this->setStatusCode(401)->respondWithError($message, self::CODE_UNAUTHORIZED);
    }

    protected function errorWrongArgs($message="Wrong arguments")
    {
        return $this->setStatusCode(400)->respondWithError($message, self::CODE_WRONG_ARGS);
    }
}
