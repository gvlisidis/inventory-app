<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Enums\Group;
use App\Enums\Location;
use App\Models\Box;
use App\Models\Item;
use App\Models\Team;
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
        $u1 = User::factory()->create([
            'name' => 'George Vlisidis',
            'email' => 'gv@mail.com',
        ]);

        $u2 = User::factory()->create([
            'name' => 'Zina Skoufa',
            'email' => 'zs@mail.com',
        ]);

        $team = Team::create(['name' => 'Family']);
        $groups = Group::getAllValues();
        $locations = Location::getAllValues();

        $team->users()->attach([$u1->id, $u2->id]);


        for ($i = 0; $i < 8; $i++) {
            Box::factory()->create(['team_id' => $team->id,]);
        }

        $boxes = Box::all();

        for ($i = 0; $i < 30; $i++) {
            Item::factory()->create([
                'box_id' => rand(1, 2) === 1 ? $boxes->random()->id : null,
            ]);
        }

    }
}
