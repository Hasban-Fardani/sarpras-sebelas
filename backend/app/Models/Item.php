<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Item extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hasSufficientStock(int $amount): bool
    {
        return $this->stock >= $amount;
    }
    
    public function getRouteKeyName()
    {
        return 'id';
    }

    public function scopeFilterRequest($query, Request $request)
    {
        // search by name
        $query->when($request->search, function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%');
        });

        // filter by merk
        $query->when($request->merk, function ($query) use ($request) {
            $query->where('merk', 'like', '%' . $request->merk . '%');
        });

        // filter by type
        $query->when($request->type, function ($query) use ($request) {
            $query->where('type', 'like', '%' . $request->type . '%');
        });

        // filter by size
        $query->when($request->size, function ($query) use ($request) {
            $query->where('size', 'like', '%' . $request->size . '%');
        });

        // filter by category
        $query->when($request->category_id, function ($query) use ($request) {
            $query->where('category_id', $request->category_id);
        });
    }
}
