<?php

namespace App\Http\Controllers\Userpanel;

use App\Http\Controllers\Controller;
use App\Models\Click_activity;
use App\Models\Ratings;
use App\Models\Referral_links;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    //
    function profile_dashboard()
    {
        $data_user = auth()->user();
        // return $data_user;
        $referral_links_count = Referral_links::where('user_id', '=', $data_user->id)->count();

        $referral_links = Referral_links::where('user_id', '=', $data_user->id)->get();
        $all_ratings = Ratings::all();
        $user_review = Ratings::where('user_id', '=', $data_user->id)->get();

        $referral_links_data = DB::table('referral_links')
            ->leftJoin('click_activity', 'click_activity.referral_id', '=', 'referral_links.id')
            ->select(
                'referral_links.*',
                'click_activity.transaction_ratings',
                'click_activity.transaction_comments'
            )
            ->where('referral_links.user_id', '=', $data_user->id)
            ->get();

        $clicked_by_me = Click_activity::where('referee_user_id', '=', $data_user->id)->get();
        $clicked_by_others = Click_activity::where('referrer_user_id', '=', $data_user->id)->get();

        $total_clicks = Click_activity::where('referee_user_id', '=', $data_user->id)->orWhere('referrer_user_id', '=', $data_user->id)->count();
        $user_review = Ratings::where('user_id', '=', $data_user->id)->paginate(10);
        $user_referee = User::where('usertype', '=', 'referee')->get();

        $user_rating_review = Ratings::where('user_id', '=', $data_user->id)
            ->selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->get();
        $user_ratings = Ratings::where('user_id', '=', $data_user->id)->get();
        $average_rating = null;
        if ($user_ratings->count() > 1) {
            // Calculate the average rating
            $average_rating = $user_ratings->avg('rating');
        } elseif ($user_ratings->count() == 1) {
            // Get the single rating value directly
            $average_rating = $user_ratings->first()->rating;
        } else {
            $average_rating = 0;
        }
        $ratings_count = [
            '5_star' => 0,
            '4_star' => 0,
            '3_star' => 0,
            '2_star' => 0,
            '1_star' => 0,
        ];
        $total_ratings = 0;
        foreach ($user_rating_review as $rating) {
            $total_ratings += $rating->count;
            if ($rating->rating == 5) {
                $ratings_count['5_star'] = $rating->count;
            } elseif ($rating->rating == 4) {
                $ratings_count['4_star'] = $rating->count;
            } elseif ($rating->rating == 3) {
                $ratings_count['3_star'] = $rating->count;
            } elseif ($rating->rating == 2) {
                $ratings_count['2_star'] = $rating->count;
            } elseif ($rating->rating == 1) {
                $ratings_count['1_star'] = $rating->count;
            }
        }
        $percentages = [
            '5_star' => $total_ratings > 0 ? ($ratings_count['5_star'] / $total_ratings) * 100 : 0,
            '4_star' => $total_ratings > 0 ? ($ratings_count['4_star'] / $total_ratings) * 100 : 0,
            '3_star' => $total_ratings > 0 ? ($ratings_count['3_star'] / $total_ratings) * 100 : 0,
            '2_star' => $total_ratings > 0 ? ($ratings_count['2_star'] / $total_ratings) * 100 : 0,
            '1_star' => $total_ratings > 0 ? ($ratings_count['1_star'] / $total_ratings) * 100 : 0,
        ];
        return view('frontend.pages.userProfile', compact('data_user','referral_links','all_ratings','average_rating', 'percentages', 'referral_links_count', 'referral_links_data', 'clicked_by_me', 'clicked_by_others', 'total_clicks', 'user_review', 'user_referee', 'total_ratings'));
    }

    function edit_profile_get_details(string $id)
    {
        $data = User::find($id);
        return view('frontend.pages.editprofile', compact('data'));
    }

    function update_profile(string $id, Request $request)
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
            return redirect()->route('profile_dashboard')->with(['message' => 'Profile Updated successfully.']);
            // return response()->json(['success' => true, 'message' => 'Profile Updated successfully.', 'user' => $user]); 
        }
        return response()->json(['success' => false, 'message' => 'User Not Found']);
    }

    function user_profile_public(string $id)
    {
        $data = User::find($id);
        if (!$data) {
            return view('frontend.pages.user_profile_public')->with(['error' => 'User not found or User does not exist']);
        }
        $referral_links_count = Referral_links::where('user_id', '=', $data->id)->count();
        $referral_links = Referral_links::where('user_id', '=', $data->id)->paginate(10);
        // $total_clicks = Click_activity::where('referrer_user_id', '=', $id)->count();

        $total_clicks = Click_activity::where('referee_user_id', '=', $data->id)->orWhere('referrer_user_id', '=', $data->id)->count();

        $user_rating = Click_activity::where('referrer_user_id', '=', $id)->get();
        $user_review = Ratings::where('user_id', '=', $id)->get();
        $all_ratings = Ratings::all();
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

        return view('frontend.pages.user_profile_public', compact('data', 'all_ratings', 'average_rating', 'referral_links', 'referral_links_count', 'total_clicks', 'user_rating', 'user_review'));
    }
}
