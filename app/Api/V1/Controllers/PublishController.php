<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\JsonResponse;
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
            $payload =  [
                'data' => $topic->toArray(),
                'topic' => $topic->slug,
            ];

            return response()->json([
                'status' => 'success',
                'data' => $payload,
            ]);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
