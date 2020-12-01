<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Category extends Model
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
        return $this->hasMany(Post::class);
    }
}
