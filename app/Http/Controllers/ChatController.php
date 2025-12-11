<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\Request;
use OpenAI;

class ChatController extends Controller
{
    public function index()
    {
        $userId = auth()->id();
        // return view with previous messages if you want
        // $messages = ChatMessage::latest()->take(50)->get()->reverse()->values();

        // Fetch only this user's messages + assistant replies to this user
        $messages = ChatMessage::where('user_id', $userId)
            ->orderBy('id', 'ASC')
            ->get();
        return view('chat.index', compact('messages'));
    }

    // public function send(Request $request)
    // {
    //     $request->validate(['message' => 'required|string']);

    //     $userId = auth()->id() ?? null; // optional
    //     $userText = trim($request->message);

    //     // Save user message
    //     $userMsg = ChatMessage::create([
    //         'user_id' => $userId,
    //         'role' => 'user',
    //         'content' => $userText,
    //     ]);

    //     // Construct conversation context (you can load last N messages)
    //     $history = ChatMessage::orderBy('id')
    //         ->whereIn('role', ['user', 'assistant'])
    //         ->get(['role', 'content'])
    //         ->map(function ($m) {
    //             return ['role' => $m->role, 'content' => $m->content];
    //         })->toArray();

    //     // Add a system prompt to make assistant clinic-aware
    //     $system_prompt = "You are a helpful, concise clinical assistant for a medical clinic. Answer patient questions politely. If the user asks for medical diagnosis, advise them to consult a licensed professional. Do not ask for or expose personal health info unless strictly required.";

    //     array_unshift($history, ['role' => 'system', 'content' => $system_prompt]);

    //     // Call OpenAI responses API via the openai-php client
    //     $client = OpenAI::client(config('services.openai.key') ?? env('OPENAI_API_KEY'));

    //     $response = $client->responses()->create([
    //         'model' => 'gpt-4o-mini', // choose model appropriate for your use-case & cost
    //         'input' => $history,      // the client responses() accepts 'input' as conversation or text
    //         'temperature' => 0.2,
    //         'max_output_tokens' => 400,
    //         // you can pass user metadata for auditing
    //         'metadata' => [
    //             'user_id' => (string)($userId ?? 'guest'),
    //             'session_id' => session()->getId(),
    //         ],
    //     ]);

    //     // Extract text (per client README)
    //     $assistantText = $response->outputText ?? null;
    //     if (!$assistantText) {
    //         // fallback to first output content
    //         $assistantText = '';
    //         foreach ($response->output ?? [] as $out) {
    //             foreach ($out->content ?? [] as $c) {
    //                 if ($c->type === 'output_text') $assistantText .= $c->text;
    //             }
    //         }
    //     }

    //     // Save assistant message
    //     $assistantMsg = ChatMessage::create([
    //         'user_id' => null,
    //         'role' => 'assistant',
    //         'content' => $assistantText,
    //         'meta' => $response->toArray(), // store full response for auditing (careful with size)
    //     ]);

    //     return response()->json([
    //         'status' => 'ok',
    //         'assistant' => $assistantText,
    //         'assistant_id' => $assistantMsg->id,
    //     ]);
    // }


    public function send(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        $userId = auth()->id();
        $userText = trim($request->message);

        // Save USER message
        ChatMessage::create([
            'user_id' => $userId,
            'role' => 'user',
            'content' => $userText,
        ]);

        // Fetch only this user's chat history
        $history = ChatMessage::where('user_id', $userId)
            ->orderBy('id', 'ASC')
            ->get(['role', 'content'])
            ->map(function ($m) {
                return ['role' => $m->role, 'content' => $m->content];
            })->toArray();

        // System prompt
        array_unshift($history, [
            'role' => 'system',
            'content' => "You are a helpful clinical assistant. Give short and polite answers."
        ]);

        // OpenAI call
        $client = OpenAI::client(config('services.openai.key') ?? env('OPENAI_API_KEY'));

        $response = $client->responses()->create([
            'model' => 'gpt-4o-mini',
            'input' => $history,
            'temperature' => 0.2,
            'max_output_tokens' => 400,
        ]);

        // Extract assistant text
        $assistantText = $response->outputText ?? '';
        if (!$assistantText) {
            foreach ($response->output ?? [] as $out) {
                foreach ($out->content ?? [] as $c) {
                    if ($c->type === 'output_text') {
                        $assistantText .= $c->text;
                    }
                }
            }
        }

        // Save ASSISTANT message for this user
        $assistantMsg = ChatMessage::create([
            'user_id' => $userId,   // IMPORTANT
            'role' => 'assistant',
            'content' => $assistantText,
        ]);

        return response()->json([
            'status' => 'ok',
            'assistant' => $assistantText,
            'assistant_id' => $assistantMsg->id,
        ]);
    }
}
