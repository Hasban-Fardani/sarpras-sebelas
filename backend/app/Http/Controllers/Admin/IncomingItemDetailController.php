<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\IncomingItem;
use App\Models\IncomingItemDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group Incoming Item Detail Management
 *
 * API endpoints for managing Incoming Item Detail
 */
class IncomingItemDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, IncomingItem $incomingItem)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $data = IncomingItemDetail::with(['item:id,name'])
            ->where('incoming_item_id', $incomingItem->id)
            ->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'message' => 'success get item in detail',
            ...$data->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, IncomingItem $incomingItem)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'item_id' => 'required|integer',
            'qty' => 'required|integer',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid fields',
                'errors' => $validator->errors()
            ], 422);
        }

        // check if item exist in item in
        $incomingItemDetail = $incomingItem->details()->where('item_id', $request->item_id)->first();
        if ($incomingItemDetail) {
            $incomingItemDetail->update([
                'qty' => $incomingItemDetail->qty + $request->qty
            ]);
            return response()->json([
                'message' => 'success update item in detail',
                'data' => $incomingItem->details
            ]);
        }

        $incomingItem->details()->create($validator->validated());

        // add item stock
        Item::where('id', $request->item_id)->increment('stock', $request->qty);

        return response()->json([
            'message' => 'success add item in detail',
            'data' => $incomingItem->details
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, IncomingItem $incomingItem, string $idDetails)
    {
        // validate
        $validator = Validator::make($request->all(), [
            'item_id' => 'integer',
            'qty' => 'integer',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid fields',
                'errors' => $validator->errors()
            ], 422);
        }

        $incomingItemDetail = IncomingItemDetail::find($idDetails);
        $incomingItemDetail->update($request->all());
        return response()->json([
            'message' => 'success update item in detail',
            'data' => $incomingItemDetail
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IncomingItem $incomingItem, string $idDetails)
    {
        $incomingItemDetail = IncomingItemDetail::find($idDetails);
        $incomingItemDetail->delete();
        return response()->json([
            'message' => 'success delete item in detail',
            'data' => $incomingItem->details
        ]);
    }
}
