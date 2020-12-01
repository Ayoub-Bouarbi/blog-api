<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Str;


class Post extends Model
{
    protected $fillable = [
        'title','content','slug','published','description','published_at','user_id','enable_comments','featured','category_id'
    ];

    protected $casts = [
        'category_id' => 'integer',
    ];

    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
        $this->attributes['slug'] = Str::slug($title);
    }

    public function setPublishedAttribute($published)
    {
        $this->attributes['published'] = $published;
        $this->attributes['published_at'] = $published == true ? Date::now() : null;
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function Tags()
    {
        return $this->belongsToMany(Tag::class,'post_tags','post_id','tag_id');
    }
    
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
