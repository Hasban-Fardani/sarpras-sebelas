<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItemDetail extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function requestItem()
    {
        return $this->belongsTo(RequestItem::class, 'request_item_id', 'id');
    }
}
