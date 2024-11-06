<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @group 1. Category Management
 *
 * API endpoints for managing categories
 */
class CategoryController extends Controller
{
    /**
     * Display list of categories.
     */
    public function index(Request $request)
    {
        // get page and per_page
        $page = $request->input('page', 1);
        $perPage = $request->input('per_page', 10);

        // get all categories
        $data = Category::withCount('items');

        // search by name
        $data->when($request->search, function ($data) use ($request) {
            $data->where(function ($query) use ($request) {
                // select * from categories where name like %search%
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        });

        $data->orderBy('created_at', 'desc');

        // paginate
        $data = $data->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'message' => 'success get all categories',
            ...$data->toArray()
        ]);
    }

    /**
     * Store a new category in storage.
     */
    public function store(Request $request)
    {
        // validate name, ensure its unique
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid fields',
                'errors' => $validator->errors()
            ], 422);
        }

        // create new category
        $category = Category::create($validator->validated());

        return response()->json([
            'message' => 'success create new category',
            'data' => $category
        ]);
    }

    /**
     * Display specific category.
     */
    public function show(Category $category)
    {
        return response()->json([
            'message' => 'success get category',
            'data' => $category
        ]);
    }

    /**
     * Update specified category.
     */
    public function update(Request $request, Category $category)
    {
        // validate name, ensure its unique
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name',
            'code' => 'nullable|unique:categories,code,' . $category->code,
        ]);

        // check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'message' => 'invalid fields',
                'errors' => $validator->errors()
            ], 422);
        }

        // update category
        $category->update($validator->validated());

        return response()->json([
            'message' => 'success update category',
            'data' => $category
        ]);
    }

    /**
     * Delete category by id.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'success delete category'
        ]);
    }
}
