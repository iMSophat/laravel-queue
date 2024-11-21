<?php

namespace App\Http\Controllers;

use App\Jobs\Notify;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PushNotify extends Controller
{
    public function sendPushNotification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required|exists:users,id',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $users = User::where('notification_token', '!=', null)->where('user_role', '=', 'CUSTOMER')->get();

        foreach ($users as $key => $user) {
            Notify::dispatch($user->notification_token, $request->title . "-" . ($key + 1), $request->body);
        }


        return response()->json(['message' => 'Push notification sent successfully']);
    }
}
