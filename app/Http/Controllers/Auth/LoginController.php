<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\LoginHistory;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
{
    $agent = new Agent();
    $agent->setUserAgent($request->header('User-Agent'));

    $device   = $agent->device();
    $browser  = $agent->browser();

    $ip = $request->ip();
    if ($ip === '127.0.0.1' || $ip === '::1') {
        $ip = '1.132.110.100'; // Telstra IP in Brisbane, QLD
    }

    // Default nulls
    $city = $region = $country = null;

    try {
        $response = Http::get("http://ip-api.com/json/{$ip}");

        Log::info('IP-API Response', ['raw' => $response->body()]);

        if ($response->ok()) {
            $data = $response->json();
            Log::info('Parsed IP-API data', ['data' => $data]);

            $city    = $data['city'] ?? null;
            $region  = $data['regionName'] ?? null;
            $country = $data['country'] ?? null;
        }
    } catch (\Exception $e) {
        Log::warning('IP location fetch failed', ['error' => $e->getMessage()]);
    }

    // Save login history
    LoginHistory::create([
        'user_id'     => $user->id,
        'device'      => "{$device} on {$browser}",
        'ip_address'  => $request->ip(),
        'city'        => $city,
        'region'      => $region,
        'country'     => $country,
        'logged_in_at'=> now()->setTimezone('Australia/Brisbane'),
    ]);
}
}
