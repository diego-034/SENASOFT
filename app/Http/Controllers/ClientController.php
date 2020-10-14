<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;

class ClientController extends Controller
{   

    private IModelRepository $IModelRepository;
    private $Client;

    public function __construct(IModelRepository $IModelRepository) 
    {   
        $this->IModelRepository = $IModelRepository;
        $this->Client = new Client();
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function List(Request $request)
    {
        try {
            $data = [];
            $data['Model'] = $this->Client;
            $data['Query'] = [
                'name',
                'lastname',
                'address',
                'document',
                'phone',
                'email',
                'created_at'
            ];
            $data['Row'] = 'name';
            $response = Json::Json($request, $data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return $this->SendResponse($response, 'success');
        } catch (Exception $ex) {
            return $this->SendError([$ex->getMessage()]);
        }
    }

    /**
     * Method for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Insert(Request $request)
    {
        try {
            if ($request->isMethod('GET')) {
                return view('view');
            }
            $data = [];
            $data['Model'] = $this->Client;
            $response = $this->IModelRepository->Insert($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
        } catch (Exception $ex) {
            return view('error');
        }
    }
        
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, Client $client)
    {
        try {
            $data = [];
            $data['Model'] = $this->Client;
            $response = $this->IModelRepository->Update($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
        } catch (Exception $ex) {
            return view('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function Delete(Client $client)
    {
        try {
            $data = [];
            $data['Model'] = $this->Client;
            $response = $this->IModelRepository->Delete($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }

        } catch (Exception $ex) {
            return view('error');
        }
    }

    /**
     * Search the specified resource with the filter.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function Find()
    {
        try {
            $data = [];
            $data['Model'] = $this->Client;
            $response = $this->IModelRepository->Delete($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
        } catch (Exception $ex) {
            return view('error');
        }
    }
}