<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group 13. Supplier Management
 *
 * API endpoints for managing suppliers
 */
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);
        
        $suppliers = Supplier::query();
        $suppliers->when($request->input('search'), function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        });

        $data = $suppliers->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'message' => 'success get suppliers',
            ...$data->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $validatedData = $request->validated();
        if (!array_key_exists('code', $validatedData)) {
            $hashes = 'SUB-' . hash('sha256', now() . $validatedData['name']);
            $validatedData['code'] = substr($hashes, 0, 10);
        }
        $supplier = Supplier::create($validatedData);
        return response()->json([
            'message' => 'success create supplier',
            'data' => $supplier
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return response()->json([
            'message' => 'success get supplier',
            'data' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier = $supplier->update($request->validated());
        return response()->json([
            'message' => 'success create supplier',
            'data' => $supplier
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @urlParam supplier required The ID of the supplier. Example: 10
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return response()->json([
            'message' => 'success delete supplier'
        ]);
    }
}
