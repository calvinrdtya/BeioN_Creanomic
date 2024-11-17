<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiController extends Controller
{
    public function chat(Request $request)
    {
        // Validate the request input
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Create the message structure required by the chat completions endpoint
        $messages = [
            ['role' => 'user', 'content' => $request->input('message')]
        ];

        // Make the API call to OpenAI using the chat completions endpoint and model
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ])->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-4-turbo',
                'messages' => $messages,
                'temperature' => 0.7,
                'max_tokens' => 300, // Increased max_tokens
            ]);

            // Check for response errors
            if ($response->failed()) {
                Log::error('API Request Failed:', ['response' => $response->body()]);
                return response()->json(['message' => 'Maaf, terjadi kesalahan pada server.'], 500);
            }

            // Log the full response for debugging
            Log::info('OpenAI API Response:', $response->json());

            // Get the response from the API
            $chatResponse = $response->json()['choices'][0]['message']['content'] ?? 'Ulangi pertanyaan anda!';

            // Trim the response to remove any extra whitespace
            $chatResponse = trim($chatResponse);

            // Return the response as JSON
            return response()->json(['message' => $chatResponse]);
        } catch (\Exception $e) {
            // Log any exception that occurs
            Log::error('Exception occurred:', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Maaf, terjadi kesalahan pada server.'], 500);
        }
    }

    public function showChatForm()
    {
        // $title = 'Guide AI';
        $title = 'Testing';
        return view('front.guideai.index', compact('title'));
    }
}


// public function chat(Request $request)
//     {
//         // Validate the request input
//         $request->validate([
//             'message' => 'required|string|max:255',
//         ]);

//         // Create the message structure required by the chat completions endpoint
//         $messages = [
//             ['role' => 'user', 'content' => $request->input('message')]
//         ];

//         // Make the API call to OpenAI using the chat completions endpoint and model
//         try {
//             $response = Http::withHeaders([
//                 'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
//             ])->post('https://api.openai.com/v1/chat/completions', [
//                 // 'model' => 'gpt-4o-mini',
//                 'model' => 'gpt-3.5-turbo',
//                 'messages' => $messages,
//                 'temperature' => 0.7,
//                 'max_tokens' => 150,
//             ]);

//             // Check for response errors
//             if ($response->failed()) {
//                 Log::error('API Request Failed:', ['response' => $response->body()]);
//                 return response()->json(['message' => 'Maaf, terjadi kesalahan pada server.'], 500);
//             }

//             // Log the full response for debugging
//             Log::info('OpenAI API Response:', $response->json());

//             // Get the response from the API
//             $chatResponse = $response->json()['choices'][0]['message']['content'] ?? 'Ulangi pertanyaan anda!';

//             // Trim the response to remove any extra whitespace
//             $chatResponse = trim($chatResponse);

//             // Format response as HTML list
//             $chatResponse = nl2br(htmlspecialchars($chatResponse)); // Convert newlines to <br> and escape HTML characters

//             // Convert lines to list items
//             $chatResponse = "<ul><li>" . str_replace("\n", "</li><li>", $chatResponse) . "</li></ul>";

//             // Return the response as JSON
//             return response()->json(['message' => $chatResponse]);
//         } catch (\Exception $e) {
//             // Log any exception that occurs
//             Log::error('Exception occurred:', ['message' => $e->getMessage()]);
//             return response()->json(['message' => 'Maaf, terjadi kesalahan pada server.'], 500);
//         }
//     }


// try {
//     $response = Http::withHeaders([
//         'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
//     ])->post('https://api.openai.com/v1/chat/completions', [
//         // 'model' => 'gpt-3.5-turbo',
//         // 'model' => 'gpt-3.5-turbo-instruct',
//         // 'model' => 'gpt-4o-mini',
//         'model' => 'gpt-4-turbo',
//         'messages' => $messages,
//         'temperature' => 0.7,
//         'max_tokens' => 150,
//     ]);