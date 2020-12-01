<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\NestableTrait;

class Comment extends Model
{
    use NestableTrait;

    protected $fillable = [
        'content','post_id','approved','user_id','parent_id'
    ];


    public function Post()
    {
        return $this->belongsTo(Post::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Parent()
    {
        return $this->belongsTo(Comment::class);
    }

    public function Childrens()
    {
        return $this->hasMany(Comment::class,"parent_id",'id');
    }
}
