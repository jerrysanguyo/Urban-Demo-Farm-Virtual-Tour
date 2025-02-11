<?php

namespace App\Services;

use App\Models\ItemDetail;
use App\Models\Item;

class ItemDetailService
{
    public function store(array $data, Item $item): ItemDetail
    {
        return ItemDetail::create([
            'item_id'   =>  $item->id,
            'title'     =>  $data['title'],
            'details'    =>  $data['details'],
            'created_by'    =>  Auth()->id(),
            'updated_by'    =>  Auth()->id(),
        ]);
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