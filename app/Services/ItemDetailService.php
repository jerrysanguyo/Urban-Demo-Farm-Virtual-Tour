<?php

namespace App\Services;

use App\Models\ItemDetail;
use App\Models\Item;
use Illuminate\Support\Facades\Storage;

class ItemDetailService
{
    public function store(array $data, Item $item): ItemDetail
    {
        $itemDetail = ItemDetail::create([
            'item_id'   =>  $item->id,
            'title'     =>  $data['title'],
            'details'    =>  $data['details'],
            'created_by'    =>  Auth()->id(),
            'updated_by'    =>  Auth()->id(),
        ]);

        if($itemDetail && isset($data['picture']))
        {
            $file = $data['picture'];
            $extension = $file->getClientOriginalExtension();
            $picture_name = 'itemDetail_' . $data['title'] . '.' . $extension;
            $folder_name = 'itemDetail';
            $file_path = "{$folder_name}/";

            if(!Storage::disk('public')->exists($folder_name))
            {
                Storage::disk('public')->makeDirectory($folder_name);
            }

            $file->storeAs($file_path, $picture_name, 'public');

            $itemDetail->picture()->create([
                'file_name' => $picture_name,
                'file_path' => "storage/{$file_path}{$picture_name}",
                'created_by' => Auth()->id(),
                'updated_by' => Auth()->id(),   
            ]);
        }

        return $itemDetail;
    }

    public function update(array $data, ItemDetail $itemDetail): void
    {
        $itemDetail->update([
            'title'     =>  $data['title'],
            'details'    =>  $data['details'],
            'updated_by'    =>  Auth()->id(),
        ]);
    }

    public function destroy(ItemDetail $itemDetail): void
    {
        $itemDetail->delete();
    }
}