<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \App\Models\Tweet;

class TimelineController extends Controller
{
    public function showTimelinePage()
    {
        $tweets = Tweet::latest()->get();  // <--- 追加
        return view('auth.timeline', compact('tweets'));   // <--- 変更
    }

    public function postTweet(Request $request)
    {
        $validator = $request->validate([
            'tweet' => ['required', 'string', 'max:280'],
        ]);
        Tweet::create([
            'user_id' => Auth::user()->id,
            'tweet' => $request->tweet,
            'created_at' => $request->created_at
        ]);
        return back();
    }
}
