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

    public function find($id): array
    {
        $post = Post::find($id);

        if (!($post instanceof Post)) {
            return [
                'status' => 404,
                'error' => 'Post not found.',
            ];
        }

        return [
            'status' => 200,
            'data' => $post->toArray(),
            'error' => 'Post found.',
        ];
    }

    public function all(): array 
    {
        $posts = Post::all();

        if (!$posts) {
            return [
                'status' => 500,
                'error' => 'Error fetching posts.',
            ];
        }

        return [
            'status' => 200,
            'data' => $posts->toArray(),
            'error' => 'Posts found.',
        ];
    }

    public function update($id, $properties): array
    {
        $foundPost = Post::find($id);

        if (!($foundPost instanceof Post)) {
            return [
                'status' => 404,
                'error' => 'Post not found.',
            ];
        }

        $updated = $foundPost->update($properties);

        if (!$updated) {
            return [
                'status' => 500,
                'error' => 'Failed to update post.',
            ];
        }

        return [
            'status' => 200,
            'error' => 'Post updated.',
            'data' => $foundPost->fresh()->toArray(),
        ];
    }
}