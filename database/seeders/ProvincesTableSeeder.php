<?php

namespace Database\Seeders;

use Database\Seeders\Traits\TruncateTable;
use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    use TruncateTable;

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        $this->truncate('provinces');
        \DB::table('provinces')->insert([
            0 => [
                'id' => 24,
                'name' => 'Western Province',
                'created_at' => '2021-06-23 15:22:07',
                'updated_at' => '2021-06-23 15:22:07',
            ],
            1 => [
                'id' => 23,
                'name' => 'Southern Province',
                'created_at' => '2021-06-23 15:22:07',
                'updated_at' => '2021-06-23 15:22:07',
            ],
            2 => [
                'id' => 22,
                'name' => 'Kigali City',
                'created_at' => '2021-06-23 15:22:07',
                'updated_at' => '2021-06-23 15:22:07',
            ],
            3 => [
                'id' => 25,
                'name' => 'Northern Province',
                'created_at' => '2021-06-23 15:22:07',
                'updated_at' => '2021-06-23 15:22:07',
            ],
            4 => [
                'id' => 26,
                'name' => 'Eastern Province',
                'created_at' => '2021-06-23 15:22:07',
                'updated_at' => '2021-06-23 15:22:07',
            ],
        ]);

    }
}
