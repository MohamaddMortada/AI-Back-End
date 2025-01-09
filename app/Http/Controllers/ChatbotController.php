<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class ChatbotController extends Controller
{
    public function handleMessage(Request $request)
    {
        $userMessage = $request->input('message');

        $client = OpenAI::client(env('OPENAI_API_KEY'));
        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a helpful athletic coach that will only answer questions that are related to any type of sports and nutrition, any other questions that are other those 2 domains do not answer them.'],
                ['role' => 'user', 'content' => $userMessage],
            ],
        ]);

        return response()->json(['response' => $response->choices[0]->message->content]);
    }
}
