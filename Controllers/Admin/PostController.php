<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image as Image;

use App\Post;

ini_set('max_execution_time', 300);


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //
        $posts = Post::paginate(10);
        return view('pages.admin.post',['posts' => $posts]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        $this->validate($request,[
            'featured_image' => 'required',
            'title' => 'required|unique:posts',
            'body' => 'required'
        ]);

        $image1 = Input::file('featured_image');
        $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
        $path = public_path('uploads/posts/'. $featured);
        Image::make($image1->getRealPath())->resize(1200, 800)->save($path);

        Post::create([
            'featured_image' => $featured,
            'title' => $request->title,
            'body' => $request->body
        ]);

        return back()->with('message','Post submitted successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $post = Post::findOrFail($id);

        return view('pages.admin.edit-post',['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        $id = $request->id;
        $post = Post::findOrFail($id);

        $image1 = Input::file('featured_image');
        

        if($image1){
            $featured = str_random(30) . '.' . $image1->getClientOriginalExtension();
        $path = public_path('uploads/posts/'. $featured);
        Image::make($image1->getRealPath())->resize(1200, 800)->save($path);
            @unlink('uploads/posts/'.$post->featured_image);
        $post->update([
            'featured_image' => $featured,
            'title' => $request->title,
            'body' => $request->body
        ]);
        }else{
          $post->update([
            'title' => $request->title,
            'body' => $request->body
        ]);  
        } 

        return back()->with('message','Post updated successfully');  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $post = Post::findOrFail($id);
         @unlink('uploads/posts/'.$post->featured_image);
        $post->delete();

        return back()->with('message','Post deleted successfully');  

    }
}
