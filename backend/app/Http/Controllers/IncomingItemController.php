<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncomingItemRequest;
use App\Models\Employee;
use App\Models\IncomingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * @group 3. Incoming Item Management
 *
 * API endpoints for managing incoming item
 */
class IncomingItemController extends Controller
{
    /**
     * Display list of incoming item.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        // get all item-ins
        $data = IncomingItem::with(['operator:id,name', 'supplier:id,name']);

        // search by operator name
        $data->when($request->search, function ($data) use ($request) {
            $data->whereHas('operator', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        });

        // filter by supplier
        $data->when($request->supplier_id, function ($data) use ($request) {
            $data->where('supplier_id', $request->supplier_id);
        });

        // paginate
        $data = $data->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'message' => 'success get all incoming items',
            ...$data->toArray()
        ]);
    }

    /**
     * Store new incoming item and update the item stock.
     */
    public function store(IncomingItemRequest $request)
    {
        // get validated data
        $validatedData = $request->validated();

        $userNIP = Auth::user()->nip;
        $employeeID = Employee::where('nip', $userNIP)->first()->id;

        if (!array_key_exists('code', $validatedData)) {
            $hashes = 'IN-' . hash('sha256', now());
            $validatedData['code'] = substr($hashes, 0, 10);
        }

        // directly create a new array with only the needed keys
        $data = [
            'code' => $validatedData['code'],
            'operator_id' => $employeeID,
            'supplier_id' => $validatedData['supplier_id'],
        ];

        $incoming_item = IncomingItem::create($data);
        $incoming_item->details()->createMany($validatedData['items']);

        // update stock
        $item_ids = array_column($validatedData['items'], 'item_id');
        $qtys = array_column($validatedData['items'], 'qty');
        // get last item stock

        // Create the SQL query dynamically
        $sql = "UPDATE items SET stock = stock + ELT(FIELD(id, " . implode(',', $item_ids) . "), " . implode(',', $qtys) . ") WHERE id IN (" . implode(',', $item_ids) . ");";

        // Execute the SQL query
        DB::statement($sql);

        return response()->json([
            'message' => 'success create incoming item and updated stock',
            'data' => $incoming_item
        ]);
    }

    /**
     * Display the specified incoming item.
     */
    public function show(IncomingItem $incoming_item)
    {
        return response()->json([
            'message' => 'success get item-in',
            'data' => $incoming_item->load(['employee:id,name', 'supplier:id,name', 'details'])
        ]);
    }

    /**
     * Remove the specified incoming item.
     */
    public function destroy(IncomingItem $incoming_item)
    {
        // update stock
        $item_ids = array_column($incoming_item->details->toArray(), 'item_id');
        $qtys = array_column($incoming_item->details->toArray(), 'qty');

        // Create the SQL query dynamically
        $sql = "UPDATE items SET stock = stock - ELT(FIELD(id, " . implode(',', $item_ids) . "), " . implode(',', $qtys) . ") WHERE id IN (" . implode(',', $item_ids) . ");";

        // Execute the SQL query
        DB::statement($sql);

        $incoming_item->delete();
        return response()->json([
            'message' => 'success delete incoming item',
        ]);
    }
}
