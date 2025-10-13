<?php

namespace App\Http\Controllers\UserConfig;

use App\Http\Controllers\Controller;
use App\Models\UserConfig\BranchInfo;
use App\Models\WebSetup\SidebarNav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BranchInfoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_branch', ['only' => ['create']]);
        $this->middleware('permission:view_branch', ['only' => ['index']]);
        $this->middleware('permission:update_branch', ['only' => ['edit']]);
        $this->middleware('permission:delete_branch', ['only' => ['destroy']]);
    }
    public function index()
    {
        $this->checkLogin();
        return view('UserConfig.branch.showBranchInfo');
    }

    public function create()
    {
        $this->checkLogin();
        return view('UserConfig.branch.createBranchInfo');
    }

    public function edit($id)
    {
        $this->checkLogin();
        $rowItem = BranchInfo::where('uid', $id)->first();
        return view('UserConfig/branch/editBranchInfo', ['rowItem' => $rowItem]);
    }

    public function store(Request $request){
        try {

            if ($request['id']==""){

                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required',
                    'address' => 'required',
                    'status' => 'required',
                ]);

                if ($validator->fails()) {
                    return json_encode(array('statusCode' => 204,'statusMsg' => 'Validation Error.', 'errors' => $validator->errors()));
                }

                $data = BranchInfo::create([
                    'uid' => Str::uuid(),
                    'name' =>$request->name,
                    'phone' =>$request->phone ?: '',
                    'email' =>$request->email,
                    'address' =>$request->address ?: '',
                    'status' =>$request->status,
                    'create_by' => auth()->user()->id,
                    'create_date' => $this->getCurrentDateTime()
                ]);

                return json_encode(array(
                    "statusCode" => 200,
                    "statusMsg" => "Data Added Successfully"
                ));
            }

            else{
                $id = $request['id'];
                $navItem = BranchInfo::find($id);

                if (!$navItem) {
                    return response()->json([
                        'statusCode' => 404,
                        'statusMsg' => 'Item not found.',
                    ]);
                }

                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required',
                    'address' => 'required',
                    'status' => 'required',
                ]);

                if ($validator->fails()) {
                    return json_encode(array('statusCode' => 204,'statusMsg' => 'Validation Error.', 'errors' => $validator->errors()));
                }

                $navItem->update([
                    'name' =>$request->name,
                    'phone' =>$request->phone ?: '',
                    'email' =>$request->email,
                    'address' =>$request->address ?: '',
                    'status' =>$request->status,
                    'update_by' => auth()->user()->id,
                    'update_date' => $this->getCurrentDateTime()
                ]);

                return json_encode(array(
                    "statusCode" => 200,
                    "statusMsg" => "Data Updated Successfully"
                ));
            }

        } catch (\Exception $e) {
            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));
        }
    }

    public function destroy($id){
        try {
            $permission = BranchInfo::where('uid', $id)->first();
            $permission->delete();
            return json_encode(array(
                "statusCode" => 200
            ));
        } catch (\Exception $e) {
            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));
        }
    }

    public function getData(Request $request)
    {
        // Fetch all items with their hierarchy
        $query = DB::table('sms_branch_info as p')
            ->select('p.id', 'p.uid', 'p.name', 'p.phone', 'p.email','p.address', 'p.status')
            ->where('p.status', '!=', 'Deleted');

        // Search functionality
        if (isset($request->search['value'])) {
            $query->where('name', 'like', '%' . $request->search['value'] . '%');
        }

        // Ordering
        if ($request->has('order')) {
            $query->orderBy($request->columns[$request->order[0]['column']]['data'], $request->order[0]['dir']);
        }

        // Pagination
        $totalCount = $query->count();
        $filteredCount = $query->count();

        $data = $query->skip($request->input('start', 0))
            ->take($request->input('length', 10))
            ->get();

        return response()->json([
            'draw' => $request->draw,
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $filteredCount,
            'data' => $data,
        ]);
    }
}
