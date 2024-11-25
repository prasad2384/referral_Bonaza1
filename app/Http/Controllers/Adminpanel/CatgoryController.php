<?php

namespace App\Http\Controllers\Adminpanel;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Referral_links;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CatgoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Category::paginate(5);
        return view('admin.pages.CategoryList', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.pages.AddCategory');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:categories,name'
        ]);
        // if ($validation->fails()) {
        //     return response()->json(['errors' => $validation->errors()]);
        // }
        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput();
        }
        $category_name = $request->get('name');
        $category = Category::create([
            'name' => $category_name
        ]);
        return redirect()->route('category.index')->with(['message' => 'Category Created Successfully...']);

        // return response()->json(['success' => true, 'message' => 'Category Created Successfully']);
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
        $data = Category::find($id);
        return view('admin.pages.EditCategory', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validation = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories')->ignore($id)
            ]
        ]);

        // if ($validation->fails()) {
        //     return response()->json(['errors' => $validation->errors()]);
        // }
        if ($validation->fails()) {
            return redirect()->back()
                ->withErrors($validation)
                ->withInput();
        }
        $user = Category::find($id);
        $category_name = $request->get('name');
        $data = [
            'name' => $category_name,
        ];
        $user->update($data);
        return redirect()->route('category.index')->with(['message' => 'Category Updated Successfully...']);

        // return response()->json(['success' => true, 'message' => 'Category Updated Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $data = Category::find($id);
        $referral_links = Referral_links::where('category_id', '=', $id)->count();
        if ($referral_links > 0) {
        return redirect()->route('category.index')->with(['alert-type' => 'warning','message' => 'Category cannot be deleted because there are referral links associated with this category.']);

        } else {
            $data->delete();
            return redirect()->route('category.index')->with([ 'alert-type' => 'success' , 'message' => 'Category Deleted Successfully...']);
        }
    }
}
