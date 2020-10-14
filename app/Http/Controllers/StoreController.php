<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private IModelRepository $IModelRepository;
    private Store $Store;

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->Store = new Store();
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @param  \App\UserType  $userType
     * @return \Illuminate\Http\Response
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
