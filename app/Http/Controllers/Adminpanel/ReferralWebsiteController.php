<?php

namespace App\Http\Controllers\Adminpanel;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Referral_websites;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReferralWebsiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $category = Category::all();
        $user = User::all();
        $referral_website = Referral_websites::paginate(5);
        return view('admin.pages.ReferralwebsiteList', compact('category', 'user', 'referral_website'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $category = Category::all();
        $user = User::all();
        return view('admin.pages.AddReferralwebsiteList', compact('category', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation =  Validator::make($request->all(),[
            'category_id' => 'required|integer',
            'user_id' => 'required|integer',
            'canonicalized_name' => 'nullable|string|max:255',
            'logo' => 'required|image|mimes:jpg,jpeg,png,ico,bmp|max:2048',
            'promo_terms' => 'required|string|max:255',
            'promo_terms_url' => 'required|url',
            'promo_expiration_date' => 'required|date',
            'expected_payout' => 'required|numeric',
            'referee_share_percentage' => 'required|integer',
            'referral_share_percentage' => 'required|integer',
            'platform_percentage' => 'required|integer',
            'expected_days' => 'required|integer',
            'status' => 'required|string|in:Pending,Active,Expired',
        ]);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        }

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path('images');
            $filePath = $destinationPath . '/' . $filename;
            if (!file_exists($filePath)) {
                $file->move($destinationPath, $filename);
            }
            $logo = $filename;
            // $validatedData['logo'] = $logo;
        }
        $category_id=$request->get('category_id');
        $user_id = $request->get('user_id');
        $canonicalized_name=$request->get('canonicalized_name');
        $promo_terms=$request->get('promo_terms');
        $promo_terms_url=$request->get('promo_terms_url');
        $promo_expiration_date=$request->get('promo_expiration_date');
        $expected_payout=$request->get('expected_payout');
        $referee_share_percentage=$request->get('referee_share_percentage');
        $referral_share_percentage=$request->get('referral_share_percentage');
        $platform_percentage=$request->get('platform_percentage');
        $expected_days=$request->get('expected_days');
        $status=$request->get('status');
        $referralWebsite = Referral_websites::create([
            'category_id'=>$category_id,
            'user_id'=>$user_id,
            'canonicalized_name' =>$canonicalized_name,
            'promo_terms'=>$promo_terms,
            'promo_terms_url'=>$promo_terms_url,
            'promo_expiration_date' => $promo_expiration_date,
            'expected_payout' => $expected_payout,
            'referee_share_percentage'=>$referee_share_percentage,
            'referral_share_percentage'=>$referral_share_percentage,
            'platform_percentage'=>$platform_percentage,
            'expected_days'=>$expected_days,
            'status'=>$status,
            'logo'=>$logo
        ]);

        return redirect()->route('referral_web_site.index')->with(['message' => 'Referral website added successfully...']);
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
        $data = Referral_websites::find($id);
        return view('admin.pages.EditReferralwebsiteList', compact('user', 'category', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validation = Validator::make($request->all(),[
            'category_id' => 'required|integer',
            'user_id' => 'required|integer',
            'canonicalized_name' => 'nullable|string|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,ico,bmp|max:2048',
            'promo_terms' => 'required|string|max:255',
            'promo_terms_url' => 'required|url',
            'promo_expiration_date' => 'required|date',
            'expected_payout' => 'required|numeric',
            'referee_share_percentage' => 'required|integer',
            'referral_share_percentage' => 'required|integer',
            'platform_percentage' => 'required|integer',
            'expected_days' => 'required|integer',
            'status' => 'required|string|in:Pending,Active,Expired',
        ]);

        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput();
        }
    
        $referralWebsite = Referral_websites::findOrFail($id);
      if($referralWebsite){
        $data=[
            'category_id'=>$request->get('category_id'),
            'user_id '=> $request->get('user_id'),
            'canonicalized_name'=>$request->get('canonicalized_name'),
            'promo_terms'=>$request->get('promo_terms'),
            'promo_terms_url'=>$request->get('promo_terms_url'),
            'promo_expiration_date'=>$request->get('promo_expiration_date'),
            'expected_payout'=>$request->get('expected_payout'),
            'referee_share_percentage'=>$request->get('referee_share_percentage'),
            'referral_share_percentage'=>$request->get('referral_share_percentage'),
            'platform_percentage'=>$request->get('platform_percentage'),
            'expected_days'=>$request->get('expected_days'),
            'status'=>$request->get('status'),
        ];
      }
    
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = $file->getClientOriginalName();
            $destinationPath = public_path('images');
            $filePath = $destinationPath . '/' . $filename;
    
            if (file_exists($destinationPath . '/' . $referralWebsite->logo)) {
                unlink($destinationPath . '/' . $referralWebsite->logo);
            }
    
            $file->move($destinationPath, $filename);
            $data['logo'] = $filename;
        } else {
            $data['logo'] = $referralWebsite->logo;
        }
        $referralWebsite->update($data);
        return redirect()->route('referral_web_site.index')->with(['message' => 'Referral website Updated Successfully...']);
        
        // return redirect()->back()->with('success', 'Referral website updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Referral_websites::find($id);
        $data->delete();
        return redirect()->route('referral_web_site.index')->with(['message' => 'Referral Website Deleted Successfully...']);
    }
}
