<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingItemDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $keyType = 'string';
    protected $autoIncrement = false;

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function incoming_item()
    {
        return $this->belongsTo(IncomingItem::class);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
