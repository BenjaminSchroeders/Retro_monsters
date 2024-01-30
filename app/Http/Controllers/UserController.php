<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function toggleFollow(Request $request)
    {
        $userToFollow = User::findOrFail($request->user_id);
        $currentUser = auth()->user();
    
        if ($currentUser->following->contains($userToFollow->id)) {
            $currentUser->following()->detach($userToFollow->id);
            return response()->json(['estAbonne' => false]);
        } else {
            $currentUser->following()->attach($userToFollow->id);
            return response()->json(['estAbonne' => true]);
        }
    }

}
