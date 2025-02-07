<?php

namespace App\Services;

use App\Models\Type;
use Illuminate\Support\Facades\Auth;

class TypeService
{
    public function store(array $data): Type
    {
        return Type::create([
            'name'  =>  $data['name'],
            'remarks'  =>  $data['remarks'],
            'created_by'    =>  Auth()->id(),
            'updated_by'    =>  Auth()->id(),
        ]);
    }
    
    public function update(array $data, Type $type): void
    {
        $type->update([
            'name'  =>  $data['name'],
            'remarks'  =>  $data['remarks'],
            'updated_by'    =>  Auth()->id(),
        ]);
    }

    public function destroy(Type $type): void
    {
        $type->delete();
    }
}