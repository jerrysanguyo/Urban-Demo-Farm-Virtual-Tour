<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ItemDetail extends Model
{
    use HasFactory;
    protected $table = 'item_details';
    protected $fillable = [
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

    public function picture()
    {
        return $this->morphOne(Picture::class, 'picturable');
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

    public function subDescription()
    {
        return $this->hasMany(SubDescription::class);
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($itemDetail) {
            if ($itemDetail->picture) {
                $det_file_path = str_replace('storage/', '', $itemDetail->picture->file_path);
                if (!empty($det_file_path) && Storage::disk('public')->exists($det_file_path)) {
                    Storage::disk('public')->delete($det_file_path);
                }
                $itemDetail->picture->delete();
            }
            $itemDetail->subDescription()->delete();
        });
    }
}
