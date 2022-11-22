<?php

namespace App\Api\V1\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Throwable;

class MessageController extends Controller
{
    public function publish(Topic $topic)
    {
        try {
            //
        } catch (Throwable $e) {
            return response()->json([
                'error' => true,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
