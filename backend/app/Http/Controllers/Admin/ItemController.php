<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemStoreRequest;
use App\Http\Requests\ItemUpdateRequest;
use App\Models\Item;
use App\Services\FileService;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display list item with pagination
     */
    public function index(Request $request)
    {
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        $data = Item::with('category:id,name');

        // search by name
        $data->when($request->search, function ($data) use ($request) {
            $data->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        });

        // filter by category
        $data->when($request->category_id, function ($data) use ($request) {
            $data->where('category_id', $request->category_id);
        });

        // sort
        $data->when($request->sort, function ($data) use ($request) {
            $data->orderBy($request->sort);
        });

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
     */
    public function store(ItemStoreRequest $request)
    {
        $data = $request->validated();
        $hashes = 'I-'.hash('sha256', now() . $data['name']);
        $data['id'] = substr($hashes, 0, 10);
        
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
