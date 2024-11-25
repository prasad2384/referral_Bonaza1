<?php

namespace App\Http\Controllers\Adminpanel;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Referral_links;
use App\Models\Referral_websites;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Libraries\General;

class ReferralLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $category = Category::all();
        $user = User::all();
        $referral_links = Referral_links::paginate(5);
        $referral_website_data = Referral_websites::all();
        return view('admin.pages.ReferrallinksList', compact('category', 'user', 'referral_links', 'referral_website_data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::all();
        $user = User::all();
        $referral_website_data = Referral_websites::all();
        return view('admin.pages.AddREferrallinks', compact('category', 'user', 'referral_website_data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer',
            'user_id' => 'required|integer',
            'referral_url' => 'required|url',
            'display_name' => 'required|string|max:255',
            'canonicalized_name' => 'nullable|string|max:255',
            'promo_terms' => 'required|string|max:255',
            'promo_terms_url' => 'required|url',
            'promo_expiration_date' => 'required|date',
            'expected_payout' => 'required|numeric',
            'offer_id' => 'required|integer',
            'referee_share_percentage' => 'required|integer',
            'referral_share_percentage' => 'required|integer',
            'platform_percentage' => 'required|integer',
            'status' => 'nullable|string|in:Pending,Active,Expired',
            'expected_days' => 'required|integer',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,ico,bmp|max:2048',
        ]);

        $logo = null;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path('images');
            $filePath = $destinationPath . '/' . $filename;
            if (!file_exists($filePath)) {
                $file->move($destinationPath, $filename);
            }
            $logo = $filename;
        }

        $referral_links = Referral_links::create([
            'category_id' => $request->get('category_id'),
            'user_id' => $request->get('user_id'),
            'referral_url' => $request->get('referral_url'),
            'display_name' => $request->get('display_name'),
            'canonicalized_name' => $request->get('canonicalized_name'),
            'promo_terms' => $request->get('promo_terms'),
            'promo_terms_url' => $request->get('promo_terms_url'),
            'promo_expiration_date' => $request->get('promo_expiration_date'),
            'expected_payout_by_referar' => $request->get('expected_payout'),
            'offer_id' => $request->get('offer_id'),
            'referee_share_percentage' => $request->get('referee_share_percentage'),
            'referral_share_percentage' => $request->get('referral_share_percentage'),
            'platform_percentage' => $request->get('platform_percentage'),
            'expected_days' => $request->get('expected_days'),
            'logo' => $logo,
            'status' => $request->get('status', 'Pending'),
        ]);
        return redirect()->route('referral_links.index')->with(['message' => 'Referral Link Created Successfully...']);

        // return response()->json(['success' => true, 'message' => 'Referral Link Created Successfully'], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = User::all();
        $category = Category::all();
        $data = Referral_links::find($id);
        $referral_website_data = Referral_websites::all();
        return view('admin.pages.EditReferrallinks', compact('user', 'category', 'data', 'referral_website_data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $category_id = $request->get('category_id');
        $user_id = $request->get('user_id');
        $referral_url = $request->get('referral_url');
        $display_name = $request->get('display_name');
        $canonicalized_name = $request->get('canonicalized_name');
        $promo_terms = $request->get('promo_terms');
        $promo_terms_url = $request->get('promo_terms_url');
        $promo_expiration_date = $request->get('promo_expiration_date');
        $expected_payout = $request->get('expected_payout');
        $offer_id = $request->get('offer_id');
        $referee_share_percentage = $request->get('referee_share_percentage');
        $referral_share_percentage = $request->get('referral_share_percentage');
        $platform_percentage = $request->get('platform_percentage');
        $status = $request->get('status');
        $expected_days = $request->get('expected_days');
        $referral_links = Referral_links::find($id);
        if ($referral_links) {
            $data = [

                'category_id' => $category_id,
                'user_id' => $user_id,
                'referral_url' => $referral_url,
                'display_name' => $display_name,
                'canonicalized_name' => $canonicalized_name,
                'promo_terms' => $promo_terms,
                'promo_terms_url' => $promo_terms_url,
                'promo_expiration_date' => $promo_expiration_date,
                'expected_payout_by_referar' => $expected_payout,
                'offer_id' => $offer_id,
                'referee_share_percentage' => $referee_share_percentage,
                'referral_share_percentage' => $referral_share_percentage,
                'platform_percentage' => $platform_percentage,
                'expected_days' => $expected_days,
                'status' => $status,
            ];
            if ($request->hasFile('logo')) {
                // Upload the new logo
                $file = $request->file('logo');
                $filename = $file->getClientOriginalName();
                $destinationPath = public_path('images');
                $file->move($destinationPath, $filename);
                $data['logo'] = $filename;
            }
            DB::table('referral_links')->where('id', $id)->update($data);

            return redirect()->route('referral_links.index')->with(['message' => 'Referral Link Updated Successfully...']);

            // return response()->json(['success' => true, 'message' => 'Referral Link Update Successfully']);
        }
        return response()->json(['success' => false, 'message' => 'Referral Link Not Found']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Referral_links::find($id);
        $data->delete();
        return redirect()->route('referral_links.index')->with(['message' => 'Referral Link Deleted Successfully...']);

        // return response()->json(['success' => true, 'message' => 'Referral Link Deleted Successfully']);
    }

    public function shareReferralLink()
    {
        $category = Category::all();
        $data = auth()->user();
        $referral_links_data = Referral_links::where('user_id', '=', $data->id)->get();
        return view('frontend.pages.shareReferralLink', compact('category', 'referral_links_data'));
    }

    public function editReferralLink($id)
    {
        try {
            $referralLink = Referral_links::findOrFail($id);
            $categories = Category::all(); // Assuming you have a Category model

            return view('frontend.pages.shareReferralLink', compact('referralLink', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Data not found']);
        }
    }

    public function getReferralLinkData($id)
    {
        try {
            $referralLink = Referral_links::findOrFail($id);
            return response()->json($referralLink, 200);
            return view('frontend.pages.shareReferralLink', compact('referralLink'));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Data not found'], 404);
        }
        return view('frontend.pages.shareReferralLink', compact('referralLink', 'categories'));
    }


    public function updateReferralLink(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:referral_links,id',
            'category_id' => 'required|integer',
            'referral_url' => 'required|url',
            'display_name' => 'required|max:255',
            'logo' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'promo_terms' => 'nullable|max:255',
            'promo_terms_url' => 'nullable|url',
            'promo_expiration_date' => 'nullable|date',
            'expected_payout_by_referar' => 'required|numeric',
            'expected_payout_by_website' => 'nullable|numeric',
            'expected_days' => 'nullable|numeric',
        ]);

        try {
            $referralLink = Referral_links::findOrFail($request->input('id'));

            $referralLink->category_id = $request->input('category_id');
            $referralLink->referral_url = $request->input('referral_url');
            $referralLink->display_name = $request->input('display_name');
            $referralLink->promo_terms = $request->input('promo_terms');
            $referralLink->promo_terms_url = $request->input('promo_terms_url');
            $referralLink->promo_expiration_date = $request->input('promo_expiration_date');
            $referralLink->expected_payout_by_referar = $request->input('expected_payout_by_referar');
            $referralLink->expected_payout_by_website = $request->input('expected_payout_by_website');
            $referralLink->expected_days = $request->input('expected_days');

            // Handle file upload
            if ($request->hasFile('logo')) {
                $file = $request->file('logo');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/logos'), $filename);
                $referralLink->logo = $filename;
            }

            $referralLink->save();

            return redirect()->route('share.referral.link')->with('success', 'Referral link updateed successfully.'); // return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return redirect()->route('share.referral.link')->with('error', 'Failed to update referral link. Please try again later.'); // return response()->json(['success' => false], 500);
        }
    }



    public function saveReferralLink(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required|string|max:255',
            'referral_url' => 'required|url',
            'display_name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'promo_terms' => 'nullable|string|max:255',
            'promo_terms_url' => 'nullable|url',
            'promo_expiration_date' => 'nullable|date',
            'expected_payout_by_referar' => 'required|numeric',
            'expected_payout_by_website' => 'nullable|numeric',
            'expected_days' => 'nullable|integer'
        ]);

        if (!$validatedData) {
            return redirect()->route('share.referral.link')
                ->withErrors($validatedData)
                ->withInput();
        }

        $logoPath = null;
        if ($request->hasfile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/logos'), $filename);
            $logoPath = $filename;
        }

        $referralLink = new Referral_links();
        $referralLink->category_id = $request->input('category_id');
        $referralLink->user_id = Auth::id();
        $referralLink->referral_url = $request->input('referral_url');
        $referralLink->display_name = $request->input('display_name');
        $referralLink->canonicalized_name = strtolower(preg_replace('/\s+/', '_', $request->input('display_name')));
        $referralLink->logo = $logoPath;
        $referralLink->promo_terms = $request->input('promo_terms');
        $referralLink->promo_terms_url = $request->input('promo_terms_url');
        $referralLink->promo_expiration_date = $request->input('promo_expiration_date');
        $referralLink->expiry_date = $request->input('promo_expiration_date');
        $referralLink->status = 'Pending';
        $referralLink->expected_payout_by_referar = $request->input('expected_payout_by_referar');
        $referralLink->expected_payout_by_website = $request->input('expected_payout_by_website');
        $referralLink->referee_share_percentage = 45;
        $referralLink->referral_share_percentage = 45;
        $referralLink->platform_percentage = 10;
        $referralLink->expected_days = $request->input('expected_days');

        $content = [
            "title" => "this is title",
            "emailMessage" => "Hi admin, someone has created new referral link and he is waiting for your approval."
        ];

        if ($referralLink->save()) {
            $admin = User::where('usertype', 'admin')->first();
            if (isset($admin) && isset($admin->email)) {
                if (General::sendEmail($admin->email, "New refferal link generated", $content)) {
                    return redirect()->route('share.referral.link')->with('success', 'Referral link created successfully.');
                } else {
                    return redirect()->route('share.referral.link')->with('error', 'Referral link created successfully but there was an error while sending email notification to admin.');
                }
            } else {
                return redirect()->route('share.referral.link')->with('success', 'Referral link created successfully.');
            }
        } else {
            return redirect()->route('share.referral.link')->with('error', 'Failed to create referral link. Please try again later.');
        }
    }
}
