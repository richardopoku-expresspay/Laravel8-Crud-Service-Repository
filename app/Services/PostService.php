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

    public function create(Request $request)
    {
        //do a whole lot of business logic here, only call the repository to touch DB
        $data = [
            'title' => $request->title,
            'description' => $request->description,
        ];
        
        $post = $this->post->create($data);

        return $post;
    }
}