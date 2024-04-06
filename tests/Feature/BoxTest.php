<?php

namespace Tests\Feature;

use App\Models\Box;
use App\Models\User;
use Tests\TestCase;

class BoxTest extends TestCase
{
    public function test_unauthenticated_users_redirect_to_login(): void
    {
        Box::factory(5)->create();

        $response = $this->get('/boxes');

        $response->assertStatus(302);
    }

    public function test_authenticated_users_can_get_boxes(): void
    {
        Box::factory(5)->create();

        $response = $this->actingAs(User::factory()->create())->get('/boxes');

        $response->assertStatus(200);
        $this->assertEquals(count($response['data']), 5);
    }

    public function test_unauthenticated_users_cannot_create_a_box(): void
    {
        $response = $this->post('/boxes', [
            'name' => 'Test name',
            'location' => 'Test location'
        ]);

        $response->assertStatus(302);
    }

    public function test_authenticated_users_can_create_a_box(): void
    {
        Box::factory(22)->create();
        $boxesBefore = Box::all()->count();
        $this->assertEquals(22, $boxesBefore);
        $response = $this->actingAs(User::factory()->create())->postJson('/boxes', [
            'name' => 'Test name',
            'location' => 'Test location'
        ]);

        $response->assertStatus(201);

        $response->assertSee('Test name');

        $boxesAfter = Box::all()->count();
        $this->assertEquals(23, $boxesAfter);
    }

    public function test_a_box_requires_a_name(): void
    {

        $response = $this->actingAs(User::factory()->create())->postJson('/boxes', [
            'location' => 'Test location'
        ]);

        $response->assertStatus(422);
        $response->assertInvalid([
            'name' => 'The name field is required.',
        ]);
    }

    public function test_a_box_requires_a_location(): void
    {

        $response = $this->actingAs(User::factory()->create())->postJson('/boxes', [
            'name' => 'Test name',
        ]);

        $response->assertStatus(422);
        $response->assertInvalid([
            'location' => 'The location field is required.',
        ]);
    }

    public function test_only_authenticated_users_can_delete_a_box()
    {
        Box::factory(7)->create();
        $boxesBeforeCollection = Box::all();
        $boxesBeforeCollectionCount = Box::all()->count();
        $randomBox = $boxesBeforeCollection->random();
        $idOfRandom = $randomBox->id;

        $response = $this->delete('/boxes/' . $randomBox->id);

        $response->assertStatus(302);
        $this->assertEquals(7, $boxesBeforeCollectionCount);
        $findRandom = Box::query()->where('id', $idOfRandom)->first();
        $this->assertNotNull($findRandom);

        $response2 = $this->actingAs(User::factory()->create())->delete('/boxes/' . $randomBox->id);
        $boxesAfter = Box::all()->count();

        $response2->assertStatus(204);
        $this->assertEquals(6, $boxesAfter);

        $findSecond = Box::query()->where('id', $idOfRandom)->first();

        $this->assertNull($findSecond);
    }
}
