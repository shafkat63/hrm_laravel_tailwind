<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index()
    {
        return view('Setup.Department.index'); // Your Blade view path
    }

    // public function getData(Request $request)
    // {
    //     $query = Department::query();

    //     if ($request->filled('status')) {
    //         $query->where('status', $request->status);
    //     }

    //     // Use pagination or DataTables server-side processing approach if needed
    //     $departments = $query->get();

    //     return response()->json($departments);
    // }


    public function getData(Request $request)
    {
        $columns = ['id', 'name', 'description', 'status', 'create_by', 'update_by'];

        $query = Department::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $totalData = $query->count();

        // search
        if ($search = $request->input('search.value')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $totalFiltered = $query->count();

        // order and paginate
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $orderColumn = $columns[$request->input('order.0.column', 0)];
        $orderDir = $request->input('order.0.dir', 'asc');

        $departments = $query->offset($start)
            ->limit($length)
            ->orderBy($orderColumn, $orderDir)
            ->get();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $departments
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:departments,name',
            'description' => 'nullable|string',
            // 'status' => 'required|boolean',
        ]);

        Department::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'create_by' => Auth::user()->id ?? 'System',
            'update_by' => Auth::user()->id ?? 'System',
        ]);

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'statusMsg' => 'Department created successfully.'
        ]);
    }
    public function edit($id)
    {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }
    public function show($id)
    {
        $department = Department::findOrFail($id);
        return response()->json($department);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:departments,name,' . $id,
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $department = Department::findOrFail($id);
        $department->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'update_by' => Auth::user()->id ?? 'System',
        ]);

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'statusMsg' => 'Department updated successfully.'
        ]);
    }
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'statusMsg' => 'Department deleted successfully.'
        ]);
    }
}
