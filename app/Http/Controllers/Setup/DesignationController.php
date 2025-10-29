<?php

namespace App\Http\Controllers\Setup;

use App\Http\Controllers\Controller;
use App\Models\Setup\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignationController extends Controller
{
    public function index()
    {
        return view('Setup.Designation.index');
    }

    public function getData(Request $request)
    {
        $columns = ['id', 'name', 'description', 'status', 'create_by', 'update_by'];

        $query = Designation::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $totalData = $query->count();

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

        $designations = $query->offset($start)
            ->limit($length)
            ->orderBy($orderColumn, $orderDir)
            ->get();

        return response()->json([
            'draw' => intval($request->input('draw')),
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $designations
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:designations,name',
            'description' => 'nullable|string',
        ]);

        Designation::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'create_by' => Auth::user()->id ?? 'System',
            // 'update_by' => Auth::user()->id ?? 'System',
        ]);

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'statusMsg' => 'Designation created successfully.'
        ]);
    }

    public function edit($id)
    {
        $designation = Designation::findOrFail($id);
        return response()->json($designation);
    }

    public function show($id)
    {
        $designation = Designation::findOrFail($id);
        return response()->json($designation);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:designations,name,' . $id,
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        $designation = Designation::findOrFail($id);
        $designation->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'update_by' => Auth::user()->id ?? 'System',
        ]);

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'statusMsg' => 'Designation updated successfully.'
        ]);
    }

    public function destroy($id)
    {
        $designation = Designation::findOrFail($id);
        $designation->delete();

        return response()->json([
            'success' => true,
            'statusCode' => 200,
            'statusMsg' => 'Designation deleted successfully.'
        ]);
    }
}
