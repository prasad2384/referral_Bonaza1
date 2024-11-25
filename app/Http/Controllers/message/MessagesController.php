<?php

namespace App\Http\Controllers\message;

use App\Http\Controllers\Controller;
use App\Models\Click_activity;
use App\Models\Message;
use App\Models\Ratings;
use App\Models\Referral_links;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    /**
     * In this controller all login about users coversation managed.
     * list of users for conversation.
     */
    public function message_home()
    {
        $authId = Auth::id();
        $data = User::find($authId);
        $referral_links_count = Referral_links::where('user_id', '=', $data->id)->count();
        // $user_all = User::where('usertype', '!=', 'admin')->where('id', '!=', $authId)->get();
        $user_review = Ratings::where('user_id', '=', $data->id)->get();
        // $all_ratings = Ratings::all();
        // return $referral_links;
        // return $user_rating;
        $average_rating = null;
        if ($user_review->count() > 1) {
            // Calculate the average rating
            $average_rating = $user_review->avg('rating');
        } elseif ($user_review->count() == 1) {
            // Get the single rating value directly
            $average_rating = $user_review->first()->rating;
        } else {
            $average_rating = 0;
        }

        $msgList = Message::Where('sender_id', $authId)
            ->orwhere('receiver_id', $authId)
            ->get();
        $userList = [];
        foreach ($msgList as $rcd) {
            if ($rcd->sender_id == $authId) {
                $userList[$rcd->receiver_id] = $rcd->receiver_id;
            }
            if ($rcd->receiver_id == $authId) {
                $userList[$rcd->sender_id] = $rcd->sender_id;
            }
        }

        $userData = User::whereIn('id', $userList)->select('username', 'logo', 'id', 'firstname', 'lastname')->get();
        $total_clicks = Click_activity::where('referee_user_id', '=', $data->id)->orWhere('referrer_user_id', '=', $data->id)->count();
        return view('frontend.pages.message', compact('data','average_rating', 'referral_links_count', 'userData', 'total_clicks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function save_message(Request $request)
    {

        if(!Auth::id()){
            return redirect()->route('login')->with(['alert'=>'Please login and Send the Message']);
        }

        $res = Message::create([
            'message' =>  $request->get('message'),
            'receiver_id' => $request->get('receiver_id'),
            'sender_id' => Auth::id(),
        ]);
        if ($res) {
            return response()->json(['type' => 'success', 'message' => 'Message sent successfully']);
        }
        return response()->json(['type' => 'error', 'message' => 'Something went wrong']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function get_msg_data(string $id)
    {
        $msgList = Message::Where('sender_id', $id)
            ->Orwhere('receiver_id', $id)
            ->get();
        $msgIds = [];
        foreach ($msgList as $rcd) {
            $msgIds[$rcd->id] = $rcd->id;
        }
        Message::whereIn('id', $msgIds)->where('seen', 0)->update(['seen' => 1]); // update seened msg status

        $userdata = User::find($id);

        return response()->json([
            'msgList' => $msgList,
            'userdata' => $userdata
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(messages $messages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(messages $messages)
    {
        //
    }
}
