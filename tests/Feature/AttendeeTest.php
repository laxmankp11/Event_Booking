<?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Attendee;

class AttendeeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function attendee_can_register_successfully()
    {
        $response = $this->postJson('/api/attendees', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'John Doe']);

        $this->assertTrue(Attendee::whereEmail('john@example.com')->exists());
    }

    /** @test */
    public function email_must_be_unique()
    {
        Attendee::factory()->create(['email' => 'jane@example.com']);

        $response = $this->postJson('/api/attendees', [
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
    }

    /** @test */
    public function name_and_email_are_required()
    {
        $response = $this->postJson('/api/attendees', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['name', 'email']);
    }
}