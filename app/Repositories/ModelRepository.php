<?php

namespace App\Repositories;

use App\Repositories\IRepository\IModelRepository;
use Exception;

class ModelRepository implements IModelRepository {

    private $Model;

    public function SetModel($Model)
    {
        $this->Model = $Model;
    }

    public function List($data) 
    {
        try {
            $response = [];
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::all();
            
            if (!$response['OK']) {
                $response['Error'] = new Exception("Error");
            }

            return $response;

        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }  
    }

    public function Insert($data)
    {
        try {
            $response = [];
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::create($data);

            if (!$response['OK']) {
                $response['Error'] = new Exception("Error");
            }

            return $response;

        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    public function Update($data)
    {
        try {
            $response = [];
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::update($data);

            if (!$response['OK']) {
                $response['Error'] = new Exception("Error");
            }

            return $response;

        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    public function Delete($data)
    {
        try {
            $response = [];
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::delete($data);

            if (!$response['OK']) {
                $response['Error'] = new Exception("Error");
            }

            return $response;

        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    public function Find($data)
    {
        try {
            $response = [];
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::find($data);

            if (!$response['OK']) {
                $response['Error'] = new Exception("Error");
            }

            return $response;
            
        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }
}