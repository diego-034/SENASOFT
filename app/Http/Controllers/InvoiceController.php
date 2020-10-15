<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;
use App\Json\Json;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->Invoice = new Invoice();
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
                return view('invoices.invoices');
            }
            $data = [];
            $data['Model'] = $this->Invoice;
            $data['Query'] = [
                'id',
                'total',
                'total_discount',
                'total_iva',
                'state',
                'created_at'
            ];
            $data['Row'] = 'id';
            $response = Json::Json($request, $data);
            return response()->json($response);
        } catch (Exception $ex) {
            return $this->SendError([$ex->getMessage()]);
        }
    }


    public function AjaxTmpInvoice(Request $request) {
        $value = $request->post('value');
        $name = $request->post('name');
        if ($value && $name)
            Cache::put($name, $value);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Insert(Request $request)
    {

        DB::beginTransaction();
        try {


            if($request->isMethod('GET')) {
                return view('invoices.form-create',[
                    'products'=> Product::all()
                ]);
            }

            $data = [];
            $data['Model'] = $this->Invoice;
            $response = Validator::make($request->all(), [
                'invoice' => 'required'
            ]);

            if ($response->fails()) {
                throw new Exception('Error');
            }
            $items = $request->get('invoice');
            foreach($items as $item){
                $item['total'] = "1223";
                $item['total_discount'] = "333";
                $item['total_iva'] = "3443";
                $item['state'] = "1";
                $item['customer_id'] = "1";
                $item['user_id'] = "2";
                $data['Entity'] = $item;
                $response = $this->IModelRepository->Insert($data);
                if (isset($response['Error'])) {
                    throw new Exception($response['Error']->getMessage());
                }
            }
            DB::commit();
            return view('invoices.invoices');
        } catch (Exception $ex) {
            DB::rollback();
            return view('error');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, $id)
    {

        try {
            if($request->isMethod('GET')) {
                $response = $this->Find($id);
                return view('invoices.form-update')->with('response',$response);
                if (isset($response['Error'])) {
                    throw new Exception($response['Error']->getMessage());
                }
            }
            $data = [];
            $response = Validator::make($request->all(), [
                'producto' => 'required'
            ]);
            if ($response->fails()) {
                throw new Exception('Error');
            }
            $data = [];
            $data['Model'] = $this->Product;
            $items = $request->get('producto');
            foreach($items as $item){
                //$item['image'] = Cloudinary::upload($item->file('image')->getRealPath())->getSecurePath();
                $data['Entity']['id'] = $id;
                $data['Entity']['total'] = "aa";
                $data['Entity']['total_discount'] = "20";
                $data['Entity']['total_iva'] = "19";
                $data['Entity']['state'] = "1";
                $response = $this->IModelRepository->Update($data);
                if (isset($response['Error'])) {
                    throw new Exception($response['Error']->getMessage());
                }
            }
            return view('products.products');
        } catch (Exception $ex) {
            return view('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function Delete($id)
    {
        try {
            $data = [];
            $data['Model'] = $this->Invoice;
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
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function Find($id)
    {
        try {
            $data = [];
            $data['Model'] = $this->Invoice;
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
