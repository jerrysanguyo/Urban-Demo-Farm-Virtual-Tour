<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'Plants',
            'Buildings',
            'Tools',
            'Machines',
        ];
        
        foreach($types as $type)
        {
            Type::create([
                'name' => $type,
                'remarks'   =>  'Seeder generated',
                'created_by'    =>  1, 
                'updated_by'    =>  1,
            ]);
        }
    }
}
