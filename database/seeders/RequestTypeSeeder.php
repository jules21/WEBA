<?php

namespace Database\Seeders;

use App\Models\RequestType;
use Illuminate\Database\Seeder;

class RequestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'New Connection',
            'Repairing',
            'Relocation',
        ];

        if (RequestType::query()->exists()) {
            return;
        }

        foreach ($types as $type) {
            RequestType::query()
                ->create([
                    'name' => $type,
                ]);
        }
    }
}
