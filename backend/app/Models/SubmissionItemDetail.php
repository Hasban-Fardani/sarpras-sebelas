<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionItemDetail extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $keyType = 'string';
    protected $autoIncrement = false;

    public function submissionItem()
    {
        return $this->belongsTo(SubmissionItem::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
