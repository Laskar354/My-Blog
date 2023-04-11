<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostModel;
use App\Models\Category;
use App\Models\User;
use Clockwork\Storage\Search;

class PostModelController extends Controller
{
    public function index()
    {
        //dd(request("search"));

        $title = '';
        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
            $title = "in $category->name";
        }
        if(request('user')){
            $user = User::firstWhere('username', request('user'));
            $title = "by : $user->name";
        }
        return view("posts", [
            "title" => "All Posts $title",
            "posts" => PostModel::latest()->filters(request(["search", "category", "user"]))->paginate(7)->withQueryString()
        ]);
    }

    public function singlePost(PostModel $post)
    {
        return view("post", [
            "title" => "Post",
            "post" => $post
        ]);
    }
}
