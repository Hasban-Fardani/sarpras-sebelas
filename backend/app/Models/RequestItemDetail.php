<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItemDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $keyType = 'string';
    protected $autoIncrement = false;

    public function requestItem()
    {
        return $this->belongsTo(RequestItem::class, 'request_item_id', 'id');
    }
}
