<?php

namespace Modules\Nyrix\Services;

use OpenAI\Laravel\Facades\OpenAI;

class ChatGPTService
{
    public function ask($prompt)
    {
        $systemPrompt = <<<PROMPT
You are Nyrix, an AI assistant built into a Laravel admin system.

Your job is to:
1. Detect if a user is asking for a system task (like clearing cache, migrating DB, etc).
2. If so, respond with a structured JSON block that includes:
    - "command": one of the known internal command keys
    - "explanation": a human-friendly summary
    - "message": an optional friendly message
    - "risky": true or false

Example:
{
  "command": "clear_cache",
  "message": "✅ Cache cleared successfully.",
  "explanation": "This clears Laravel's application cache using the artisan command.",
  "risky": false
}

If the prompt is not a system task (e.g. “what's the capital of France”), set:
- "command": null
- "explanation": ""
- "message": your helpful response to the user

NEVER return artisan commands like "php artisan ...".
NEVER use markdown, code blocks, or explanations outside the JSON.

Valid commands are:
- clear_cache
- view_clear
- migrate
- refresh_system
- route_clear
- nuke
- config_cache
- optimize
- queue_restart
- schedule_run
- down_mode
- up_mode
- list_routes
- list_users
- dump_env
- log_test

If none match, just answer naturally with "command": null.
PROMPT;

        $response = OpenAI::chat()->create([
            'model' => 'gpt-4',
            'messages' => [
                ['role' => 'system', 'content' => $systemPrompt],
                ['role' => 'user', 'content' => $prompt],
            ],
            'temperature' => 0.7,
        ]);

        $text = $response->choices[0]->message->content ?? 'No response.';

        // Try decoding as JSON
        $decoded = json_decode($text, true);

        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return [
                'message' => $decoded['message'] ?? '',
                'command' => $decoded['command'] ?? null,
                'explanation' => $decoded['explanation'] ?? '',
                'risky' => $decoded['risky'] ?? false,
            ];
        }

        // If not JSON, return as basic message
        return [
            'message' => $text,
            'command' => null,
            'explanation' => '',
            'risky' => false,
        ];
    }
}