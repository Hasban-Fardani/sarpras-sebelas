<?php

namespace App\Http\Controllers;

use App\Http\Requests\RequestItemRequest;
use App\Models\Employee;
use App\Models\RequestItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group 9. Request Item Management
 *
 * API endpoints for managing request item
 */
class RequestItemController extends Controller
{
    /**
     * Display a list of request item.
     */
    public function index(Request $request)
    {
        $data = RequestItem::with('employee:id,name');
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $data->when($request->search, function ($data) use ($request) {
            $data->where(function ($query) use ($request) {
                $query->whereHas('employee', function ($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->search . '%');
                });
            });
        });

        $data->when($request->status, function ($data) use ($request) {
            $data->where('status', $request->status);
        });

        $data->when($request->start_date && $request->end_date, function ($data) use ($request) {
            $data->whereBetween('created_at', [$request->date, $request->end_date]);
        });

        $data = $data->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'message' => 'success get all request items',
            ...$data->toArray()
        ]);
    }

    /**
     * Store a new request item.
     */
    public function store(RequestItemRequest $request)
    {
        $validatedData = $request->validated();

        $userNIP = auth()->user()->id;
        $employeeID = Employee::where('id', $userNIP)->first()->id;
        
        if (!array_key_exists('code', $validatedData)) {
            $hashes = 'REQ-' . hash('sha256', now());
            $validatedData['code'] = substr($hashes, 0, 10);
        }

        // directly create a new array with only the needed keys
        $data = [
            'division' => $employeeID,
            'code' => $validatedData['code'],
            'regarding' => $validatedData['regarding'],
            'characteristic' => $validatedData['characteristic'],
            'note' => $validatedData['note'],
            'operator' => 3,
            'status' => 'draf',
        ];

        // create request item
        $request_item = RequestItem::create($data);

        // get items
        $items = $validatedData['items'];
        // set default qty_acc to same as qty
        foreach ($items as $key => $item) {
            $items[$key]['qty_acc'] = $item['qty'];
        }

        // create request item details
        $request_item->details()->createMany($items);

        // return response
        return response()->json([
            'message' => 'success create request item',
            'data' => $request_item
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(RequestItem $request_item)
    {
        return response()->json([
            'message' => 'success get submission item',
            'data' => $request_item->load(['employee:id,name', 'details'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestItem $request_item)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:draf,diajukan',
            'regarding' => 'required|string',
            'characteristic' => 'required|string',
            'note' => 'nullable|string',
            'employee_id' => 'nullable|exists:employees,id',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $request_item->update($validator->validated());
        return response()->json([
            'message' => 'success update request item',
            'data' => $request_item
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestItem $request_item)
    {
        $request_item->delete();
        return response()->json([
            'message' => 'success delete request item'
        ]);
    }
}
