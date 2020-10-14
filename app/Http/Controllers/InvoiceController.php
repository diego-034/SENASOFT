<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;
use App\Json\Json;

class InvoiceController extends Controller
{

    public function __construct(IModelRepository $IModelRepository) 
    {
        $this->IModelRepository = $IModelRepository;
        $this->Product = new Invoice();
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
                'state'
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
        try {
            if($request->isMethod('GET')) {
                return view('invoices.form-create');
            }
            $data = [];
            $data['Model'] = $this->Invoice;
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
    public function Delete(Invoice $invoice)
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

    /**
     * Search the specified resource with the filter.
     *
     * @param  \App\Product  $product
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
