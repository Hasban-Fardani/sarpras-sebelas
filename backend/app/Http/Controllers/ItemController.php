<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Models\Item;
use App\Services\FileService;
use Illuminate\Http\Request;

/**
 * @group 2. Item Management
 *
 * API endpoints for managing items
 */
class ItemController extends Controller
{
    /**
     * Display list item with pagination
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);
        $sort = $request->input('sort', 'created_at');
        $sortDir = $request->input('sort_dir', 'desc');

        $data = Item::with('category:id,name');

        $data->filterRequest($request);

        $data->orderby($sort, $sortDir);

        $data = $data->paginate($perPage, ['*'], 'page', $page);
        $data->getCollection()->transform(function ($item) {
            $item->image = FileService::getUrl($item->image);
            return $item;
        });

        return response()->json([
            'message' => 'success get all items',
            ...$data->toArray()
        ]);
    }

    /**
     * Store a newly item in storage.
     * 
     * @bodyParam category_id integer required The category id. Example: 1
     */
    public function store(ItemStoreRequest $request)
    {
        $data = $request->validated();

        if ($data['code'] == null) {
            $hashes = 'I-' . hash('sha256', now() . $data['name']);
            $data['code'] = substr($hashes, 0, 10);
        }

        $path = FileService::store($request->file('image'));

        $data['image'] = $path;
        $item = Item::create($data);

        return response()->json([
            'message' => 'success create item',
            'data' => $item
        ]);
    }

    /**
     * Display the specified item.
     */
    public function show(Item $item)
    {
        return response()->json([
            'message' => 'success get item',
            'data' => $item
        ]);
    }

    /**
     * Update the specified item in storage.
     * 
     * @bodyParam category_id integer required The category id. Example: 1
     */
    public function update(ItemUpdateRequest $request, Item $item)
    {
        // get validated data
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = FileService::store($request->file('image'));
            $data['image'] = $path;
        }

        $item->update($data);

        return response()->json([
            'message' => 'success update item',
            'data' => $item
        ]);
    }

    /**
     * Remove the specified item from storage.
     */
    public function destroy(Item $item)
    {
        FileService::delete($item->image);
        $item->delete();

        return response()->json([
            'message' => 'success delete item'
        ]);
    }
}
