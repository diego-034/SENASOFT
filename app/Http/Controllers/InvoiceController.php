<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;
use App\Json\Json;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function Insert(Request $request)
    {

        $products = Product::all()->toArray();

        DB::beginTransaction();
        try {
            if($request->isMethod('GET')) {
                return view('invoices.form-create',['products'=> $products]);
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
    public function Update(Request $request, Invoice $invoice)
    {
        try {
            $data = [];
            $data['Model'] = $this->Invoice;
            $response = $this->IModelRepository->Update($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return view('invoices.form-update');
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
    public function Find()
    {
        try {
            $data = [];
            $data['Model'] = $this->Invoice;
            $response = $this->IModelRepository->Delete($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
        } catch (Exception $ex) {
            return view('error');
        }
    }
}
