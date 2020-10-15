<?php

namespace App\Http\Controllers;

use App\Models\InvoiceDetail;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;
use App\Json\Json;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class InvoiceDetailController extends Controller
{
    private $IModelRepository;
    private $InvoiceDetail;

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->InvoiceDetail = new InvoiceDetail();
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
            $data['Model'] = $this->InvoiceDetail;
            $data['Query'] = [
                'id',
                'quantity',
                'total',
                'discount',
                'iva',
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
     * Method for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Insert(Request $request)
    {

        DB::beginTransaction();
        try {
            if($request->isMethod('GET')) {
                return view('view');
            }
            $data = [];
            $data['Model'] = $this->InvoiceDetail;
            $response = Validator::make($request->all(), [
                'invoicedetail' => 'required'
            ]);

            if ($response->fails()) {
                throw new Exception('Error');
            }
            $items = $request->get('invoicedetail');
            foreach($items as $item){
                $item['quantity'] = "20";
                $item['total'] = "20";
                $item['discount'] = "10";
                $item['iva'] = "19";
                $item['state'] = "1";
                $item['product_id'] = "1";
                $item['invoice_id'] = "1";
                $data['Entity'] = $item; 
                $response = $this->IModelRepository->Insert($data);
                if (isset($response['Error'])) {
                    throw new Exception($response['Error']->getMessage());
                }
            }
            DB::commit();
            return view('view');
        } catch (Exception $ex) {
            DB::rollback();
            return view('error');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceDetail  $invoicedetail
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, InvoiceDetail $invoicedetail)
    {
        try {
            $data = [];
            $data['Model'] = $this->InvoiceDetail;
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
     * @param  \App\InvoiceDetail  $invoicedetail
     * @return \Illuminate\Http\Response
     */
    public function Delete($id)
    {
        try {
            $data = [];
            $data['Model'] = $this->InvoiceDetail;
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
     * @param  \App\InvoiceDetail  $invocedetail
     * @return \Illuminate\Http\Response
     */
    public function Find()
    {
        try {
            $data = [];
            $data['Model'] = $this->InvoiceDetail;
            $response = $this->IModelRepository->Delete($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
        } catch (Exception $ex) {
            return view('error');
        }
    }
}
