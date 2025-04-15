<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\ComplaintType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('role', 'user')->first();
        $types = ComplaintType::all();

        $data = [];

        foreach ($types as $type) {
            $data[] = [
                'user_id' => $user->id,
                'type_id' => $type->id,
                'title' => "Issue with {$type->name}",
                'description' => "This is a complaint regarding {$type->name}.",
                'location' => "Ward No. 5, Kathmandu",
                'status' => 'pending',
                'image_path' => null,
                'admin_remark' => null,
            ];
        }

        foreach ($data as $complaint) {
            Complaint::create($complaint);
        }
    }
}
