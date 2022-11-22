<?php

namespace App\Api\V1\Controllers;

use App\Enums\URLEnum;
use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Throwable;

class SubscribeController extends Controller
{
    /**
     * Subscribe to topic
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Topic $topic
     *
     * @return JsonResponse
     */
    public function subscribe(Request $request, Topic $topic)
    {
        try {
            $payload = [
                'url' => "http://mysubscriber.test",
                'topic' => $topic->slug,
            ];

            $response = Http::post(URLEnum::PUBLISHER, $payload);

            return response()->json([
                'status' => $response->ok(),
                'data' => $response->body(),
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
