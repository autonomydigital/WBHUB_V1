<?php 

namespace Modules\Users\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class UserFollowController extends Controller
{
    public function toggle(Request $request)
    {
        // Needed to parse JSON body
        $request->merge(json_decode($request->getContent(), true));

        $auth = auth()->user();
        $targetId = $request->input('user_id');
        $target = User::findOrFail($targetId);

        // Log input to verify it’s arriving
        Log::info('🔁 Follow toggle request', [
            'auth_id' => $auth->id,
            'target_id' => $target->id
        ]);

        if ($auth->isFollowing($target)) {
            $auth->following()->detach($target->id);
            Log::info('🗑️ Detached follow', ['follower' => $auth->id, 'followed' => $target->id]);

            return response()->json([
                'status' => 'unfollowed',
                'message' => 'Unfollowed successfully.',
                'user_id' => $target->id,
                'user_name' => $target->first_name . ' ' . $target->last_name,

            ]);
        } else {
            $auth->following()->attach($target->id);
            Log::info('➕ Attached follow', ['follower' => $auth->id, 'followed' => $target->id]);

            return response()->json([
                'status' => 'followed',
                'message' => 'Followed successfully.',
                'user_id' => $target->id,
                'user_name' => $target->first_name . ' ' . $target->last_name,

            ]);
        }
    }
}

?>