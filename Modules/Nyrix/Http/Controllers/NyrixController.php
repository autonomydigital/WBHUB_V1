<?php

namespace Modules\Nyrix\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Nyrix\Services\ChatGPTService;

class NyrixController extends Controller
{
    public function __construct()
    {
        $request = request();

        if ($request->is('nyrix/toggle*')) {
            $this->middleware(function ($request, $next) {
                $user = auth()->user();
                if (!$user || !($user->hasRole('superadmin') || $user->hasRole('god'))) {
                    abort(403, 'Unauthorized access to Nyrix toggle.');
                }
                return $next($request);
            });
            return;
        }

        if (!config('nyrix.enabled')) {
            abort(403, 'Nyrix is currently disabled by system administrators.');
        }
    }

    public function index()
    {
        return view('Nyrix::index');
    }

    public function ask(Request $request)
    {
        $prompt = $request->input('prompt');

        try {
            // 🔄 Ask ChatGPTService and expect a structured array back
            $data = app(ChatGPTService::class)->ask($prompt);

            Log::info('[NYRIX GPT STRUCTURED RESPONSE]', $data);

            return response()->json([
                'message' => $data['message'] ?? '',
                'command' => $data['command'] ?? null,
                'explanation' => $data['explanation'] ?? 'No explanation provided.',
                'risky' => $data['risky'] ?? false,
            ]);
        } catch (\Throwable $e) {
            Log::error('NyrixController@ask failed', ['exception' => $e->getMessage()]);
            return response()->json([
                'error' => '⚠️ Failed to get AI response.',
                'debug' => $e->getMessage(),
            ], 500);
        }
    }

    public function toggleView()
    {
        $enabled = config('nyrix.enabled');
        return view('Nyrix::toggle', compact('enabled'));
    }

    public function toggle(Request $request)
    {
        $enabled = $request->has('enabled');
        $configPath = config_path('nyrix.php');
        $contents = file_get_contents($configPath);
        $newContents = preg_replace(
            "/'enabled'\s*=>\s*(true|false)/",
            "'enabled' => " . ($enabled ? 'true' : 'false'),
            $contents
        );
        file_put_contents($configPath, $newContents);

        return back()->with('message', 'Nyrix has been ' . ($enabled ? 'enabled' : 'disabled') . '.');
    }

    public function godModePanel()
    {
        $enabled = config('nyrix.enabled');
        return view('Nyrix::godmode', compact('enabled'));
    }

    public function execute(Request $request)
    {
        $command = $request->input('command');
    
        if (!$command) {
            Log::warning('Nyrix execute called without command', [
                'body' => $request->all(), // Debug: see what’s arriving
            ]);
            return response()->json(['output' => '⚠️ No command received.'], 400);
        }
    
        if (!auth()->user()->hasAnyRole(['admin', 'superadmin', 'god'])) {
            return response()->json(['output' => 'Access denied.'], 403);
        }
    
        try {
            $result = app('nyrix.commander')->dispatch($command);
            return response()->json(['output' => $result]);
        } catch (\Throwable $e) {
            Log::error("Nyrix command error: ".$e->getMessage());
            return response()->json(['output' => 'Command failed. Check logs.'], 500);
        }
    }
}
