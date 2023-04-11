<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    use HasFactory;

    protected $guarded = ["id"];
    protected $with = ["user", "category"];

    // Pencarian data
    public function scopeFilters($query, $filters = [])
    {
        // Cara Pertama requestnya di model
        // if (request("search")) {
        //     return $query->where('title', 'like', '%'.request('search').'%')->orWhere('body', 'like', '%'.request('search').'%');
        // }

        // cara kedua request di controller
        // if(isset($filters["search"]) ? $filters['search'] : false){
        //     return $query->where('title', 'like', '%'.$filters['search'].'%')->orWhere('body', 'like', '%'.$filters['search'].'%');
        // }

        // cara ketiga
        $query->when(isset($filters['search']) ? $filters['search'] : false, function($query, $search){
            return $query->where('title', 'like', '%'.$search.'%')->orWhere('body', 'like', '%'.$search.'%');
        });
        $query->when(isset($filters['category']) ? $filters['category'] : false, function($query, $category){
            return $query->whereHas('category', function($query) use ($category){
                $query->where('slug', $category);
            });
        });
        $query->when(isset($filters['user']) ? $filters['user'] : false, function($query, $user){
            return $query->whereHas('user', function($query) use ($user){
                $query->where('username', $user);
            });
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Customize the key from id to slug
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
