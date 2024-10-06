<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\OutgoingItem;
use App\Models\OutgoingItemDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group 6. Outgoing Item Detail
 *
 * Manage outgoing item detail
 */
class OutgoingItemDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, OutgoingItem $outgoingItem)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $outgoingItemDetails = $outgoingItem->details()->paginate($perPage, ['*'], 'page', $page);
        return response()->json([
            'message' => 'success get outgoing\'s item detail',
            ...$outgoingItemDetails->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, OutgoingItem $outgoingItem)
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
        $outgoingItemDetail = $outgoingItem->details()->where('item_id', $request->item_id)->first();
        if ($outgoingItemDetail) {
            $outgoingItemDetail->update([
                'qty' => $outgoingItemDetail->qty + $request->qty
            ]);
            return response()->json([
                'message' => 'success update item in detail',
                'data' => $outgoingItem->details
            ]);
        }

        $data = $validator->validated();
        $data['outgoing_item_id'] = $outgoingItem->id;
        $outgoingItem->details()->create($validator->validated());

        // decrement item stock
        Item::where('id', $request->item_id)->decrement('stock', $request->qty);

        return response()->json([
            'message' => 'success add outgoing item detail',
            'data' => $outgoingItem->details
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OutgoingItemDetail $detail)
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

        $detail->update($request->all());
        return response()->json([
            'message' => 'success update item in detail',
            'data' => $detail
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OutgoingItem $outgoingItem, OutgoingItemDetail $detail)
    {
        $detail->delete();
        return response()->json([
            'message' => 'success delete item in detail',
            'data' => $outgoingItem->details
        ]);
    }
}
