<?php

namespace App\GraphQL\Queries;

use App\Models\Comment;
use App\Models\Post;

class PostQuery
{
    public function postsByTag($_,array $args)
    {
        return  Post::join('post_tags','posts.id','=','post_tags.post_id')
                    ->join('tags','tags.id','=','post_tags.tag_id')
                    ->where([['tags.slug','=',$args['slug']],['posts.published','=',$args['published']]])
                    ->select('posts.*')
                    ->get();
    }
    public function postsByCategory($_ ,array $args)
    {
        return Post::join('categories','categories.id','=','posts.category_id')
                    ->where([['categories.slug','=',$args['slug']],['posts.published','=',$args['published']]])
                    ->select('posts.*')
                    ->get();
    }
}
