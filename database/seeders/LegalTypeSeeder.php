<?php

namespace Database\Seeders;

use App\Models\DocumentType;
use App\Models\LegalType;
use Database\Seeders\traits\TruncateTable;
use Illuminate\Database\Seeder;

class LegalTypeSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $legalTypes = [
            ['id' => 1, 'name' => 'Company'],
            ['id' => 2, 'name' => 'Cooperative'],
            ['id' => 3, 'name' => 'NGO'],
            ['id' => 4, 'name' => 'Individual'],
            ['id' => 5, 'name' => 'Faith Based Organization'],
            ['id' => 6, 'name' => 'Political Party'],
            ['id' => 7, 'name' => 'Government'],
            ['id' => 8, 'name' => 'UN Agency'],
            ['id' => 9, 'name' => 'Diplomatic Mission'],
            ['id' => 10, 'name' => 'International Organisation'],
        ];

        $this->truncate('legal_types');
        collect($legalTypes)->each(function ($legalType) {
           $created = LegalType::query()->updateOrCreate($legalType);
           $created->documentTypes()->sync(\Helper::getRandomModelId(DocumentType::class));
        });
    }
}
