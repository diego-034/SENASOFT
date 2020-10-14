<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;

class ProductController extends Controller
{

    private IModelRepository $IModelRepository;
    private Product $Product;

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->Product = new Product();
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function List()
    {
        try {
            $data = [];
            $data['Model'] = $this->Product;
            $response = $this->IModelRepository->List($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return view('products.products')->with('response', $response);
        } catch (Exception $ex) {
            $this->error();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function Insert()
    {
        try {
            $data = [];
            $data['Model'] = $this->Product;
            $response = $this->IModelRepository->Insert($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return view('products.products')->with('response', $response);
        } catch (Exception $ex) {
            $this->error();
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
            $Response = $this->IModelRepository->Update($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return view('products.products')->with('response', $response);
        } catch (Exception $ex) {
            $this->error();
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
            $Response = $this->IModelRepository->Delete($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return view('products.products')->with('response', $response);
        } catch (Exception $ex) {
            $this->error();
        }
    }
}
