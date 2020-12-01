<?php

namespace App\GraphQL\Mutations;
use App\Models\Post;

class PostMutations
{
    public function create($_, array $args)
    {
        $data = collect($args)->except('tags');

        $post = Post::create($data->all());

        if($post != null){
            $post->Tags()->sync($args['tags']);

            return $post;
        }
    }
    public function update($_, array $args)
    {
        $data = collect($args)->except('tags');

        $post = Post::find($args['id']);

        if($post->update($data->all())){
            $post->Tags()->sync($args['tags']);

            return $post;
        }
    }
}
