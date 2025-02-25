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
        'item_id',
        'description',
        'created_by',
        'updated_by',
    ];

    public static function getSubDescription($item)
    {
        return self::where('item_id', $item)->get();
    }

    public function itemDetail()
    {
        return $this->belongsTo(ItemDetail::class, 'item_detail_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id');
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
