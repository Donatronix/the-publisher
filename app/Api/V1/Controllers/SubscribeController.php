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
                'url' => $request->url,
                'topic' => $topic->slug,
            ];

            return response()->json([
                'status' => 'success',
                'data' => $payload,
            ],200);
        } catch (Throwable $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
