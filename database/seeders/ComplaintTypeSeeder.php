<?php

namespace Database\Seeders;

use App\Models\ComplaintType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'Road Damage',
            'Water Supply',
            'Electricity Problem',
            'Garbage Issue',
            'Others',
        ];

        foreach ($data as $name) {
            ComplaintType::create(['name' => $name]);
        }
    }
}
