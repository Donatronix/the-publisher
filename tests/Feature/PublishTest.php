<?php

namespace Tests\Feature;

use App\Models\Topic;
use App\Repositories\Interfaces\TopicRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PublishTest extends TestCase
{

    /**
     * A basic feature test publish message.
     *
     * @return void
     */
    public function test_publish_message()
    {
        $topic = Topic::inRandomOrder()->first();

        $response = $this->post(route('publish', ['topic' => $topic->slug]));

        $response->assertStatus(200);
    }
}
