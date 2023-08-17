<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use App\Models\IdType;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    use Traits\TruncateTable;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DocumentType::query()->exists()) {
            return;
        }

        $this->truncate('document_types');

        foreach (IdType::get() as $item) {
            DocumentType::query()
                ->create([
                    'name' => $item,
                ]);
        }
    }
}
