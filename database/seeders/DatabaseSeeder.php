<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'George Vlisidis',
            'email' => 'gblisidis@gmail.com',
        ]);

        User::factory()->create([
            'name' => 'Zina Skoufa',
            'email' => 'zskoufa@gmail.com',
        ]);
        Model::unguard();

//        $this->call(BoxSeeder::class);
//        $this->call(ItemSeeder::class);

        Model::reguard();
    }
}
