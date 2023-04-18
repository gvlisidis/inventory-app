<?php

namespace Database\Seeders;

use App\Models\Box;
use App\Models\Item;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Box::all() as $box) {
            Item::factory(rand(3,11))->create([
                'box_id' => $box->id
            ]);
        }
    }
}
