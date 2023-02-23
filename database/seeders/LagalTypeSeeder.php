<?php

namespace Database\Seeders;

use App\Models\LegalType;
use Illuminate\Database\Seeder;

class LagalTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $legalTypes = [
            ['id'=>1,'name'=>'Passport'],
            ['id'=>2,'name'=>'Driving License'],
            ['id'=>3,'name'=>'National ID'],
            ['id'=>4,'name'=>'Birth Certificate'],
            ['id'=>5,'name'=>'Marriage Certificate'],
            ['id'=>6,'name'=>'Death Certificate'],
            ['id'=>7,'name'=>'Divorce Certificate'],
            ['id'=>8,'name'=>'Other'],
        ];

        collect($legalTypes)->each(function ($legalType){
            LegalType::query()->updateOrCreate($legalType);
        });
    }
}
