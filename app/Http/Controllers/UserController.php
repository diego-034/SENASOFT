<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\UserType;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;
use App\Json\Json;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

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
    public function Insert(Request $request)
    {

        DB::beginTransaction();
        try {
            if($request->isMethod('GET')) {
                $Roles = UserType::all()->toArray();
                return view('users.form-create',['Roles' => $Roles]);
            }
            $data = [];
            $data['Model'] = $this->User;
            $response = Validator::make($request->all(), [
                'user' => 'required'
            ]);

            if ($response->fails()) {
                throw new Exception('Error');
            }
            $items = $request->get('user');
            foreach($items as $item){
                $item['name'] = "as";
                $item['lastname'] = "ee";
                $item['address'] = "adas";
                $item['document'] = "19999999";
                $item['phone'] = "145665";
                $item['email'] = "example@example.com";
                $item['password'] = Hash::make('12345678');
                $item['user_type'] = "12345";
                $item['branch_id'] = "1";
                $data['Entity'] = $item; 
                $response = $this->IModelRepository->Insert($data);
                if (isset($response['Error'])) {
                    throw new Exception($response['Error']->getMessage());
                }
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
    public function Update(UserType $userType)
    {
        return view('users.form-update');
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
    public function Find()
    {
        try {
            $data = [];
            $data['Model'] = $this->User;
            $response = $this->IModelRepository->Delete($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
            return view('users.users');
        } catch (Exception $ex) {
            return view('error');
        }
    }
}
