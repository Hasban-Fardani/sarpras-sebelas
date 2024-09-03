<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOutDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $keyType = 'string';
    protected $autoIncrement = false;

    public function getRouteKeyName()
    {
        return 'id';
    }
}
