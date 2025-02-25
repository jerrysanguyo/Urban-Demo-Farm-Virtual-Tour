<?php

namespace App\Services;

use App\Models\SubDescription;
use App\Models\ItemDetail;

class SubDescriptionService
{
    public function store(array $data, ItemDetail $itemDetail): SubDescription
    {
        return SubDescription::create([
            'item_detail_id'    =>  $itemDetail,
            'description'   =>  $data['description'],
            'created_by'    => Auth()->id(),
            'updated_by'    =>  Auth()->id(),
        ]);
    }

    public function update(array $data, SubDescription $subDescription):void
    {
        $subDescription->updated([
            'description'   =>  $data['description'],
            'updated_by'    =>  Auth()->id(),
        ]);
    }

    public function destroy(SubDescription $subDescription): void
    {
        $subDescription->delete();
    }
}