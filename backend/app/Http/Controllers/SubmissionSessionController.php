<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\SubmissionSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group 7. Submission Item Management
 *
 * API endpoints for managing submission item
 */
class SubmissionSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->query('page', 1);
        $perPage = $request->query('per_page', 10);
        $data = SubmissionSession::query()->get();

        $data = $data->paginate($perPage, $page);
        return response()->json([
            'message' => 'success get all submission session',
            ...$data->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(SubmissionSession $submission)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubmissionSession $submission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubmissionSession $submission)
    {
        
    }
}
