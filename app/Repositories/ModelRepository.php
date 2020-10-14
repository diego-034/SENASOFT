<?php

namespace App\Repositories;

use App\Repositories\IRepository\IModelRepository;
use Exception;

class ModelRepository implements IModelRepository {

    private $Model;

    /**
     * Set the model private
     *
     * @param Model Model send controller to repository
     */
    public function SetModel($Model)
    {
        $this->Model = $Model;
    }

    /**
     * List all data of DB
     *
     * @param Array Model, Data for search in group for words
     * @return Array Data of DB in $response
     */
    public function List($data) 
    {
        $response = array();
        try {
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::all();
            
            if ($response['OK'] ==  null) {
                $response['Error'] = new Exception("Error");
            }

            return $response;

        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }  
    }

    /**
     * Insert data in DB
     *
     * @param Array Model, Data of Models
     * @return Array Data of DB in $response
     */
    public function Insert($data)
    {
        $response = array();
        try {
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::create($data);

            if ($response['OK'] ==  null) {
                $response['Error'] = new Exception("Error");
            }

            return $response;

        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    /**
     * Update data in DB
     *
     * @param Array Model, Data of Models and Entity
     * @return Array Data of DB in $response
     */
    public function Update($data)
    { 
        $response = array();
        try {
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::find($data['Entity']['id']);
            if ($response['OK'] ==  null) {
                $response['Error'] = new Exception("Error");
            }
            $response['OK'] = $this->Model->where('id', $data['Entity']['id'])->update($data['Entity']);
            if ($response['OK'] ==  null) {
                $response['Error'] = new Exception("Error");
            }
            return $response;

        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    /**
     * Update data in DB
     *
     * @param Array Model, Data of Models and Entity
     * @return Array Data of DB in $response
     */
    public function Delete($data)
    {
        $response = array();
        try {
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::find($data['Entity']['id']);

            if ($response['OK'] == null) {
                $response['Error'] = new Exception("Error");
            }
            $response['OK'] = $this->Model::delete($data);
            if ($response['OK'] == null) {
                $response['Error'] = new Exception("Error");
            }
            return $response;

        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }

    /**
     * Find data in DB
     *
     * @param Array Model, Data of Models and Entity
     * @return Array Data of DB in $response
     */
    public function Find($data)
    {
        $response = array();
        try {
            $this->SetModel($data['Model']);
            $response['OK'] = $this->Model::find($data['Entity']['id']);
            if ($response['OK'] == null) {
                $response['Error'] = new Exception("Error");
            }
            return $response;           
        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }
}