<?php

namespace App\Api\V1\Controllers;

use App\Enums\URLEnum;
use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Throwable;

class PublishController extends Controller
{
    /**
     * Publish message
     *
     * @param \App\Models\Topic $topic
     *
     * @return JsonResponse
     */
    public function publish(Topic $topic)
    {
        try {
            $response = Http::post(URLEnum::SUBSCRIBER, [
                'url' => "http://mysubscriber.test",
                'topic' => $topic->slug,
            ]);

            return response()->json([
                'status' => $response->ok(),
                'data' => $response->body(),
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
