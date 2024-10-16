<?php

namespace App\Http\Controllers;

use App\Http\Requests\OutgoingItemRequest;
use App\Models\Employee;
use App\Models\OutgoingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * @group 5. Outgoing Item Management
 *
 * API endpoints for managing outgoing item
 */
class OutgoingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        // get all item-ins
        $data = OutgoingItem::with(['operator:id,name', 'division:id,name']);

        // search by operator or division name
        $data->when($request->search, function ($data) use ($request) {
            $searchTerm = '%' . $request->search . '%';

            $data->whereHas('operator', function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm);
            })
                ->orWhereHas('division', function ($query) use ($searchTerm) {
                    $query->where('name', 'like', $searchTerm);
                });
        });

        // filter by division
        $data->when($request->division_id, function ($data) use ($request) {
            $data->where('division_id', $request->division_id);
        });

        // paginate
        $data = $data->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'message' => 'success get all outgoing item',
            ...$data->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @bodyParam division_id int required. The division id. Example: 3
     */
    public function store(OutgoingItemRequest $request)
    {
        // get validated data
        $validatedData = $request->validated();

        $userNIP = auth()->user()->id;
        $employeeID = Employee::where('id', $userNIP)->first()->id;

        if (!array_key_exists('code', $validatedData)) {
            $hashes = 'OUT-' . hash('sha256', now());
            $validatedData['code'] = substr($hashes, 0, 10);
        }

        // directly create a new array with only the needed keys
        $data = [
            'code' => $validatedData['code'],
            'operator_id' => $employeeID,
            'division_id' => $validatedData['division_id'],
            'total_items' => count($validatedData['items']),
        ];

        $outgoing_item = OutgoingItem::create($data);
        $outgoing_item->details()->createMany($validatedData['items']);

        // update stock
        $item_ids = array_column($validatedData['items'], 'item_id');
        $qtys = array_column($validatedData['items'], 'qty');

        if (empty($item_ids)) {
            // Handle the case when there are no items
            return response()->json([
                'message' => 'success add outgoing item',
                'data' => $outgoing_item
            ]);
        }

        // Prepare the SQL query
        $placeholders = implode(',', array_fill(0, count($item_ids), '?'));
        $sql = "UPDATE items SET stock = stock - ELT(FIELD(id, $placeholders), " . implode(',', array_fill(0, count($qtys), '?')) . ") WHERE id IN ($placeholders)";

        // Prepare the parameters
        $params = array_merge($item_ids, $qtys, $item_ids);

        // Execute the SQL query using prepared statement
        DB::update($sql, $params);

        return response()->json([
            'message' => 'success add outgoing item and updated stock',
            'data' => $outgoing_item
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(OutgoingItem $outgoing_item)
    {
        return response()->json([
            'message' => 'success get item-out',
            'data' => $outgoing_item->load(['operator:id,name', 'division:id,name', 'details'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OutgoingItem $outgoing_item)
    {
        // update stock
        $details = $outgoing_item->details->toArray();
        $item_ids = array_column($details, 'item_id');
        $qtys = array_column($details, 'qty');

        if (empty($item_ids)) {
            // Handle the case when there are no items
            $outgoing_item->delete();
            return response()->json([
                'message' => 'success delete item-out',
            ]);
        }

        // Prepare the SQL query
        $placeholders = implode(',', array_fill(0, count($item_ids), '?'));
        $sql = "UPDATE items SET stock = stock + ELT(FIELD(id, $placeholders), " . implode(',', array_fill(0, count($qtys), '?')) . ") WHERE id IN ($placeholders)";

        // Prepare the parameters
        $params = array_merge($item_ids, $qtys, $item_ids);

        // Execute the SQL query using prepared statement
        DB::update($sql, $params);

        $outgoing_item->delete();
        return response()->json([
            'message' => 'success delete outgoing item and rollback the stock',
        ]);
    }
}
