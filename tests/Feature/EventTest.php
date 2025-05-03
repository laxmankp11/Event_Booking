<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Event;

class EventTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function authenticated_user_can_create_event()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $response = $this->postJson('/api/events', [
            'title' => 'Laravel Conference',
            'country' => 'USA',
            'capacity' => 100,
            'start_time' => now()->addDay(),
            'end_time' => now()->addDays(2),
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['title' => 'Laravel Conference']);
    }

    /** @test */
    public function unauthenticated_user_cannot_create_event()
    {
        $response = $this->postJson('/api/events', [
            'title' => 'Laravel Conference',
            'country' => 'Canada',
            'capacity' => 50,
            'start_time' => now()->addDay(),
            'end_time' => now()->addDays(2),
        ]);

        $response->assertStatus(401);
    }

    /** @test */
    public function can_list_events()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        Event::factory()->count(3)->create(['user_id' => $user->id]);

        $response = $this->getJson('/api/events');

        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }
}