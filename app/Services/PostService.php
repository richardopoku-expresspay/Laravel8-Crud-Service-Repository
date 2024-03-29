<?php 

namespace App\Services;


use App\Repositories\Post\PostContract;
use Illuminate\Http\Request;

class PostService
{
    /** @var PostContract $post */
    private $post;

    public function __construct(PostContract $post)
    {
        $this->post = $post;
    }

    public function create(Request $request): array
    {
        //do a whole lot of business logic here, only call the repository to touch DB
        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];

        $post = $this->post->create($data);

        return $post;
    }

    /**
     * @param string|int $id
     */
    public function get($id): array
    {
        $post = $this->post->find($id);

        return $post;
    }

    public function getAll(): array
    {
        $posts = $this->post->all();

        return $posts;
    }

    /**
     * @param Request $request
     * @param string|int $id
     * @return array
     */
    public function update(Request $request, $id): array
    {
        $data = $request->only('title', 'description');

        $updated = $this->post->update($id, $data);

        return $updated;
    }

    /**
     * @param string|int $id
     */
    public function remove($id): array
    {
        $post = $this->post->find($id);

        if (is_array($post) && array_key_exists('status', $post) && $post['status'] == 404) {
            return [
                'status' => 400,
                'error' => 'Cannot delete non-existent post.',
            ];
        }

        $result = $this->post->delete($id);

        return $result;
    }
}