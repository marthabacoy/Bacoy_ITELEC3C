<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BrandController extends Controller
{
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate('5');

        return view('admin.brand.index', compact('brands'));
    }

    public function AddBrand(Request $request)
    {
        $validated = $request->validate(
            [
                'brand_name' => 'required|unique:brands|max:255',
                'brand_image' => 'required|mimes:jpg,jpeg,png'

            ],
            [
                'brand_name.required' => "Please input brand name",
                'brand_name.max' => "Brand must be less than 255 characters",
                'brand_image.mimes' => "Required file extension: .jpg, .jpeg, .png",
            ]
        );

        $brand_image = $request->file('brand_image');

        $name_gen = hexdec(uniqid());
        $img_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen . "." .$img_ext;
        $up_loc = 'image/brand/';
        $last_img = $up_loc.$image_name;

        $brand_image->move($up_loc,$image_name);

        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_image'=>$last_img,
            'created_at'=>Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand Inserted Succesfully');
    }

    public function Edit($id){

        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }

    public function Update(Request $request , $id){

        $update = Brand::find($id)->update([
            'brand_name'=> $request->brand_name,
            'brand_image'=> $request->brand_image,

        ]);
        
        return Redirect()->route('brand')->with('success','Updated Succesfully');
    }
    public function RemoveBrand($id){
        $remove = Brand::find($id)->delete();
        return Redirect()->back()->with('success','Brand Removed Succesfully');
    }
}
