<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\UserType;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;
use App\Json\Json;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class UserController extends Controller
{

    private $IModelRepository;
    private $User;

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->User = new User();
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
                return view('users.users');
            }
            $data = [];
            $data['Model'] = $this->User;
            $data['Query'] = [
                'id',
                'name',
                'lastname',
                'address',
                'email',
                'phone',
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

            
            // $data['Entity'] = [
            //     'user_type' => '1',
            //     'branch_id' => '1',
            //     'document' => "234234",
            //     'address' => 'Crr Test # Test -Test',
            //     'phone' => '3016850462',
            //     'name' => "Admin",
            //     'lastname' => "asd",
            //     'email' => "adamincito@maial.com",
            //     'password' => "$2y$10$/O2ETLscMHEBibQlrVTNd.OKhZ5oXAlcm3RZpArX1uMndRhJ.aAKG"
            // ];

    public function Insert(Request $request)
    {
        DB::beginTransaction();
        try {
            if($request->isMethod('GET')) {
                $Roles = UserType::all()->toArray();
                $branches = Branch::all()->toArray();
                return view('users.form-create',[
                    'Roles' => $Roles,
                    'branches' => $branches]);
            }
            $data = [];
            $data['Model'] = $this->User;

            $item = $request->all();
            $data['Entity'] = $item;
            $response = $this->IModelRepository->Insert($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            DB::commit();
            return view('users.users');
        } catch (Exception $ex) {
            DB::rollback();
            return view('error');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserType  $userType
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
                return view('users.form-update')->with('response', $response);
            }

            $data = [];
            $response = Validator::make($request->all(), [
                'user' => 'required'
            ]);
            if ($response->fails()) {
                throw new Exception('Error');
            }
            $data = [];
            $data['Model'] = $this->User;
            $items = $request->get('user');
            foreach($items as $item){
                //$item['image'] = Cloudinary::upload($item->file('image')->getRealPath())->getSecurePath();
                $data['Entity']['id'] = $id;
                $data['Entity']['name'] = "aa";
                $data['Entity']['lastname'] = "20";
                $data['Entity']['document'] = $item['value'];
                $data['Entity']['phone'] = "19";
                $data['Entity']['email'] = "newemail@example.com";
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
     * @param  \App\UserType  $userType
     * @return \Illuminate\Http\Response
     */

    public function Delete($id)
    {
        try {
            $data = [];
            $data['Model'] = $this->User;
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
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function Find($id)
    {
        try {
            $data = [];
            $data['Model'] = $this->User;
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
