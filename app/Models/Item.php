<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $fillable = [
        'name',
        'remarks',
        'type_id',
        'created_by',
        'updated_by'
    ];

    public static function getAllItems()
    {
        return self::all();
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function qr()
    {
        return $this->hasOne(Qr::class);
    }

    public function detail()
    {
        return $this->hasMany(ItemDetail::class);
    } 
}
