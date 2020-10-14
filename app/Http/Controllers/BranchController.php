<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{

    private IModelRepository $IModelRepository;
    private $Branch;

    public function __construct(IModelRepository $IModelRepository) 
    {   
        $this->IModelRepository = $IModelRepository;
        $this->Branch = new Branch();
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
            $data['Model'] = $this->Branch;
            $data['Query'] = [
                'name',
                'address',
                'phone',
            ];
            $data['Row'] = 'name';
            Json::Json($request, $data);
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
            $data['Model'] = $this->Branch;
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
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, Branch $branch)
    {
        try {
            $data = [];
            $data['Model'] = $this->Branch;
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
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function Delete(Branch $branch)
    {
        try {
            $data = [];
            $data['Model'] = $this->Branch;
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
     * @param  \App\Branch  $branch
     * @return \Illuminate\Http\Response
     */
    public function Find()
    {
        try {
            $data = [];
            $data['Model'] = $this->Branch;
            $response = $this->IModelRepository->Delete($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
        } catch (Exception $ex) {
            return view('error');
        }
    }
}
