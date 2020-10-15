<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;
use App\Json\Json;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{   

    private $IModelRepository;
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
            if($request->isMethod('GET')) {
                return view('view');
            }
            $data = [];
            $data['Model'] = $this->Client;
            $data['Query'] = [
                'id',
                'name',
                'lastname',
                'document',
                'phone',
                'email',
                'created_at'
            ];
            $data['Row'] = 'name';
            $response = Json::Json($request, $data);
            return response()->json($response);
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
        DB::beginTransaction();
        try {
            if($request->isMethod('GET')) {
                return view('customers.form-create');
            }
            $data = [];
            $data['Model'] = $this->Client;
            $response = Validator::make($request->all(), [
                'customer' => 'required'
            ]);

            if ($response->fails()) {
                throw new Exception('Error');
            }
            $items = $request->get('customer');
            foreach($items as $item){
                $item['name'] = "as";
                $item['lastname'] = "sa";
                $item['address'] = "address";
                $item['document'] = "1112233";
                $item['phone'] = "12345";
                $item['email'] = "example@example.com";
                $item['branch_id'] = "1";
                $data['Entity'] = $item; 
                $response = $this->IModelRepository->Insert($data);
                if (isset($response['Error'])) {
                    throw new Exception($response['Error']->getMessage());
                }
            }
            DB::commit();
            return view('customers.customer');
        } catch (Exception $ex) {
            DB::rollback();
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
    public function Delete($id)
    {
        try {
            $data = [];
            $data['Model'] = $this->Client;
            $data['Entity']['id'] = $id;
            $response = $this->IModelRepository->Delete($data);
            if (isset($response['Error'])) {
                return response()->json(false);
            }
            return response()->json($response['OK']);
        } catch (Exception $ex) {
            return response()->json(false);
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