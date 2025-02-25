<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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

    public function picture()
    {
        return $this->morphOne(Picture::class, 'picturable');
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

    public function subDescription()
    {
        return $this->hasMany(SubDescription::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($item) {
            if ($item->qr)
            {
                $qr_file_path = str_replace('storage/', '', $item->qr->file_path);
                if (!empty($qr_file_path) && Storage::disk('public')->exists($qr_file_path)) {
                    Storage::disk('public')->delete($qr_file_path);
                }
                $item->qr->delete();
            }

            if ($item->picture)
            {
                $pic_file_path = str_replace('storage/', '', $item->picture->file_path);
                if (!empty($pic_file_path) && Storage::disk('public')->exists($pic_file_path)) {
                    Storage::disk('public')->delete($pic_file_path);
                }
                $item->picture->delete();
            }
            $item->detail()->delete();
            $item->subDescription()->delete();
        });
    }
}
