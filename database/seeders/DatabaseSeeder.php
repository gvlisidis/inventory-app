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
            'name' => 'Zina Skoufa',
            'email' => 'zs@mail.com',
        ]);

        $u2 = User::factory()->create([
            'name' => 'George Vlisidis',
            'email' => 'gv@mail.com',
        ]);

        $team = Team::create(['name' => 'Family', 'owner_id' => $u2->id]);
        $u2->update(['team_id' => $team->id]);
        $groups = Group::getAllValues();
        $locations = Location::getAllValues();

        for ($i = 0; $i < 20; $i++) {
            if (rand(1,2) === 1) {
                Box::factory()->create(['user_id' =>   $u1->id ]);
            } else {
                Box::factory()->create(['team_id' => $team->id ]);
            }
        }

        $boxes = Box::all();

        for ($i = 0; $i < 40; $i++) {
            Item::factory()->create([
                'box_id' => $boxes->random()->id,
            ]);

            Item::factory()->create([
                'team_id' => $team->id,
            ]);

            Item::factory()->create([
                'user_id' => $u1->id,
            ]);
        }

    }
}
