<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\SubmissionItem;
use Illuminate\Http\Request;

/**
 * @group Supervisor
 * @subgroup Submission
 * 
 * API endpoints for submission check
 */
class SubmissionCheckController extends Controller
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
    public function accept(SubmissionItem $submission_item)
    {
        $this->checkStatus($submission_item);

        $submission_item->update([
            'status' => 'disetujui'
        ]);

        return response()->json([
            'message' => 'success accept submission item'
        ]);
    }

    /**
     * 
     */
    public function decline(SubmissionItem $submission_item)
    {
        $this->checkStatus($submission_item);

        $submission_item->update([
            'status' => 'ditolak'
        ]);

        return response()->json([
            'message' => 'success decline submission item'
        ]);
    }

    public function checkStatus(SubmissionItem $submission_item)
    {
        if ($submission_item->status == 'ditolak' || $submission_item->status == 'disetujui') {
            abort(response()->json([
                'message' => 'failed accept submission item, submission already ' . $submission_item->status
            ], 422));
        }
    }
}
