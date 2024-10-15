<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }

    protected static function boot()
    {
        static::creating(function ($category) {
            if (!isset($category->code)) {
                $category->code = 'C-' . hash('sha256', now() . $category->name);
            }
            
            return $category;
        });

        parent::boot();
    }
}
