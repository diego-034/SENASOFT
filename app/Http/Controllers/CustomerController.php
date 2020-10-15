<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;
use App\Json\Json;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{   

    private $IModelRepository;
    private $Customer;

    public function __construct(IModelRepository $IModelRepository) 
    {   
        $this->IModelRepository = $IModelRepository;
        $this->Customer = new Customer();
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
                return view('customers.customers');
            }
            $data = [];
            $data['Model'] = $this->Customer;
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
            $data['Model'] = $this->Customer;
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
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, $id)
    {
        try {
            if($request->isMethod('GET')) {
                $response = $this->Find($id);
                if (isset($response['Error'])) {
                    throw new Exception($response['Error']->getMessage());
                }
                return view('customers.form-update')->with('response',$response);
            }
            $data = [];
            $response = Validator::make($request->all(), [
                'customer' => 'required'
            ]);
            if ($response->fails()) {
                throw new Exception('Error');
            }
            $data = [];
            $data['Model'] = $this->Customer;
            $items = $request->get('customer');
            foreach($items as $item){
                //$item['image'] = Cloudinary::upload($item->file('image')->getRealPath())->getSecurePath();
                $data['Entity']['name'] = $id;
                $data['Entity']['lastname'] = "aa";
                $data['Entity']['address'] = "20";
                $data['Entity']['document'] = "5555";
                $data['Entity']['phone'] = "19";
                $data['Entity']['email'] = "newemail@example.com";
                $data['Entity']['name'] = $item['name'];
                $response = $this->IModelRepository->Update($data);
                if (isset($response['Error'])) {
                    throw new Exception($response['Error']->getMessage());
                }
            }
            return view('customers.customers');
        } catch (Exception $ex) {
            return view('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function Delete($id)
    {
        try {
            $data = [];
            $data['Model'] = $this->Customer;
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
     * @param  \App\Customer  $Customer
     * @return \Illuminate\Http\Response
     */
    public function Find($id)
    {
        try {
            $data = [];
            $data['Model'] = $this->Customer;
            $data['Entity']['id'] = $id;
            $response = $this->IModelRepository->Find($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return $response;
        } catch (Exception $ex) {
            $response['Error'] = $ex;
            return $response;
        }
    }
}