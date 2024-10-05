<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestItem extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $keyType = 'string';
    protected $autoIncrement = false;

    public function getTotalItemAttribute(){
        return $this->details->sum('qty');
    }

    public function getTotalItemAccAttribute(){
        return $this->details->sum('qty_acc');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function details(){
        return $this->hasMany(RequestItemDetail::class);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    protected static function booted()
    {
        parent::booted();
        static::creating(function ($model) {
            if ($model->id != null) {
                return;
            }

            $prefix = 'REQ-';
            $latest = RequestItem::latest()->first();
            if ($latest) {
                $latestId = substr($latest->id, strlen($prefix));
                $latestId = (int)$latestId;
                $latestId++;
                $latestId = str_pad($latestId, 8, '0', STR_PAD_LEFT);
            }
        });
    }
}
