<?php

namespace App\Http\Controllers\Refereepanel;
use App\Http\Controllers\Controller;
use App\Models\Click_activity;
use App\Models\Ratings;
use App\Models\Referral_links;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RefereeController extends Controller
{
    //
    public function referee_dashboard(){
        $data = auth()->user();
        $clicked_by_me = Click_activity::where('referee_user_id', '=', $data->id)->count();
        $all_users= User::all();
        // $referral_links_data = DB::table('referral_links')
        // ->leftJoin('click_activity', 'click_activity.referral_id', '=', 'referral_links.id')
        // ->select(
        //     'referral_links.*',
        //     'click_activity.transaction_ratings',
        //     'click_activity.transaction_comments'
        // )
        // ->where('referral_links.user_id', '=', $data->id)
        // ->get();
        $referral_links=Referral_links::all();

        $referee_links_click_data=Click_activity::where('referee_user_id','=',$data->id)->get();

        return view('frontend.Refereepages.RefereeDashboard',compact('data','clicked_by_me','referee_links_click_data','referral_links','all_users'));
    }
    public function save_ratings(Request $request){
        $data= auth()->user();
        $user_id=$request->get('referrer_user_id');
        $referee_id = $data->id;
        $ratings=$request->get('rating');
        $message=$request->get('message');  
        $referral_link_id=$request->get('referral_link_id');
        $click_id=Click_activity::find($request->get('click_id'));
        // return $click_id;
        $click_id->transaction_ratings=$ratings;
        $click_id->transaction_comments=$message;
        $click_id->rating_status=1;
        $click_id->save();
        $rating=Ratings::create([
            'referee_id'=>$referee_id,
            'user_id'=>$user_id,
            'referral_link_id'=>$referral_link_id,
            'message'=>$message,
            'rating' => $ratings,
        ]);
        return redirect()->route('referee_dashboard')->with(['message'=>'Thank You for Rating...']);
    }
    public function edit_profile($id){
        $data = User::find($id);
        return view('frontend.Refereepages.edit_profile', compact('data'));
    }
    function update_profile_referee(string $id, Request $request)
    {

        $validation = Validator::make($request->all(), [
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($id)
            ],
            'email' => [
                'required',
                'string',
                'max:255',
                'email',
                Rule::unique('users')->ignore($id)
            ],
        ]);
        if ($validation->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validation->errors(),
                'inputs' => $request->all()
            ]);
        }

        $user = User::find($id);

        if ($user) {
            $data = [
                'username' => $request->get('username'),
                'firstname' => $request->get('firstname'),
                'lastname' => $request->get('lastname'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'about' => $request->get('about'),
                'status' => $request->get('status'),
                'address' => $request->get('address')
            ];

            if ($request->hasFile('logo')) {
                // Upload the new logo
                $file = $request->file('logo');
                $filename = $file->getClientOriginalName();
                $destinationPath = public_path('images');
                $file->move($destinationPath, $filename);
                $data['logo'] = $filename;
            }
            $user->update($data);
            return redirect()->route('referee_dashboard')->with(['message'=>'Profile Updated Successfully.']);
            // return response()->json(['success' => true, 'message' => 'Profile Updated successfully.', 'user' => $user]);
        }
        return response()->json(['success' => false, 'message' => 'User Not Found']);
    }
}
