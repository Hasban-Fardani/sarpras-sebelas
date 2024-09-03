<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomingItemRequest;
use App\Models\Employee;
use App\Models\IncomingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IncomingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        // get all item-ins
        $data = IncomingItem::with(['employee:id,name', 'supplier:id,name']);

        // search by employee name
        $data->when($request->search, function ($data) use ($request) {
            $data->where(function ($query) use ($request) {
                $query->whereHas('employee', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
            });
        });

        // filter by supplier
        $data->when($request->supplier_id, function ($data) use ($request) {
            $data->where('supplier_id', $request->supplier_id);
        });

        // paginate
        $data = $data->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'message' => 'success get all item-ins',
            ...$data->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IncomingItemRequest $request)
    {
        // get validated data
        $validatedData = $request->validated();

        $userNIP = auth()->user()->id;
        $employeeID = Employee::where('id', $userNIP)->first()->id;
        // directly create a new array with only the needed keys
        $data = [
            'employee_id' => $employeeID,
            'supplier_id' => $validatedData['supplier_id'],
            'total_items' => count($validatedData['items']),
        ];

        $IncomingItem = IncomingItem::create($data);
        $IncomingItem->details()->createMany($validatedData['items']);

        // update stock
        $item_ids = array_column($validatedData['items'], 'item_id');
        $qtys = array_column($validatedData['items'], 'qty');
        // get last item stock
        
        // Create the SQL query dynamically
        $sql = "UPDATE items SET stock = stock + ELT(FIELD(id, " . implode(',', $item_ids) . "), " . implode(',', $qtys) . ") WHERE id IN (" . implode(',', $item_ids) . ");";

        // Execute the SQL query
        DB::statement($sql);

        return response()->json([
            'message' => 'success create item-in and updated stock',
            'data' => $IncomingItem
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(IncomingItem $IncomingItem)
    {
        return response()->json([
            'message' => 'success get item-in',
            'data' => $IncomingItem->load(['employee:id,name', 'supplier:id,name', 'details'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomingItem $IncomingItem)
    {
        // update stock
        $item_ids = array_column($IncomingItem->details->toArray(), 'item_id');
        $qtys = array_column($IncomingItem->details->toArray(), 'qty');
        
        // Create the SQL query dynamically
        $sql = "UPDATE items SET stock = stock - ELT(FIELD(id, " . implode(',', $item_ids) . "), " . implode(',', $qtys) . ") WHERE id IN (" . implode(',', $item_ids) . ");";

        // Execute the SQL query
        DB::statement($sql);

        $IncomingItem->delete();
        return response()->json([
            'message' => 'success delete item-in',
        ]);
    }
}
