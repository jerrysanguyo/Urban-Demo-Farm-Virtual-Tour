<?php

namespace App\Services;

use App\Models\Item;
use App\Models\Picture;
use Illuminate\Support\Facades\Storage;

class ItemService
{
    public function store(array $data): Item
    {
        $item = Item::create([
            'name' => $data['name'],
            'remarks' => $data['remarks'],
            'type_id' => $data['type_id'],
            'created_by' => Auth()->id(),
            'updated_by' => Auth()->id(),
        ]);
    
        if ($item && isset($data['picture'])) {
            $file = $data['picture'];
            $extension = $file->getClientOriginalExtension();
            $picture_name = 'Item_' . $data['name'] . '.' . $extension;
            $folder_name = 'item';
            $file_path = "{$folder_name}/";
    
            if (!Storage::disk('public')->exists($folder_name)) {
                Storage::disk('public')->makeDirectory($folder_name);
            }
    
            $file->storeAs($file_path, $picture_name, 'public');
            
            $item->picture()->create([
                'file_name' => $picture_name,
                'file_path' => "storage/{$file_path}{$picture_name}",
                'created_by' => Auth()->id(),
                'updated_by' => Auth()->id(),
            ]);
        }
    
        return $item;
    }

    public function update(array $data, Item $item): void
    {
        $item->update([
            'name' => $data['name'],
            'remarks' => $data['remarks'],
            'type_id' => $data['type_id'],
            'updated_by' => Auth()->id(),
        ]);
    }

    public function destroy(Item $item): void
    {
        $item->delete();
    }
}