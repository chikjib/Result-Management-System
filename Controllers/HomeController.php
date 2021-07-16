<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image as Image;

use App\Gallery;
use App\Staff;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload_gallery_show(Request $request){
        $galleries = Gallery::orderby('created_at','desc')->get();
        return view('pages.frontend.upload_gallery',['galleries' => $galleries]);
    }

    public function add_gallery(Request $request){
        $this->validate($request,[
            'image' => 'required',
            'caption' => 'required',
            'description' => 'required'
        ]);

        $image1 = Input::file('image');
        $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
        $path = public_path('uploads/school_gallery/'. $featured);
        Image::make($image1->getRealPath())->resize(1200, 800)->save($path);

        Gallery::create([
            'image' => $featured,
            'caption' => $request->caption,
            'description' => $request->description
        ]);

        return back()->with('message','Gallery updated successfully');
    }

    public function delete_gallery(Request $request,$id){
        $gallery = Gallery::findOrFail($id);
         @unlink('uploads/school_gallery/'.$gallery->image);
        $gallery->delete();

        return back()->with('message','Gallery deleted successfully');
    }

    public function upload_staff_show(Request $request){
        $staffs = Staff::orderby('created_at','desc')->take(4)->get();
        return view('pages.frontend.upload_staff',['staffs' => $staffs]);
    }

    public function add_staff(Request $request){

        $this->validate($request,[
            'passport' => 'required',
            'name' => 'required',
            'position' => 'required|unique:staff'
        ]);

        $image1 = Input::file('passport');
        $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
        $path = public_path('uploads/admin_staff/'. $featured);
        Image::make($image1->getRealPath())->resize(1200, 800)->save($path);

        Staff::create([
            'image' => $featured,
            'name' => $request->name,
            'position' => $request->position
        ]);

        return back()->with('message','Admin Staff added successfully');
    }

    public function delete_staff(Request $request, $id){

        $staff = Staff::findOrFail($id);
         @unlink('uploads/admin_staff/'.$staff->image);
        $staff->delete();

        return back()->with('message','Admin Staff deleted successfully');

    }

    
}
