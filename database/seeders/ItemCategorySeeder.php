<?php

namespace Database\Seeders;

use App\Models\ItemCategory;
use Illuminate\Database\Seeder;

class ItemCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsCategories = [
            'Bakery',
            'Beverages',
            'Canned Goods',
            'Dairy',
            'Dry Goods',
            'Frozen Foods',
            'Meat',
            'Produce',
            'Raw Materials',
            'Other',
        ];

        if (ItemCategory::count() > 0) {
            return;
        }

        foreach ($productsCategories as $category) {
            ItemCategory::create([
                'name' => $category,
                'is_meter' => false,
                'is_active' => true,
            ]);
        }
    }
}
