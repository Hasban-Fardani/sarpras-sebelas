<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $keyType = 'string';
    protected $autoIncrement = false;

    // public static function boot()
    // {
    //     parent::boot();
    //     static::creating(function ($model) {
    //         if (empty($model->id)) 
    //         {
    //             $model->id = 'BL-' . uniqid();
    //         }
    //     });
    // }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function hasSufficientStock(int $amount): bool
    {
        return $this->stock >= $amount;
    }

    public function getKeyName()
    {
        return 'id';
    }
    
    public function getRouteKeyName()
    {
        return 'id';
    }
}