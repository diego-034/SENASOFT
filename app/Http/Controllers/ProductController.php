<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;

class ProductController extends Controller
{

    private $IModelRepository;
    private $Product;

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->Product = new Product();
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
                return view('products.products');
            }
            $data = [];
            $data['Model'] = $this->Product;
            $data['Query'] = [
                'id',
                'name',
                'stock',
                'description',
                'price',
                'image',
                'iva',
                'created_at'
            ];
            $data['Row'] = 'name';
            $response = Json::Json($request, $data);
            //$response = $this->IModelRepository->List($data);
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
            if($request->isMethod('GET')) {
                return view('products.form-create');
            }
            $data = [];
            $data['Model'] = $this->Product;
            $response = $this->IModelRepository->Insert($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return view('products.products');
        } catch (Exception $ex) {
            return view('error');
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, Product $product)
    {
        try {
            $data = [];
            $data['Model'] = $this->Product;
            $response = $this->IModelRepository->Update($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return view('products.products');
        } catch (Exception $ex) {
            return view('error');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function Delete(Product $product)
    {
        try {
            $data = [];
            $data['Model'] = $this->Product;
            $response = $this->IModelRepository->Delete($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return view('products.products');
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
            $data['Model'] = $this->Product;
            $response = $this->IModelRepository->Delete($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return view('products.products');
        } catch (Exception $ex) {
            return view('error');
        }
    }
}
