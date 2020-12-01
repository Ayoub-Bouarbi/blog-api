<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    protected $fillable = [
        'name','slug'
    ];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = $name;
        $this->attributes['slug'] = Str::slug($name);
    }

    public function Posts()
    {
        return $this->belongsToMany(Post::class,'post_tags','tag_id','post_id');
    }
}
