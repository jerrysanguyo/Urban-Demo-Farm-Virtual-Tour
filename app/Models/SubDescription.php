<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDescription extends Model
{
    use HasFactory;

    protected $table  = 'sub_descriptions';
    protected $fillable = [
        'item_detail_id',
        'description',
        'created_by',
        'updated_by',
    ];

    public static function getSubDescription($subDescription)
    {
        return self::where('item_detail_id', $subDescription)->get();
    }

    public function itemDetail()
    {
        return $this->belongsTo(ItemDetail::class, 'item_detail_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
