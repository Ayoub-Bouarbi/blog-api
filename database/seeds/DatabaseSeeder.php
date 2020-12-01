<?php

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class,40)->create();
        factory(Tag::class,40)->create();
        factory(Category::class,40)->create();
        // factory(Post::class,30)->create();
        // factory(Comment::class,20)->create();
    }
}
