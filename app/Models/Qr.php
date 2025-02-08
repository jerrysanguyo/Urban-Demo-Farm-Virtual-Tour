<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qr extends Model
{
    use HasFactory;
    protected $table = 'qrs';
    protected $fillable = [
        'item_id',
        'file_path',
    ];

    public function item()
    {
        return $this->belognsTo(Item::class, 'item_id');
    }
}
