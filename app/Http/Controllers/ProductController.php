<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;
use App\Json\Json;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Image;
use Excel;

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
                return view('products.form-create');
            }
            $data = [];
            $data['Model'] = $this->Product;
            if($request->file('excel')){
                $this->importExcel($request->file('excel'));
                return view('products.products');
            }
            $response = Validator::make($request->all(), [
                'producto' => 'required'
            ]);

            if ($response->fails()) {
                throw new Exception('Error');
            }
            $items = $request->get('producto');
            foreach($items as $key => $item){
                $item['image'] =  $this->SaveImage($request->file("producto.{$key}.image"));
                $item['price'] = $item['value'];
                $item['iva'] = "19";
                $item['branch_id'] = "1";
                $data['Entity'] = $item;
                $response = $this->IModelRepository->Insert($data);
                if (isset($response['Error'])) {
                    throw new Exception($response['Error']->getMessage());
                }
            }
            DB::commit();
            return view('products.products');
        } catch (Exception $ex) {
            DB::rollback();
            return view('error');
        }
    }
    
    public function SaveImage($file){
        $imageResize = Image::make($file->getRealPath());
        $imageResize->resize(350, null, function($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        }); 
        $imageResize->orientate();
        $nombre = sprintf('%s.png', md5($file->getClientOriginalName() . time()));
        Storage::disk('public')->put($nombre, $imageResize->stream());
        return $nombre;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, Product $product,$id)
    {
        try {
            if($request->isMethod('GET')) {
                $response = $this->Find($id);
                if (isset($response['Error'])) {
                    throw new Exception($response['Error']->getMessage());
                }
                return view('products.form-update')->with('response',$response);
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
                $data['Entity']['image'] = "aa";
                $data['Entity']['stock'] = $item['stock'];
                $data['Entity']['price'] = $item['value'];
                $data['Entity']['iva'] = "19";
                //$data['Entity']['branch_id'] = "1";
                $data['Entity']['description'] = $item['description'];
                $data['Entity']['name'] = $item['name'];
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function Delete($id)
    {
        try {
            $data = [];
            $data['Model'] = $this->Product;
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
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function Find($id)
    {
        try {
            $data = [];
            $data['Model'] = $this->Product;
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


    public function importExcel($file)
    {
        // $name = $file->getClientOriginalName();
        // Storage::disk('public')->put("excel/".$name, File::get($file));
        Excel::load("/storage/excel/Excel_Prueba.xlsx", function ($reader) {
            $data = $reader->get();
            foreach ($data as $key => $row) {
                $product = [
                    'name' => $row['name'],
                    'stock' => $row['stock'],
                    'description' => $row['description'],
                    'price' => $row['price'],
                    'image' => $row['image'],
                    'iva' => $row['iva'],
                    'branch_id' => $row['branch_id']
                ];
                if (!empty($product)) {
                    DB::table('products')->insert($product);
                }
            }
        });
    }
}
