<?php

namespace App\Http\Controllers\UserConfig;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Models\UserConfig\BranchInfo;
use App\Models\WebSetup\SidebarNav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_user', ['only' => ['create']]);
        $this->middleware('permission:view_user', ['only' => ['index']]);
        $this->middleware('permission:update_user', ['only' => ['edit']]);
        $this->middleware('permission:delete_user', ['only' => ['destroy']]);
    }
    public function LoginFrom()
    {
        return view('auth.login');
    }


    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 204,
                'errors' => $validator->errors()
            ]);
        }

        $user = User::create([
            'uid' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'status' => 1,
        ]);

        // Optional: Assign default role
        $user->assignRole('Employee');

        return response()->json([
            'statusCode' => 200,
            'statusMsg' => 'Registration successful. You can now login.',
            'route' => route('login')
        ]);
    }
    public function profile()
    {
        return view('User.profile');
    }


    public function index()
    {
        // $this->checkLogin();
        return view('UserConfig.user.showUser');
    }
    public function create()
    {
        // $this->checkLogin();
        return view('UserConfig.user.createUser');
    }
    public function edit($id)
    {

        $rowItem = User::where('id', $id)->first();

        return response()->json($rowItem);
    }



    public function changePassword()
    {
        return view("auth.resetpassword");
    }


    public function resetPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'statusCode' => 204,
                'errors' => $validator->errors()
            ]);
        }

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'statusCode' => 400,
                'statusMsg' => 'Current password is incorrect.'
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'statusCode' => 200,
            'statusMsg' => 'Password changed successfully.'
        ]);
    }


    public function store(Request $request)
    {
        try {
            if ($request['id'] == "") {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'roles' => 'required',
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                    'status' => 'required',
                    'password' => 'required',
                ]);

                if ($validator->fails()) {
                    return json_encode(array('statusCode' => 204, 'statusMsg' => 'Validation Error.', 'errors' => $validator->errors()));
                }
                $photoPath = null;

                if ($request->hasFile('photo')) {
                    $photoPath = $request->file('photo')->store('photos', 'public');
                }
                $user = User::create([
                    'uid' => Str::uuid(),
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'status' => $request->status,
                    'photo' => $photoPath,
                    'password' => Hash::make($request->password)
                ]);
                $user->syncRoles($request->roles);
                return json_encode(array(
                    "statusCode" => 200,
                    "statusMsg" => "Data Added Successfully"
                ));
            } else {
                $validator = Validator::make($request->all(), [
                    'name' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'roles' => 'required',
                    // 'status' => 'required',
                ]);

                if ($validator->fails()) {
                    return json_encode(array('statusCode' => 204, 'statusMsg' => 'Validation Error.', 'errors' => $validator->errors()));
                }

                $id = $request['id'];
                $permission = User::findOrFail($id);
                $permission->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    // 'status'=>$request->status,
                ]);
                $permission->syncRoles($request->roles);
                return json_encode(array(
                    "statusCode" => 200,
                    "statusMsg" => "Data Update Successfully"
                ));
            }
        } catch (\Exception $e) {

            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));;
        }
    }
    public function show($id)
    {
        try {
            $singleDataShow = DB::table('users')->where('id', $id)->get();
            //$singleDataShow = User::findOrFail($id)->get();
            return $singleDataShow;
        } catch (\Exception $e) {

            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));;
        }
    }
    public function destroy($id)
    {
        try {
            $permission = User::where('uid', $id)->first();
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
    public function GetRoles()
    {
        try {
            // $singleDataShow = Role::all();
            $singleDataShow = Role::where('name', '!=', 'Root')->get();
            return $singleDataShow;
        } catch (\Exception $e) {

            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));;
        }
    }
    public function GetBranch()
    {
        try {
            $singleDataShow = BranchInfo::all();
            return $singleDataShow;
        } catch (\Exception $e) {
            return json_encode(array(
                "statusCode" => 400,
                "statusMsg" => $e->getMessage()
            ));;
        }
    }
    public function getData(Request $request)
    {
        $query = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select(
                'users.id',
                'users.name',
                'users.uid',
                'users.phone',
                'users.email',
                'users.status', // IMPORTANT: Added status for filtering and display
                'roles.name as role_name'
            )
            ->where('model_has_roles.model_type', '=', 'App\\Models\\User');

        // 2. Apply Custom Filters (Role and Status)

        // Filter by Role Name
        if ($request->filled('role') && $request->role !== '') {
            $query->where('roles.name', $request->role);
        }

        // Filter by Status (0 or 1)
        if ($request->filled('status') && ($request->status === '1' || $request->status === '0')) {
            $query->where('users.status', (int) $request->status);
        }

        // 3. Apply DataTables Search Filter
        if ($request->has('search') && isset($request->search['value'])) {
            $search = $request->search['value'];
            $query->where(function ($query) use ($search) {
                $query->where('users.name', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%')
                    ->orWhere('users.phone', 'like', '%' . $search . '%');
            });
        }

        // 4. Get Total Records Count (Records *before* any filtering, correctly counted)
        $totalCount = DB::table('users')->count();

        // 5. Get Filtered Records Count (Count distinct users after all filters are applied)
        $filteredCount = (clone $query)->distinct('users.id')->count('users.id');

        // 6. Apply Ordering
        if ($request->has('order')) {
            $orderColumnIndex = $request->order[0]['column'];
            $orderDirection = $request->order[0]['dir'];

            // Map DataTables column index to actual database column name
            $dtColumns = [
                0 => 'users.id', // SL
                1 => 'users.name',
                2 => 'users.phone',
                3 => 'users.email',
                // 4 is roles_html, not a sortable DB column
            ];

            $orderColumnData = $request->columns[$orderColumnIndex]['data'];
            $orderColumn = $dtColumns[$orderColumnIndex] ?? 'users.id';

            $query->orderBy($orderColumn, $orderDirection);
        }

        // 7. Apply Pagination and Grouping
        $data = $query->skip($request->input('start', 0))
            ->take($request->input('length', 10))
            ->get()
            ->groupBy('id'); // Group by user ID to process roles later

        // 8. Format the data for DataTables
        $formattedData = $data->map(function ($rolesByUser) {
            $user = $rolesByUser->first();

            // Generate Tailwind-styled role badges
            $roleBadges = $rolesByUser->pluck('role_name')->unique()->map(function ($role) {
                // Assign colors for better visual distinction on the frontend
                $color = match ($role) {
                    'admin' => 'bg-red-600',
                    'manager' => 'bg-blue-600',
                    'user' => 'bg-green-600',
                    default => 'bg-gray-600',
                };
                return '<span class="inline-block px-2 py-1 text-xs font-semibold text-white ' . $color . ' rounded-full mr-1 mb-1">' . ucfirst($role) . '</span>';
            })->implode('');

            return [
                'id' => $user->id,
                'uid' => $user->uid,
                'name' => $user->name,
                'phone' => $user->phone,
                'email' => $user->email,
                'roles_html' => $roleBadges,
                // Add status back if needed for other columns/logic
                'status' => $user->status,
            ];
        })->values();

        // 9. Return DataTables Response
        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $totalCount,
            'recordsFiltered' => $filteredCount,
            'data' => $formattedData,
        ]);
    }
    // public function getData1(Request $request)
    // {
    //     $query = DB::table('users')
    //         ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
    //         ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
    //         ->select(
    //             'users.id',
    //             'users.name',
    //             'users.branch_id',
    //             'users.phone',
    //             'users.email',
    //             'roles.name as role_name'
    //         )
    //         ->where('model_has_roles.model_type', '=', 'App\\Models\\User');

    //     if ($request->has('search') && isset($request->search['value'])) {
    //         $search = $request->search['value'];
    //         $query->where(function($query) use ($search) {
    //             $query->where('users.name', 'like', '%' . $search . '%')
    //                 ->orWhere('users.email', 'like', '%' . $search . '%')
    //                 ->orWhere('users.phone', 'like', '%' . $search . '%');
    //         });
    //     }

    //     if ($request->has('order')) {
    //         $orderColumnIndex = $request->order[0]['column'];
    //         $orderDirection = $request->order[0]['dir'];
    //         $orderColumn = $request->columns[$orderColumnIndex]['data'];

    //         $query->orderBy($orderColumn, $orderDirection);
    //     }

    //     $totalCount = $query->count();
    //     $filteredCount = $totalCount;

    //     $data = $query->skip($request->input('start', 0))
    //         ->take($request->input('length', 10))
    //         ->get()
    //         ->groupBy('id');

    //     $formattedData = $data->map(function ($rolesByUser) {
    //         $user = $rolesByUser->first();
    //         $roleBadges = $rolesByUser->pluck('role_name')->map(function ($role) {
    //             return '<span class="badge rounded-pill bg-label-info">' . $role . '</span>';
    //         })->implode('</br>');

    //         return [
    //             'id' => $user->id,
    //             'name' => $user->name,
    //             'branch_id' => $user->branch_id,
    //             'phone' => $user->phone,
    //             'email' => $user->email,
    //             'roles_html' => $roleBadges,
    //         ];
    //     });

    //     return response()->json([
    //         'draw' => intval($request->draw),
    //         'recordsTotal' => $totalCount,
    //         'recordsFiltered' => $filteredCount,
    //         'data' => $formattedData,
    //     ]);
    // }
    public function authenticate(Request $request)
    {
        try {
            // Validation rules including latitude and longitude
            $validator = Validator::make($request->all(), [
                'password' => 'required',
                'email' => 'required|email',
                // 'latitude' => 'nullable|numeric',
                // 'longitude' => 'nullable|numeric',
            ]);

            if ($validator->fails()) {
                return json_encode(array(
                    'statusCode' => 204,
                    'statusMsg' => 'Validation Error.',
                    'errors' => $validator->errors(),
                ));
            }

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                // Update user location if provided
                if ($request->has('latitude') && $request->has('longitude')) {
                    $user->latitude = $request->input('latitude');
                    $user->longitude = $request->input('longitude');
                    $user->save();
                }

                return json_encode(array(
                    'statusCode' => 200,
                    'route' => 'Dashboard',
                ));
            } else {
                return json_encode(array(
                    'statusCode' => 201,
                    'statusMsg' => 'Invalid credentials.',
                ));
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return json_encode(array(
                'statusCode' => 500,
                'statusMsg' => $e->getMessage(),
            ));
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
