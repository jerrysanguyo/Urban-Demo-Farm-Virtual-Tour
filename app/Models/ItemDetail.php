<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemDetail extends Model
{
    use HasFactory;
    protected $table = 'item_details';
    protected $fillable= [
        'item_id',
        'title',
        'details',
        'created_by',
        'updated_by'
    ];

    public static function getItemDetails($item)
    {
        return self::where('item_id', $item)->get();    
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

    public function subDetail()
    {
        return $this->hasMany(SubDescription::class);
    }
}
