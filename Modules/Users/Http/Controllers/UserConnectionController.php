<?php 

namespace Modules\Users\Http\Controllers;

use App\Models\User;
use App\Models\UserConnection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Notifications\ConnectionRequestNotification;

class UserConnectionController extends Controller
{
    public function sendRequest(Request $request)
{
    $request->merge(json_decode($request->getContent(), true));
    $auth = auth()->user();
    $target = User::findOrFail($request->input('user_id'));

    // 1. Block if already connected
    $acceptedExists = UserConnection::where(function ($q) use ($auth, $target) {
        $q->where('user_id', $auth->id)->where('connected_user_id', $target->id)
          ->orWhere('user_id', $target->id)->where('connected_user_id', $auth->id);
    })->where('status', 'accepted')->exists();

    if ($acceptedExists) {
        return response()->json(['message' => 'You are already connected.'], 409);
    }

    // 2. If connection exists (pending or denied), update it to pending again
    $existing = UserConnection::where('user_id', $auth->id)
        ->where('connected_user_id', $target->id)
        ->first();

    if ($existing) {
        $existing->update(['status' => 'pending']);
        $connection = $existing;
    } else {
        // 3. Otherwise create new connection
        $connection = $auth->sentConnections()->create([
            'connected_user_id' => $target->id,
            'status' => 'pending',
        ]);
    }

    // 4. Notify
    $target->notify(new ConnectionRequestNotification($auth, $connection->id));

    return response()->json([
        'status' => 'pending',
        'user_name' => $target->first_name . ' ' . $target->last_name,
    ]);
}

    public function acceptRequest(Request $request, $id)
{
    $auth = auth()->user();

    $connection = UserConnection::where('id', $id)
        ->where('connected_user_id', $auth->id)
        ->where('status', 'pending')
        ->firstOrFail();

    $connection->update(['status' => 'accepted']);

    // Create reciprocal connection
    UserConnection::firstOrCreate([
        'user_id' => $auth->id,
        'connected_user_id' => $connection->user_id,
    ], [
        'status' => 'accepted',
    ]);

    // Update the original notification
    $notification = $auth->notifications()
        ->where('data->connection_id', $connection->id)
        ->first();

    if ($notification) {
        $notification->update([
            'data' => array_merge($notification->data, [
                'type' => 'connection_confirmed',
                'title' => "Connected with <b>{$connection->sender->first_name} {$connection->sender->last_name}</b>",
                'icon' => 'ri-user-shared-line',
                'link' => route('profile.show', $connection->sender->id),
            ])
        ]);
        $notification->markAsRead();
    }

    return response()->json([
        'status' => 'accepted',
        'message' => "Connected with {$connection->sender->first_name} {$connection->sender->last_name}",
        'user_name' => $connection->sender->first_name . ' ' . $connection->sender->last_name,
        'user_id' => $connection->user_id,
    ]);
}

public function denyRequest(Request $request, $id)
{
    $auth = auth()->user();

    $connection = UserConnection::where('id', $id)
        ->where('connected_user_id', $auth->id)
        ->where('status', 'pending')
        ->firstOrFail();

    $connection->update(['status' => 'denied']);

    // Also delete reciprocal if it was created prematurely (optional safety)
    UserConnection::where('user_id', $auth->id)
        ->where('connected_user_id', $connection->user_id)
        ->delete();

    // Update or delete the original notification
    $notification = $auth->notifications()
        ->where('data->connection_id', $connection->id)
        ->first();

    if ($notification) {
        $notification->markAsRead(); // or delete it directly if you prefer
        $notification->delete();
    }

    return response()->json([
        'status' => 'denied',
        'message' => "Denied connection request from {$connection->sender->full_name}",
        'user_id' => $connection->user_id,
    ]);
}

    public function cancelRequest(Request $request, $id)
    {
        $connection = UserConnection::where('user_id', auth()->id())
            ->where('connected_user_id', $id)
            ->where('status', 'pending')
            ->firstOrFail();

        $connection->delete();

        return response()->json([
            'status' => 'cancelled',
            'user_id' => $id,
        ]);
    }

    public function disconnect(Request $request, $id)
    {
        $auth = auth()->user();

        $connection = UserConnection::where(function ($q) use ($auth, $id) {
            $q->where('user_id', $auth->id)->where('connected_user_id', $id);
        })->orWhere(function ($q) use ($auth, $id) {
            $q->where('user_id', $id)->where('connected_user_id', $auth->id);
        })->where('status', 'accepted')->firstOrFail();

        $connection->delete();

        return response()->json([
            'status' => 'disconnected',
            'user_id' => $id,
        ]);
    }

    public function incoming()
    {
        $requests = auth()->user()->receivedConnections()
            ->where('status', 'pending')
            ->with('sender')
            ->get();

        return view('users::connections.incoming', compact('requests'));
    }

    public function outgoing()
    {
        $requests = auth()->user()->sentConnections()
            ->where('status', 'pending')
            ->with('receiver')
            ->get();

        return view('users::connections.outgoing', compact('requests'));
    }

    public function index()
    {
        $connections = auth()->user()->connections()->paginate(20);
        return view('users::connections.index', compact('connections'));
    }
}
