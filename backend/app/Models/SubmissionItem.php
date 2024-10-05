<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getTotalItemAttribute(){
        return $this->details->sum('qty');
    }

    public function getTotalItemAccAttribute(){
        return $this->details->sum('qty_acc');
    }
    
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
