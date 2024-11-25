<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Referral_links;
use App\Models\Referral_websites;
use App\Models\Click_activity;
use App\Models\Ratings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FrontendController extends Controller
{
    function index()
    {
        $category = Category::all();
        $referral_links = Referral_links::all();
        $referral_website = Referral_websites::all();
        return view('frontend.pages.index', compact('category', 'referral_links', 'referral_website'));
    }

    // function profile_dashboard()
    // {
    //     $data = auth()->user();
    //     $referral_links_count = Referral_links::where('user_id', '=', $data->id)->count();


    //     $referral_links_data = DB::table('referral_links')
    //         ->leftJoin('click_activity', 'click_activity.referral_id', '=', 'referral_links.id')
    //         ->select(
    //             'referral_links.*',
    //             'click_activity.transaction_ratings',
    //             'click_activity.transaction_comments'
    //         )
    //         ->where('referral_links.user_id', '=', $data->id)
    //         ->get();



    //     $clicked_by_me = Click_activity::where('referee_user_id', '=', $data->id)->get();
    //     $clicked_by_others = Click_activity::where('referrer_user_id', '=', $data->id)->get();

    //     $total_clicks= Click_activity::where('referee_user_id','=',$data->id)->orWhere('referrer_user_id', '=', $data->id)->count();
    //     return view('frontend.pages.userProfile', compact('data', 'referral_links_count', 'referral_links_data', 'clicked_by_me', 'clicked_by_others','total_clicks'));
    // }

    // function edit_profile_get_details(string $id)
    // {
    //     $data = User::find($id);
    //     return view('frontend.pages.editprofile', compact('data'));
    // }

    // function update_profile(string $id, Request $request)
    // {

    //     $validation = Validator::make($request->all(), [
    //         'username' => [
    //             'required',
    //             'string',
    //             'max:255',
    //             Rule::unique('users')->ignore($id)
    //         ],
    //         'email' => [
    //             'required',
    //             'string',
    //             'max:255',
    //             'email',
    //             Rule::unique('users')->ignore($id)
    //         ],
    //     ]);
    //     if ($validation->fails()) {
    //         return response()->json(['errors' => $validation->errors()]);
    //     }

    //     $user = User::find($id);

    //     if ($user) {
    //         $data = [
    //             'username' => $request->get('username'),
    //             'firstname' => $request->get('firstname'),
    //             'lastname' => $request->get('lastname'),
    //             'email' => $request->get('email'),
    //             'phone' => $request->get('phone'),
    //             'about' => $request->get('about'),
    //             'status' => $request->get('status'),
    //             'address' => $request->get('address')
    //         ];

    //         if ($request->hasFile('logo')) {
    //             // Upload the new logo
    //             $file = $request->file('logo');
    //             $filename = $file->getClientOriginalName();
    //             $destinationPath = public_path('images');
    //             $file->move($destinationPath, $filename);
    //             $data['logo'] = $filename;
    //         }
    //         $user->update($data);
    //         return response()->json(['success' => true, 'message' => 'Profile Updated successfully.', 'user' => $user]);
    //     }
    //     return response()->json(['success' => false, 'message' => 'User Not Found']);
    // }

    function click_dashboard()
    {
        $data = auth()->user();
        $all_users = User::all();
        $referral_links_all = Referral_links::all();
        $Referral_websites = Referral_websites::all();

        $referral_links_count = Referral_links::where('user_id', '=', $data->id)->count();
        $referral_links_data = Referral_links::where('user_id', '=', $data->id)->get();
        $clicked_by_me = Click_activity::where('referee_user_id', '=', $data->id)->get();
        $clicked_by_others = Click_activity::where('referrer_user_id', '=', $data->id)->get();
        $total_clicks = Click_activity::where('referee_user_id', '=', $data->id)->orWhere('referrer_user_id', '=', $data->id)->count();
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

        return view('frontend.pages.clickdashboard', compact('data','average_rating','all_users', 'referral_links_count', 'referral_links_all', 'Referral_websites', 'referral_links_data', 'clicked_by_me', 'clicked_by_others', 'total_clicks'));
    }

    function referral_pages_dashboard()
    {
        $data = auth()->user();
        $all_users = User::all();
        $referral_links_all = Referral_links::all();
        $referral_links_count = Referral_links::where('user_id', '=', $data->id)->count();
        $referral_links_data = Referral_links::where('user_id', '=', $data->id)->get();
        $clicked_by_me = Click_activity::where('referee_user_id', '=', $data->id)->get();
        $clicked_by_others = Click_activity::where('referrer_user_id', '=', $data->id)->get();
        $total_clicks = Click_activity::where('referee_user_id', '=', $data->id)->orWhere('referrer_user_id', '=', $data->id)->count();
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

        return view('frontend.pages.referalpages', compact('data', 'average_rating', 'all_users', 'referral_links_all', 'referral_links_count', 'referral_links_data', 'clicked_by_me', 'clicked_by_others', 'total_clicks'));
    }

    function user_message(string $id)
    {
        $data = User::find($id);
        $referral_links_count = Referral_links::where('user_id', '=', $data->id)->count();
        return view('frontend.pages.message', compact('data', 'referral_links_count'));
    }

    function terms_condition(string $id)
    {

        $data = Referral_websites::find($id);
        // return $data->id;
        // $user = auth()->user();
        // $referee_user_id = auth()->user();
        $all_user = User::all();
        $referral_links_data = Referral_links::where('offer_id', $data->id)->where(function ($query) {
            $query->where('status', 'Active');
        })->get();
        // $star_data = Click_activity::find($referee_user_id);
        // return $referral_links_data;

        
        return view('frontend.pages.terms_condition', compact('data', 'all_user', 'referral_links_data'));

        // return view('frontend.pages.terms_condition', compact('data', 'all_user', 'user','star_data', 'referral_links_data'));
    }

    function referral_code(string $id)
    {
        if (auth()->check()) {
            $category = Category::all();
            $user = auth()->user();
            $referral_links_data = Referral_links::find($id);
            return view('frontend.pages.ReferralCode', compact('referral_links_data', 'user', 'category'));
        } else {
            return redirect()->route('login')->with('alert', 'Please sign in to access the referral code.');
        }
    }

    // function store_click_activity_data(Request $request)
    // {
    //     $current_time = now();

    //     $validatedData = $request->validate([
    //         'data_pst' => 'required|date',
    //         'referral_id' => 'required|integer',
    //         'referee_user_id' => 'required|integer',
    //         'referrer_user_id' => 'required|integer',
    //         'click_timestamps' => 'nullable|integer',
    //         'referee_confirmation_status' => 'nullable|max:255',
    //         'referrer_paid_platform_fee' => 'nullable|max:255',
    //         'referrer_paid_referee' => 'nullable|max:255',
    //         'transaction_comments' => 'nullable|max:255',
    //         'transaction_ratings' => 'nullable|numeric',
    //     ]);


    //     $validatedData['click_timestamps'] = $current_time->timestamp;
    //     $click_activity = Click_activity::create($validatedData);

    //     return back();
    // }


    public function store_click_activity_data(Request $request)
    {
        // Get current timestamp
        $current_time = now()->timestamp;

        // Get all input data from the request
        $data = $request->all();

        // Add the current timestamp to the data
        $data['click_timestamps'] = $current_time;

        $existingClick = Click_activity::where('referee_user_id', $data['referee_user_id'])
        ->where('referral_id', $data['referral_id'])
        ->where('referrer_user_id', $data['referrer_user_id'])
        ->first();
        if(!$existingClick){
            $click_activity = Click_activity::create($data);

            if ($click_activity) {
                return redirect()->to($data['referral_url'])->with('success', 'Data has been successfully processed.');
            } else {
                return redirect()->back();
            }
        }
        else{
            return redirect()->to($data['referral_url'])->with('success', 'Data has been successfully processed.');
        }

        // Create a new Click_activity entry with the data
       
    }


    function share_referral()
    {
        return view('frontend.pages.sharerefeeral');
    }

    function how_it_works()
    {
        return view('frontend.pages.how_it_works');
    }

    // function user_profile_public(string $id)
    // {
    //     $data = User::find($id);
    //     if (!$data) {
    //         return view('frontend.pages.user_profile_public')->with(['error' => 'User not found or User does not exist']);
    //     }
    //     $referral_links_count = Referral_links::where('user_id', '=', $data->id)->count();
    //     $referral_links = Referral_links::where('user_id', '=', $data->id)->paginate(10);
    //     return view('frontend.pages.user_profile_public', compact('data', 'referral_links', 'referral_links_count'));
    // }


    function brand_search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category_id');

        $brands = Referral_links::where('display_name', 'LIKE', "%{$query}%")->where('status', 'Active');

        if ($categoryId) {
            $brands->where('category_id', $categoryId);
        }

        return response()->json($brands->get());
    }
    function faq()
    {
        return view('frontend.pages.faq');
    }
    function all_websites_show($id)
    {
        $referral_website = Referral_websites::where('category_id', '=', $id)->get();
        $category = Category::find($id);
        return view('frontend.pages.all_websites', compact('referral_website','category'));
    }
}
