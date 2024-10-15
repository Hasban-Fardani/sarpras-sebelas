<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function getTotalItemAttribute(){
        return $this->details->sum('qty');
    }

    public function details()
    {
        return $this->hasMany(IncomingItemDetail::class);
    }

    public function operator()
    {
        return $this->belongsTo(Employee::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
