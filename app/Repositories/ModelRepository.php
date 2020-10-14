<?php

namespace App\Repositories;

use App\Repositories\IRepository\IModelRepository;
use Exception;

class ModelRepository implements IModelRepository {

    private $model;

    public function SetModel($model)
    {
        $this->model = $model;
    }

    public function List($data) 
    {
        try {
            $response = [];

        } catch (\Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }  
    }

    public function Insert($data)
    {
        try {
            $response = [];

        } catch (\Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    public function Update($data)
    {
        try {
            $response = [];

        } catch (\Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    public function Delete($data)
    {
        try {
            $response = [];

        } catch (\Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    public function Find($data)
    {
        try {
            $response = [];
            
        } catch (\Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }
}