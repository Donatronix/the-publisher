<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Throwable;

class SubscriptionController extends Controller
{
    public function subscribe(Topic $topic)
    {
        try {

            $response=[
                'url',
'topic'=>$topic->slug,
            ],
        } catch (Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
