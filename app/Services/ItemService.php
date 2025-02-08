<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ItemService
{
    public function store(array $data): Item
    {
        return Item::create([
            'name'  =>  $data['name'],
            'remarks'  =>  $data['remarks'],
            'type_id'   =>  $data['type_id'],
            'created_by'    =>  Auth()->id(),
            'updated_by'    =>  Auth()->id(),
        ]);
    }

    public function update(array $data, Item $item): void
    {
        $item->update([
            'name'  =>  $data['name'],
            'remarks'  =>  $data['remarks'],
            'type_id'   =>  $data['type_id'],
            'updated_by'    =>  Auth()->id(),
        ]);
    }

    public function destroy(Item $item): void
    {
        if ($item->qr) {
            $filePath = $item->qr->file_path;
    
            if (!empty($filePath) && Storage::disk('public')->exists($filePath)) {
                Storage::disk('public')->delete($filePath);
            }
    
            $item->qr->delete();
        }
    
        $item->delete();
    }
}