<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Event;
use App\Models\Attendee;
use App\Models\Booking;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function attendee_can_book_an_event_successfully()
    {
        $event = Event::factory()->create(['capacity' => 2]);
        $attendee = Attendee::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['event_id' => $event->id]);

        $this->assertTrue($event->bookings()->where('attendee_id', $attendee->id)->exists());
    }

    /** @test */
    public function user_cannot_book_same_event_twice()
    {
        $event = Event::factory()->create(['capacity' => 1]);
        $attendee = Attendee::factory()->create();

        $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee->id,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['booking']);
    }

    /** @test */
    public function test_cannot_overbook_event()
    {
        $event = Event::factory()->create(['capacity' => 1]);
        $attendee1 = Attendee::factory()->create();
        $attendee2 = Attendee::factory()->create();

        $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee1->id,
        ]);

        $response = $this->postJson('/api/bookings', [
            'event_id' => $event->id,
            'attendee_id' => $attendee2->id,
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['booking']);
    }
}