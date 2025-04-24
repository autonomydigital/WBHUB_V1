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
    
        $exists = UserConnection::where(function ($q) use ($auth, $target) {
            $q->where('user_id', $auth->id)->where('connected_user_id', $target->id);
        })->orWhere(function ($q) use ($auth, $target) {
            $q->where('user_id', $target->id)->where('connected_user_id', $auth->id);
        })->first();
    
        if ($exists) {
            return response()->json(['message' => 'Connection already exists or pending'], 409);
        }
    
        $connection = $auth->sentConnections()->create([
            'connected_user_id' => $target->id,
            'status' => 'pending',
        ]);
        
        $target->notify(new ConnectionRequestNotification($auth, $connection->id));
    
        return response()->json([
            'status' => 'pending',
            'user_name' => $target->first_name . ' ' . $target->last_name,
        ]);
    }

    public function acceptRequest(Request $request, $id)
    {
        $connection = UserConnection::where('user_id', $id)
            ->where('connected_user_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        $connection->update(['status' => 'accepted']);

        // Optional: create reciprocal connection
        UserConnection::firstOrCreate([
            'user_id' => auth()->id(),
            'connected_user_id' => $id,
        ], [
            'status' => 'accepted',
        ]);

        return response()->json([
            'status' => 'accepted',
            'user_id' => $connection->user_id,
            'user_name' => $connection->sender->first_name . ' ' . $connection->sender->last_name,
        ]);
    }

    public function denyRequest(Request $request, $id)
    {
        $connection = UserConnection::where('user_id', $id)
            ->where('connected_user_id', auth()->id())
            ->where('status', 'pending')
            ->firstOrFail();

        $connection->update(['status' => 'denied']);

        return response()->json([
            'status' => 'denied',
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
