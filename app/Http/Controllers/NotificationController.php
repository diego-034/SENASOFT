<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Repositories\IRepository\IModelRepository;
use Exception;
use App\Json\Json;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    private $IModelRepository;
    private $Notification;

    public function __construct(IModelRepository $IModelRepository)
    {
        $this->IModelRepository = $IModelRepository;
        $this->Notification = new Notification();
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
            $data['Model'] = $this->Notification;
            $data['Query'] = [
                'id',
                'name',
                'content',
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
                return view('view');
            }
            $data = [];
            $data['Model'] = $this->Notification;
            $response = Validator::make($request->all(), [
                'notification' => 'required'
            ]);

            if ($response->fails()) {
                throw new Exception('Error');
            }
            $items = $request->get('notification');
            foreach($items as $item){
                $item['name'] = "as";
                $item['content'] = "aaa";
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
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function Update(Request $request, Notification $notification)
    {
        try {
            $data = [];
            $data['Model'] = $this->Notification;
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
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function Delete($id)
    {
        try {
            $data = [];
            $data['Model'] = $this->Notification;
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
     * @param  \App\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function Find()
    {
        try {
            $data = [];
            $data['Model'] = $this->Notification;
            $response = $this->IModelRepository->Delete($data);
            if (isset($response['Error'])) {
                throw new Exception($response['Error']->getMessage());
            }
        } catch (Exception $ex) {
            return view('error');
        }
    }
}
