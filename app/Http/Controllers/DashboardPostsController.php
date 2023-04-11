<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DashboardPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostModel::where('user_id', auth()->user()->id)->get();
        //dd($post);
        return view('dashboard.posts.index', [
            "posts" => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            "categories" => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request['slug']);
        //$request->file('image')->store('post-images');

        $addData = $request->validate([
            "title" => "required|max:255",
            "slug" => "required|max:255|unique:post_models",
            "category_id" => "required",
            "image" => "image|file|max:2024",
            "body" => "required",
        ]);

        // dd($addData);
        if($request->file('image')){
            $addData["image"] = $request->file('image')->store('post-images');
        }
        $addData["slug"] = Str::slug($request->title);
        $addData["user_id"] = auth()->user()->id;
        $addData["excerpt"] = strip_tags(Str::limit($request->body, 120));

        PostModel::create($addData);

        return redirect('/dashboard/posts')->with("success", "Succesfully added post!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = PostModel::firstWhere('slug', $slug);
        return view('dashboard.posts.show', [
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $post = PostModel::firstWhere('slug', $slug);
        //dd($post);
        return view('dashboard.posts.update', [
            "post" => $post,
            "categories" => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $post = PostModel::firstWhere('slug', $slug);
        //dd($post->image);
        $rules = [            
            "title" => "required|max:255",
            "category_id" => "required",
            "image" => "image|file|max:2024",
            "body" => "required",
        ];

        if($request->slug != $post->slug){
            $rules['slug'] = "required|max:255|unique:post_models"; // Untuk mengatasi slug yang uniq
        }

        $updateData = $request->validate($rules);
        

        if($request->file('image')){
            if($post->image){
                Storage::delete($post->image);
            }
            $updateData['image'] = $request->file('image')->store('post-images');
        }

        //dd($updateData);
        $updateData['slug'] = Str::slug($request->title);
        $updateData['user_id'] = auth()->user()->id;
        $updateData['excerpt'] = strip_tags(Str::limit($request->body, 120));
        $post->update($updateData);

        return redirect('/dashboard/posts')->with("success", "Post succesfully updated!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostModel  $postModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = PostModel::firstWhere('slug', $slug);

        if($post->image){
            Storage::delete($post->image);
        }
        $post->delete();
        

        return redirect('dashboard/posts')->with('success', 'Post has been deleted!');
    }
}
