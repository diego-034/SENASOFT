<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;
use App\Json\Json;
use Illuminate\Support\Facades\Validator;

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
        try {
            if ($request->isMethod('GET')) {
                $Roles = UserType::all()->toArray();
                return view('users.form-create',['Roles' => $Roles]);
            }

        } catch (Exception $ex) {
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
