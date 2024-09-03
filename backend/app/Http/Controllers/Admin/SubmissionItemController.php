<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmissionItemAdminRequest;
use App\Models\Employee;
use App\Models\SubmissionItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubmissionItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = SubmissionItem::with('division:id,name');
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $data->when($request->search, function ($data) use ($request) {
            $data->where(function ($query) use ($request) {
                $query->whereHas('division', function ($query) use ($request) {
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
            'message' => 'success get all submission items',
            ...$data->toArray()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubmissionItemAdminRequest $request)
    {
        $validatedData = $request->validated();

        $userNIP = auth()->user()->id;
        $employeeID = Employee::where('id', $userNIP)->first()->id;

        // directly create a new array with only the needed keys
        $data = [
            'user_id' => $employeeID,
            'total_items' => count($validatedData['items']),
        ];

        // create submission item
        $submission_item = SubmissionItem::create($data);

        // get items
        $items = $validatedData['items'];
        // set default qty_acc to same as qty
        foreach ($items as $key => $item) {
            $items[$key]['qty_acc'] = $item['qty'];
        }

        // create submission item details
        $submission_item->details()->createMany($items);

        // return response
        return response()->json([
            'message' => 'success create submission item',
            'data' => $submission_item
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubmissionItem $submission)
    {
        return response()->json([
            'message' => 'success get submission item',
            'data' => $submission->load(['division:id,name', 'details'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubmissionItem $submission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubmissionItem $submission)
    {
        $submission->delete();
        return response()->json([
            'message' => 'success delete submission item'
        ]);
    }
}
