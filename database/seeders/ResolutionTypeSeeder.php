<?php

namespace Database\Seeders;

use App\Models\ResolutionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResolutionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Fix Complete – Parts Collection Required',
                'description' => 'Parts to be collected from site'
            ],
            [
                'name' => 'Further Diagnosis – Internal – 3rd Party Repair',
                'description' => 'Requires external repair'
            ],
            [
                'name' => 'Awaiting Purchase Order from Customer',
                'description' => 'Waiting on customer PO'
            ],
            [
                'name' => 'Call on Hold at Customer’s Request',
                'description' => 'Customer requested hold'
            ],
        ];

        foreach ($types as $type) {
            ResolutionType::create($type);
        }
    }
}
