<?php

namespace App\Http\Controllers\Userpanel;
use App\Http\Controllers\Controller;
use App\Libraries\General;
use App\Models\Category;
use App\Models\Referral_links;
use App\Models\Referral_websites;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ShareReferralLinkController extends Controller
{
    //
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
            $file->move(public_path('images/'), $filename);
            $logoPath = $filename;
        }
        $referralWebsite=Referral_websites::create([
            'user_id'=> Auth::id(),
            'category_id'=>$request->input('category_id'),
            'canonicalized_name'=>strtolower(preg_replace('/\s+/', '_', $request->input('display_name'))),
            'logo'=>$logoPath,
            'promo_terms'=>$request->input('promo_terms'),
            'promo_terms_url'=>$request->input('promo_terms_url'),
            'promo_expiration_date'=>$request->input('promo_expiration_data'),
            'status'=>"Active",
            'expected_payout'=>$request->input('expected_payout_by_website'),
            'referee_share_percentage'=>45,
            'referral_share_percentage'=>45,
            'platform_percentage'=>10,
            'expected_days'=>$request->input('expected_days')
        ]);
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
        $referralLink->offer_id = $referralWebsite->id;
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
