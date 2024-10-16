<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\RequestItem;
use Illuminate\Http\Request;

/**
 * @group Supervisor
 * @subgroup Request
 * 
 * API endpoints for request check
 */
class RequestCheckController extends Controller
{
    public function __construct()
    {
        if (!auth()->user()->can('supervisor')){
            abort(response()->json([
                'message' => 'unauthorized access',
            ], 403));
        }
    }
    /**
     * 
     */
    public function accept(RequestItem $request_item)
    {
        $this->checkStatus($request_item);

        $request_item->update([
            'status' => 'disetujui'
        ]);

        return response()->json([
            'message' => 'success accept submission item'
        ]);
    }

    /**
     * 
     */
    public function decline(RequestItem $request_item)
    {
        $this->checkStatus($request_item);

        $request_item->update([
            'status' => 'ditolak'
        ]);

        return response()->json([
            'message' => 'success decline submission item'
        ]);
    }
    public function checkStatus(RequestItem $request_item)
    {
        if ($request_item->status == 'ditolak' || $request_item->status == 'disetujui') {
            abort(response()->json([
                'message' => 'failed accept request item, request item already ' . $request_item->status
            ], 422));
        }
    }
}
