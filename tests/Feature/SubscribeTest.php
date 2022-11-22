<?php

namespace Tests\Feature;

use App\Models\Topic;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscribeTest extends TestCase
{
    /**
     * A basic feature test subscribe.
     *
     * @return void
     */
    public function test_subscribe()
    {
        $topic = Topic::inRandomOrder()->first();
        $response = $this->post(route('subscribe', ['topic' => $topic->slug]));

        $response->assertStatus(200);
    }
}
