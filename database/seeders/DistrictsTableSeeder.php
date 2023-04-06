<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('districts')->delete();

        \DB::table('districts')->insert([
            0 => [
                'id' => 1,
                'province_id' => 22,
                'name' => 'Nyarugenge',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            1 => [
                'id' => 2,
                'province_id' => 22,
                'name' => 'Gasabo',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            2 => [
                'id' => 3,
                'province_id' => 22,
                'name' => 'Kicukiro',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            3 => [
                'id' => 4,
                'province_id' => 23,
                'name' => 'Nyanza',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            4 => [
                'id' => 5,
                'province_id' => 23,
                'name' => 'Gisagara',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            5 => [
                'id' => 6,
                'province_id' => 23,
                'name' => 'Nyaruguru',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            6 => [
                'id' => 7,
                'province_id' => 23,
                'name' => 'Huye',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            7 => [
                'id' => 8,
                'province_id' => 23,
                'name' => 'Nyamagabe',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            8 => [
                'id' => 9,
                'province_id' => 23,
                'name' => 'Ruhango',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            9 => [
                'id' => 10,
                'province_id' => 23,
                'name' => 'Muhanga',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            10 => [
                'id' => 11,
                'province_id' => 23,
                'name' => 'Kamonyi',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            11 => [
                'id' => 12,
                'province_id' => 24,
                'name' => 'Karongi',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            12 => [
                'id' => 13,
                'province_id' => 24,
                'name' => 'Rutsiro',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            13 => [
                'id' => 14,
                'province_id' => 24,
                'name' => 'Rubavu',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            14 => [
                'id' => 15,
                'province_id' => 24,
                'name' => 'Nyabihu',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            15 => [
                'id' => 16,
                'province_id' => 24,
                'name' => 'Ngororero',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            16 => [
                'id' => 17,
                'province_id' => 24,
                'name' => 'Rusizi',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            17 => [
                'id' => 18,
                'province_id' => 24,
                'name' => 'Nyamasheke',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            18 => [
                'id' => 19,
                'province_id' => 25,
                'name' => 'Rulindo',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            19 => [
                'id' => 20,
                'province_id' => 25,
                'name' => 'Gakenke',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            20 => [
                'id' => 21,
                'province_id' => 25,
                'name' => 'Musanze',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            21 => [
                'id' => 22,
                'province_id' => 25,
                'name' => 'Burera',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            22 => [
                'id' => 23,
                'province_id' => 25,
                'name' => 'Gicumbi',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            23 => [
                'id' => 24,
                'province_id' => 26,
                'name' => 'Rwamagana',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            24 => [
                'id' => 25,
                'province_id' => 26,
                'name' => 'Nyagatare',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            25 => [
                'id' => 26,
                'province_id' => 26,
                'name' => 'Gatsibo',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            26 => [
                'id' => 27,
                'province_id' => 26,
                'name' => 'Kayonza',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            27 => [
                'id' => 28,
                'province_id' => 26,
                'name' => 'Kirehe',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            28 => [
                'id' => 29,
                'province_id' => 26,
                'name' => 'Ngoma',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
            29 => [
                'id' => 30,
                'province_id' => 26,
                'name' => 'Bugesera',
                'created_at' => '2021-06-23 15:24:09',
                'updated_at' => '2021-06-23 15:24:09',
            ],
        ]);

    }
}
