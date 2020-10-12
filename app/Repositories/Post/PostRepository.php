<?php

namespace App\Repositories\Post;


use App\Models\Post;

class PostRepository implements PostContract
{
    public function create(array $data): array
    {
        $post = new Post();
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->save();

        if (!($post instanceof Post)) {
            return [
                'status' => 500,
                'error' => 'Could not create post.',
            ];
        }

        return [
            'status' => 200,
            'data' => $post->fresh()->toArray(),
            'error' => 'Post Created.',
        ];
    }
}