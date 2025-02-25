<?php

namespace App\Services;

use App\Models\SubDescription;
use App\Models\ItemDetail;
use App\Models\Item;

class SubDescriptionService
{
    public function store(array $data, ItemDetail $itemDetail, Item $item): SubDescription
    {
        return SubDescription::create([
            'item_detail_id'    =>  $itemDetail->id,
            'item_id'       =>  $item->id,
            'description'   =>  $data['description'],
            'created_by'    => Auth()->id(),
            'updated_by'    =>  Auth()->id(),
        ]);
    }

    public function update(array $data, SubDescription $subDescription):void
    {
        $subDescription->update([
            'description'   =>  $data['description'],
            'updated_by'    =>  Auth()->id(),
        ]);
    }

    public function destroy(SubDescription $subDescription): void
    {
        $subDescription->delete();
    }
}