<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionSession extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getYearAttribute()
    {
        return date('Y', $this->start_date);
    }
}
