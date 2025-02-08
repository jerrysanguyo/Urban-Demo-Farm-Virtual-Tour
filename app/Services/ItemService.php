<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemService
{
    public function store(array $data): Item
    {
        return Item::create([
            'name'  =>  $data['name'],
            'remarks'  =>  $data['remarks'],
            'created_by'    =>  Auth()->id(),
            'updated_by'    =>  Auth()->id(),
        ]);
    }

    public function update(array $data, Item $item): void
    {
        $item->update([
            'name'  =>  $data['name'],
            'remarks'  =>  $data['remarks'],
            'updated_by'    =>  Auth()->id(),
        ]);
    }

    public function destroy(Item $item): void
    {
        $item->delete();
    }
}