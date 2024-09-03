<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionItem extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $keyType = 'string';
    protected $autoIncrement = false;

    public function division()
    {
        return $this->belongsTo(Employee::class, 'division_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(SubmissionItemDetail::class, 'submission_id', 'id');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
