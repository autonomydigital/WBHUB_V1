<?php 

namespace Modules\Nyrix\Services;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class NyrixCommandDispatcher
{
    public function dispatch($command)
    {
        return match (strtolower($command)) {
            'clear_cache' => $this->clearCache(),
            'view_clear' => $this->viewClear(),
            'migrate' => $this->migrate(),
            'refresh_system' => $this->refreshSystem(),
            'route_clear' => $this->routeClear(),
            'nuke' => $this->nukeEverything(),
            'config_cache' => (fn () => $this->call('config:cache', '✅ Config cached.'))(),
            'optimize' => (fn () => $this->call('optimize', '⚡ App optimized.'))(),
            'queue_restart' => (fn () => $this->call('queue:restart', '🔁 Queues restarted.'))(),
            'schedule_run' => (fn () => $this->call('schedule:run', '⏰ Scheduled tasks executed.'))(),
            'down_mode' => (fn () => $this->call('down', '🛑 App in maintenance mode.'))(),
            'up_mode' => (fn () => $this->call('up', '✅ App is live.'))(),
            'list_routes' => (fn () => collect(Route::getRoutes())->map(fn ($r) => $r->uri())->implode("\n"))(),
            'list_users' => (fn () => \App\Models\User::pluck('email')->implode("\n"))(),
            'dump_env' => (fn () => json_encode($_ENV, JSON_PRETTY_PRINT))(),
            'log_test' => (fn () => $this->testLog())(),
            default => 'Unknown command: ' . $command,
        };
    }
    
    protected function clearCache()
    {
        Artisan::call('cache:clear');
        return '✅ Cache cleared.';
    }
    
    protected function viewClear()
    {
        Artisan::call('view:clear');
        return '✅ View cache cleared.';
    }
    
    protected function migrate()
    {
        Artisan::call('migrate');
        return '✅ Database migration complete.';
    }
    
    protected function refreshSystem()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('config:clear');
        return '✅ System fully refreshed.';
    }

    protected function routeClear()
    {
        Artisan::call('route:clear');
        return '✅ Route cache cleared.';
    }   
    
    protected function nukeEverything()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('event:clear'); // Optional
        Artisan::call('optimize:clear'); // Clear compiled stuff
    
        return "💥 System obliterated. All caches cleared.";
    }

    protected function call($command, $message)
    {
        Artisan::call($command);
        return $message;
    }
    
    protected function testLog()
    {
        Log::info("🧪 Nyrix test log successful.");
        return '✅ Logged test entry to laravel.log';
    }

}